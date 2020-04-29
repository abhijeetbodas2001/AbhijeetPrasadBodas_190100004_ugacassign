import json
import mysql.connector



makedb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd=""
)
dbfind = makedb.cursor()
dbfind.execute("CREATE DATABASE IF NOT EXISTS jsonadd")


mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="jsonadd"
)


maketable = mydb.cursor()
maketable.execute("""CREATE TABLE IF NOT EXISTS `accounts` (
	                `id` int(11) NOT NULL AUTO_INCREMENT,
  	                `username` varchar(50) NOT NULL,
  	                `password` varchar(255) NOT NULL,
  	                `email` varchar(100) NOT NULL,
                    PRIMARY KEY (`id`)
                )
            ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
""")



f = open("data.json")
data = json.load(f)
print(data['username'])
print(data['password'])
print(data['email'])




mycursor = mydb.cursor(prepared = True)


ins = "INSERT INTO accounts (username, password, email) VALUES (%s, %s, %s)"
val = (data['username'], data['password'], data['email'])
mycursor.execute(ins, val)
mydb.commit()
print("Registration successful")