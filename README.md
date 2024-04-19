Task for Laravel/WordPress:

1.	Create Products API with following JSON and Pagination
Explanation
a.	Created a products model and seeder.
b.	Required JSON structure defined in Model.
c.	Controller returns paginated results.
d.	get-products api to fetch results.

2.	Create User Registration/Login API
Registration
a.	Routes defined in api.php
b.	Validated required fields.
c.	Created a user in users table.
d.	Created token if validation is success. 
Login
e.	Routes defined in api.php
f.	Validated required fields.
g.	Created token if validation is success. 

3.	Make 2 API End point one Endpoint accessible without token and Second API Endpoint Token (If not token then give message unauthorized)

a.	Defined two endpoints in api.php
b.	Added a middleware to private endpoint. 
