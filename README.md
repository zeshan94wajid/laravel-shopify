# Shopify App

This is a simple Shopify App which allows to Save customer, orders and products from your chosen shopify store to a MySQL Database. You can then use the front end built within it to calculate the average order value accross all customers and an average order value for a specific customer.

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
