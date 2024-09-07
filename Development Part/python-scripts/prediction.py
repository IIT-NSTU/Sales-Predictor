import pickle
import os.path
import pandas as pd
from datetime import date, datetime, timedelta
from sklearn.preprocessing import StandardScaler
from sqlalchemy import create_engine, text
from sqlalchemy.orm import Session

# Connect to the Laravel MySQL database
user = 'root'
password = ''
host = 'localhost'
database = 'sales_predictor'

# Create a SQLAlchemy engine
engine = create_engine(f'mysql+pymysql://{user}:{password}@{host}/{database}')

start_date = datetime(2022, 4, 1)
dates = [start_date + timedelta(days=i) for i in range(365 * 3)]

df = pd.DataFrame({'Date': dates})

df['day_of_year'] = df['Date'].dt.dayofyear
df['month'] = df['Date'].dt.month
df['day_of_week'] = df['Date'].dt.dayofweek  # Monday=0, Sunday=6
df['day_of_month'] = df['Date'].dt.day

scaler = StandardScaler()
scaled_features = scaler.fit_transform(df[['day_of_year', 'month', 'day_of_week', 'day_of_month']])

df_scaled = pd.DataFrame(scaled_features, columns=['day_of_year_scaled', 'month_scaled', 'day_of_week_scaled', 'day_of_month_scaled'])
df = pd.concat([df, df_scaled], axis=1)

users = pd.read_sql('SELECT * from users', engine)

directory = "python-scripts/model/"   

for index in users.index:
    user_id = users.loc[index]['id']

    classifier_path = directory + str(user_id) + "_classifier.pkl"
    regressor_path = directory + str(user_id) + "_regressor.pkl"
    
    if os.path.isfile(classifier_path):
        # Opening saved model
        with open(classifier_path, "rb") as file:
            classifier = pickle.load(file)

        with open(regressor_path, "rb") as f:
            regressor = pickle.load(f)    

        today = date.today()
        prediction_dates = [today + timedelta(days = i) for i in range(30)]

        product_data = pd.read_csv(directory + str(user_id) + "_pids.csv")

        sql = "INSERT INTO `predictions` (`id`, `date`, `product_id`, `unit`, `user_id`, `created_at`, `updated_at`) VALUES "

        for date in prediction_dates:
            result = classifier.predict(pd.DataFrame({'day_of_year': date.timetuple().tm_yday, 'month':date.month, 'day_of_week':date.weekday(), 'day_of_month':date.day}, index = [0]))
            i = 0
            for value in result[0]:
                if not value == 0:
                    unit = value
                    if value == 3 and product_data['id'][i] in regressor:
                        row = df[(df['day_of_year'] == date.timetuple().tm_yday) 
                                 & (df['month'] == date.month)
                                 & (df['day_of_week'] == date.weekday())
                                 & (df['day_of_month'] == date.day)]
                        row = row.reset_index()
                        test_data = [[row.loc[0]['day_of_year_scaled'], row.loc[0]['month_scaled'], row.loc[0]['day_of_week_scaled'], row.loc[0]['day_of_month_scaled']]]
                        result = regressor[product_data['id'][i]].predict(test_data)
                        unit = round(result[0])

                    sql += "(NULL, '" + str(date) + "', '" + str(product_data['id'][i]) + "', '" + str(unit) + "', '" + str(user_id) + "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),"
                i += 1

        with Session(engine) as session:
            session.execute(text("DELETE from `predictions` WHERE user_id = " + str(user_id)))
            session.execute(text(sql[:-1]))
            session.commit() 
        