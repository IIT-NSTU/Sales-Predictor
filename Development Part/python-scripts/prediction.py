from sqlalchemy import create_engine
import pandas as pd

# Connect to the Laravel MySQL database
user = 'root'
password = ''
host = 'localhost'
database = 'sales_predictor'

# Create a SQLAlchemy engine
conn = create_engine(f'mysql+pymysql://{user}:{password}@{host}/{database}')

df = pd.read_sql('SELECT * from users', conn)
print(df)