## Statements API
URL|Method
---|---
  api/statements/add     | POST     
  api/statements/delete  | POST     
  api/statements/edit    | POST     
  api/statements/show    | POST     
  api/statements/all     | GET|HEAD 


##Tested on http://vm3.westeurotele.com:9090/laravel-api/public/

#Usage:
- add JSON example ( POST /api/statements/add):
*
{
  "firstName": "Carl",
  "lastName": "Johnson"
}
*

- delete JSON example (POST /api/statements/delete):
*
{
  "color": "",
  "pet": ""
}
*

- edit JSON example (POST /api/statements/edit):
*
{
  "firstName": "Oleg"
}
*

- show JSON example (POST /api/statements/show):
*
{
  "firstName": "",
  "can swim": ""
}
*

#get all key -> value pairs:
Make a GET to /api/statements/all .

