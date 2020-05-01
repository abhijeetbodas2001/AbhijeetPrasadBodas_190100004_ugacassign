import mysql.connector
from getpass import getpass



#make db by name pythonlogin if not present
make_database = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd=""
)
make_database_cursor = make_database.cursor()
make_database_cursor.execute("CREATE DATABASE IF NOT EXISTS pythonlogin")



#make table by name accounts of not present
current_database = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="pythonlogin"
)

make_table = current_database.cursor()
make_table.execute("""CREATE TABLE IF NOT EXISTS `accounts` (
	                `id` int(11) NOT NULL AUTO_INCREMENT,
  	                `username` varchar(50) NOT NULL,
  	                `password` varchar(255) NOT NULL,
  	                `email` varchar(100) NOT NULL,
                    PRIMARY KEY (`id`)
                )
            ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
""")




username = input('Username:')
password = getpass(prompt='Password: ', stream=None)

mycursor = current_database.cursor(prepared = True)
my_query = " SELECT * FROM accounts WHERE username = %s "

mycursor.execute(my_query, (username,) )

result = mycursor.fetchall()

username_exists = False
password_correct = False
for x in result:
    username_exists= True
    if x[2].decode() == password:
        password_correct= True
        print() 
        print("Login successful")
        print("Profile details-")
        print("Username: " + x[1].decode())
        print("User-id: " + str(x[0]) )
        print("Email address: "+ x[3].decode())


if not username_exists:
    print("Username does not exist")
    ch = input("Create new account? (0/1) : ")
    ch = int(ch)
    if ch!=0:
        new_username = input('Username:')
        new_email = input('Email: ')
        new_password = getpass(prompt='Password: ', stream=None)
        new_password_reenter = getpass(prompt='Re-enter password: ', stream=None)
        if new_password != new_password_reenter:
            print("Passwords do not match")
        else:
            insert_user = "INSERT INTO accounts (username, password, email) VALUES (%s, %s, %s)"
            new_user_details = (new_username, new_password, new_email)
            mycursor.execute(insert_user, new_user_details)
            current_database.commit()
            print("Registration successful")



if username_exists and not password_correct:
    print("Wrong password")


