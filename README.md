# Installation
Packages required for server web pages.

1) Install flask packages
```bash
sudo pip3 install Flask
```
```bash
sudo pip3 install flask_cors flask
```

# TIC4304-JavaScript Injection

JavaScript Injection caused by cross site scripting vulnerability.

The web page:
http://localhost/login.php

1. Go to the files of the web page via terminal.
cd /var/www/html

2. Check and list down all the files in the web page.
ls

3. Task 1, Reflected XSS, task1.php can be exploited by 
"<body onload =alert('Baizura,A0177718N')>" . To prevent this exploitation, we edit on the text editor in linux.

nano task1.php

We insert code that consists of special characters and when the code is submitted, it will send an alert that the input consist special characters.
Otherwise, the web page will run normally.
  
4. Task 2, Stored XSS, we have to store the input and reload it when load button is clicked. Thus, we have to access MySQL database.
To retrieve the database on linux,
mysql -u lsuser -p (password 'tic123')
use loginsystem;
select * from xss;

5.We edit the web page on task2.php and trigger_task2.php
