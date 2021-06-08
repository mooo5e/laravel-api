## Statements API
URL|Method
---|---
  api/statements/add     | POST
  api/statements/delete  | POST
  api/statements/edit    | POST
  api/statements/show    | POST
  api/statements/all     | GET|HEAD

All requests require basic authentication.
**Login:** test
**Password:** password

### Tested [here](http://vm3.westeurotele.com:9090/laravel-api/public/).

### Usage:
- **add** JSON example ( POST /api/statements/add):
```json
{
  "firstName": "Carl",
  "lastName": "Johnson",
  "color": "green"
}
```

- **delete** JSON example (POST /api/statements/delete):
```json
{
  "lastName": "",
  "color": ""
}
```

- **edit** JSON example (POST /api/statements/edit):
```json
{
  "firstName": "Oleg"
}
```

- **show** JSON example (POST /api/statements/show):
```json
{
  "firstName": "",
  "can swim": "",
  "likesFlowers": ""
}
```

#### get all key -> value pairs:
Make a **GET** to /api/statements/all .
