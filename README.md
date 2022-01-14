```
Test. ToDo list with CRUD (Add, update, delete) through REST API with authentication through Google
for administrator. 
```

## You have to have an account in Google and Ngrok to run this app.

### Up the services

docker-compose up -d

### Go to the container

docker exec -it test1_php-apache_1 bash

### Take the authtoken from site

https://dashboard.ngrok.com/get-started/setup

### Run

./ngrok authtoken <your_authtoken>

### Run

./ngrok http 80

### Notice outputed url from nrgok program

Looks like this: https://b485-80-90-225-46.ngrok.io
Be sure that you noticed url with https

### Go to Google's APIs and services through your account

Use url like this https://console.cloud.google.com/apis
Go to credentials. Then choose - create credentials and OAuth client ID. Choose - Web application. Enter name and
authorized redirect URIs. Authorized redirect URIs is noticed earlier url from ngrok
(like https://b485-80-90-225-46.ngrok.io). Put this url to the field and concatinate with - /callback. You shoud have
url like this https://b485-80-90-225-46.ngrok.io/callback. Then save changes. Notice the CLIENT_ID, SECRET_KEY and
Authorized redirect URI.

### Modify file .env.example. Put CLIENT_ID, SECRET_KEY and Authorized redirect URI

OAUTH_GOOGLE_CLIENT_ID=<noticed_client_id>
OAUTH_GOOGLE_SECRET_KEY=<noticed_secret_key>
OAUTH_GOOGLE_CALLBACK_URL=<<noticed_authorized_redirect_uri>

### Run in container at /var/www/html

cp .env.example .env

### Migrate and seed DB

php artisan migrate:fresh --seed

### Run app in browser

- Open http://localhost
- Press button "Login through Google"
- Notice url parameter of the browser's url filed after successfull authentication - token=<token>

### Use requests like those and put token you have got earlier after Bearer, to work with app's API:
- Add
```
POST http://localhost/api/tasks/action
Content-Type: application/json
Accept: application/json
Authorization: Bearer 1|kCk4y8bYjwSck5usHmMllbXdFue8e0OrbxpWhDI0

{
  "user": {
    "name": "john doe",
    "UserName": "johndoe@gmail.com"
  },
  "action": "add",
  "item": {
    "id": 1,
    "text": "todo item"
  }
}

###
```

- Update
```
POST http://localhost/api/tasks/action
Content-Type: application/json
Accept: application/json
Authorization: Bearer 1|kCk4y8bYjwSck5usHmMllbXdFue8e0OrbxpWhDI0

{
  "user": {
    "name": "john doe",
    "UserName": "johndoe@gmail.com"
  },
  "action": "update",
  "item": {
    "id": 1,
    "text": "updated todo item"
  }
}

###
```

- Delete
```
POST http://localhost/api/tasks/action
Content-Type: application/json
Accept: application/json
Authorization: Bearer 1|kCk4y8bYjwSck5usHmMllbXdFue8e0OrbxpWhDI0
{
  "user": {
    "name": "john doe",
    "UserName": "johndoe@gmail.com"
  },
  "action": "delete",
  "item": {
    "id": 1,
    "text": "updated todo item"
  }
}

###
```

### Quit container and down it if you are exit:
Press "ctrl + d"  
docker-compose down  

