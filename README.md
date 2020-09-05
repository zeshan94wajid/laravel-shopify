# Shopify App

![Frontend imaget](https://user-images.githubusercontent.com/57898558/92305799-6fe09e80-ef82-11ea-874f-7244d2429816.PNG)

This is a simple REST JSON API which allows to Save customer, orders and products from your chosen shopify store to a MySQL Database. It returns responses in a Rest 
You can then use it to calculate the average order value accross all customers and an average order value for a specific customer.

PS: There is a Front end built within it which demonstrate each Application endpoint.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Installing

Setup a local Laravel Environment with laver 5.8+ and clone this repository.
Run the followings once you've set up your environment

```
composer install
php artisan migrate
```

Create a private Shopify app on your store and copy over the API credentials and store them to to the .env file as follow:
```
SHOP_URL=https://#{API_KEY}:#{PASSWORD}@#{SHOP_NAME}.myshopify.com/admin/api/2020-07/"
```

Make sure to replace the API_KEY, PASSWORD and SHOP_NAME with your own credentials

Run the following to get the app running on your localhost

```
php artisan serve
```

## Update customer data from Shopify

### Request

`PUT /customers/update`

### Response

`{"success":true,"message":"Customers updated successfully.","data":[]}`

## Update product data from Shopify

### Request

`PUT /products/update`

### Response

`{"success":true,"message":"Products updated successfully.","data":[]}`

## Update order data from Shopify

### Request

`PUT /orders/update`

### Response

`{"success":true,"message":"Orders updated successfully.","data":[]}`


## Get averarge order value accross all customers

### Request

`GET /orders/average/all`

### Response

`{"success":true,"message":"Average order value","data":'average'}`


## Get averarge order value for a specific customer

### Request

`POST /customers/orders/average`
`{"id":1}`

### Response

`{"success":true,"message":"Average order value","data":'average'}`
