import os
import pickle
import pandas as pd
import numpy as np
from sqlalchemy import create_engine
from sklearn.preprocessing import StandardScaler
from sklearn.ensemble import RandomForestClassifier
from sklearn.multioutput import MultiOutputClassifier
from sklearn.linear_model import SGDRegressor

# Connect to the Laravel MySQL database
user = 'root'
password = ''
host = 'localhost'
database = 'sales_predictor'

# Create a SQLAlchemy engine
engine = create_engine(f'mysql+pymysql://{user}:{password}@{host}/{database}')

users = pd.read_sql('SELECT * from users', engine)

for index in users.index:
    user_id = users.loc[index]['id']
    invoice_products = pd.read_sql("SELECT i.date AS date, ip.product_id AS product_id, ip.quantity AS unit FROM invoice_products ip JOIN invoices i ON ip.invoice_id = i.id where ip.user_id='"+ str(user_id) + "'", engine)
    
    if len(invoice_products) > 0:
        invoice_products['date'] = pd.to_datetime(invoice_products['date'], format = '%Y-%m-%d %I:%M:%S %p', errors = 'coerce').dt.date
        
        # Create a pivot table with 'date' as rows and 'product_id' as columns
        pivot_table = invoice_products.pivot_table(index = 'date', columns = 'product_id', values = 'unit', aggfunc = 'sum', fill_value = 0)

        # Reindex to include all dates from the first to the last date in the data
        date_range = pd.date_range(start = invoice_products['date'].min(), end = invoice_products['date'].max())
        pivot_table = pivot_table.reindex(date_range, fill_value=0)

        # Reset index to make 'date' a column again
        pivot_table.index.name = 'date'
        pivot_table = pivot_table.reset_index()

        pivot_table['day_of_year'] = pivot_table['date'].dt.dayofyear
        pivot_table['month'] = pivot_table['date'].dt.month
        pivot_table['day_of_week'] = pivot_table['date'].dt.dayofweek
        pivot_table['day_of_month'] = pivot_table['date'].dt.day
        pivot_table = pivot_table.drop(columns='date')
        
        classification_data = pivot_table[['day_of_year', 'month', 'day_of_week', 'day_of_month']].copy()

        # Ensure all product columns are numeric
        pivot_table = pivot_table.apply(pd.to_numeric, errors='coerce')

        columns_to_concat = []

        products = pivot_table.columns.to_list()[:-5]

        for product in products:
            # Defining conditions here
            conditions = [
                pivot_table[product] > 2,
                pivot_table[product] == 2,
                pivot_table[product] == 1,
                pivot_table[product] == 0
            ]

            # Defining the corresponding outputs for each condition
            choices = [3, 2, 1, 0]

            # Apply np.select and store the result in a separate DataFrame
            classification_column = pd.DataFrame({
                product: np.select(conditions, choices, default = 0)
            })

            # Append this column to the list of columns to concatenate
            columns_to_concat.append(classification_column)

        # Step 3: Concatenate all columns at once
        classification_data = pd.concat([classification_data] + columns_to_concat, axis=1)

        # Getting the the product column names
        product_columns = classification_data.columns.difference(['day_of_year', 'month', 'day_of_week', 'day_of_month'])

        pids = pd.DataFrame(product_columns, columns=['id'])
        
        # Setting the dependent and independent variable
        X = classification_data[['day_of_year', 'month', 'day_of_week', 'day_of_month']]
        y = classification_data[product_columns]

        clf = MultiOutputClassifier(RandomForestClassifier(n_estimators=100, random_state=42))
        clf.fit(X, y)

        # Predict the classification output for the training data
        y_pred = clf.predict(X)

        # Create a dictionary to store regression models for each product
        regression_models = {}

        # Loop through each product
        for position, product in enumerate(product_columns):
            
            # Filter the rows where the predicted label is 3 for the current product
            mask = y_pred[:, position] == 3
            
            # Select the relevant rows from X_train based on the mask
            X_train_reg = X[mask].copy()
            
            if (len(X_train_reg) > 0):

                # Create the target series (y_train_reg) for regression, based on the original 'data' DataFrame
                y_train_reg = pivot_table.loc[X_train_reg.index, product]

                # Initialize the SGDRegressor with a small learning rate
                reg = SGDRegressor(max_iter=2000, tol=1e-3, random_state=42)

                # Scaling the data for regression
                scaler = StandardScaler()
                X_train_reg_scaled = scaler.fit_transform(X_train_reg) 
                    
                # Train the regression model with SGDRegressor
                reg.fit(X_train_reg_scaled, y_train_reg)
                
                # Store the regression model
                regression_models[product] = reg

        directory = "python-scripts/model/"     
        
        # Saving model to pickle file
        with open(directory + str(user_id) + "_classifier.pkl", "wb") as file: 
            pickle.dump(clf, file)

        # Save the models in one pickle file
        with open(directory + str(user_id) + "_regressor.pkl", "wb") as f:
            pickle.dump(regression_models, f)

        pids.to_csv(directory + str(user_id) + "_pids.csv", index=False)   
