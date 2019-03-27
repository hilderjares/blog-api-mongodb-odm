### Use curl to test requests

```
$ curl --request DELETE http://localhost:8080/api/user/id

$ curl --request GET http://localhost:8080/api/user 

$ curl --request POST http://localhost:8080/api/user --data "@data.txt" 

$ curl --request PUT http://localhost:8080/api/user/id --data "@data.txt" 
```

### HTTP Verbs

> HTTP defines a set of request methods to indicate the desired action to be performed for a given resource.

| Verb | Description
| :---: |:---:|
| ```GET``` | The GET method requests a representation of the specified resource. Requests using GET should only retrieve data. |
| ```POST``` |  The POST method is used to submit an entity to the specified resource, often causing a change in state or side effects on the server. | 
| ```PUT``` | The PUT method replaces all current representations of the target resource with the request payload. |
| ```DELETE``` | The DELETE method deletes the specified resource. |

### Success Codes

> If your request has been successful, you will receive one of the following status codes:

```
   - 200 OK
     Success (e.g., resource updated or retrieved, etc.). Note: a body is not always returned.

   - 201 Created
     A new resource has been successfully created (a Thng, collection, etc.). The Location header will contain the URL of the resource. The response payload will contain the resource created in the body.

   - 202 Accepted
     The request was accepted successfully, and will be fulfilled asynchronously. In most cases, the resource can be polled for completion status.

   - 204 No Content
     The request was successful, and there are no results to return. An example of this is a DELETE operation.
```
