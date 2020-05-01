import json
import mysql.connector


# make new database if not present
make_database = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd=""
)
make_database_cursor = make_database.cursor()
make_database_cursor.execute("CREATE DATABASE IF NOT EXISTS jsonadd")


current_database = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="jsonadd"
)


# make new table if not present
maketable = current_database.cursor()
maketable.execute("""CREATE TABLE IF NOT EXISTS `accounts` (
	                `id` int(11) NOT NULL AUTO_INCREMENT,
  	                `username` varchar(50) NOT NULL,
  	                `password` varchar(255) NOT NULL,
  	                `email` varchar(100) NOT NULL,
                    PRIMARY KEY (`id`)
                )
            ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
""")



data_file = open("data.json")
user_data = json.load(data_file)





mycursor = current_database.cursor(prepared = True)
my_query = " SELECT * FROM accounts WHERE username = %s "

mycursor.execute(my_query, (user_data['username'],) )
result=  mycursor.fetchall()

if len(result)==0:
    ins = "INSERT INTO accounts (username, password, email) VALUES (%s, %s, %s)"
    val = (user_data['username'], user_data['password'], user_data['email'])
    mycursor.execute(ins, val)
    current_database.commit()
    print("Registration successfully done with following details-")
    print('Username: ' + user_data['username'])
    print('Password: ' + user_data['password'])
    print('Email: ' + user_data['email'])
else :
    print('username already exists')