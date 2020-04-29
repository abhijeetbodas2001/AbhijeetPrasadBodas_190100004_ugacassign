import mysql.connector
from getpass import getpass



#make db by name pythonlogin
makedb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd=""
)
dbfind = makedb.cursor()
dbfind.execute("CREATE DATABASE IF NOT EXISTS pythonlogin")



#make table by name accounts
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="pythonlogin"
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




u = input('Username:')
p = getpass(prompt='Password: ', stream=None)

mycursor = mydb.cursor(prepared = True)
qry = " SELECT * FROM accounts WHERE username = %s "

mycursor.execute(qry, (u,) )

res = mycursor.fetchall()

uexist= False
pexist= False
for x in res:
    uexist= True;
    if x[2].decode() == p:
        pexist= True
        print() 
        print("Login successful")
        print("Profile details-")
        print("Username: " + x[1].decode())
        print("User-id: " + str(x[0]) )
        print("Email address: "+ x[3].decode())


if not uexist:
    print("Username does not exist")
    ch = input("Create new account? (0/1) : ")
    ch = int(ch)
    if ch!=0:
        un = input('Username:')
        e= input('Email: ')
        pn = getpass(prompt='Password: ', stream=None)
        pnc = getpass(prompt='Re-enter password: ', stream=None)
        if pn!=pnc:
            print("Passwords do not match")
        else:
            ins = "INSERT INTO accounts (username, password, email) VALUES (%s, %s, %s)"
            val = (un, pn, e)
            mycursor.execute(ins, val)
            mydb.commit()
            print("Registration successful")



if uexist and not pexist:
    print("Wrong password")


