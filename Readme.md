# Products

A small REST API for e-shop core engine

## Description

The main idea of this engine is that it contains one database of products that can be sold in different e-shops (for example in different countries - products will be the same, their price without VAT is constant, but their VAT rates will be different in different countries) that run upon these core engine and database. So basically it implements a "super" backend which will be contacted by those different e-shop backends.

## Requirements

1. Docker;
2. Docker-compose.

## Install

1. Clone this repository to your project directory.
```shell
git clone https://github.com/mustakrakishe/products your_project_name
```

2. Up the docker environment.
```shell
docker-compose up -d
```
> After install the project db includes start test data.

## Usage

The app is available at `localhost:80/api`

> As the project isbased on [Api-platform](https://api-platform.com/), it is available to test the app at ```localhost/api```.

### Available queries

|Name                                 |Method   |Path                                     |Request body             |Responsebody
|-------------------------------------|---------|-----------------------------------------|-------------------------|------------
|api_countries_get_collection         |GET      |/api/countries                           |
|api_countries_post_collection        |POST     |/api/countries                           |
|api_countries_get_item               |GET      |/api/countries/{id}                      |
|api_countries_delete_item            |DELETE   |/api/countries/{id}                      |
|api_countries_put_item               |PUT      |/api/countries/{id}                      |
|api_countries_patch_item             |PATCH    |/api/countries/{id}                      |
|api_locales_get_collection           |GET      |/api/locales                             |
|api_locales_post_collection          |POST     |/api/locales                             |
|api_locales_get_item                 |GET      |/api/locales/{id}                        |
|api_locales_delete_item              |DELETE   |/api/locales/{id}                        |
|api_locales_put_item                 |PUT      |/api/locales/{id}                        |
|api_locales_patch_item               |PATCH    |/api/locales/{id}                        |
|api_products_get_collection          |GET      |/api/products                            |
|api_products_post_collection         |POST     |/api/products                            |
|api_products_get_item                |GET      |/api/products/{id}                       |
|api_products_delete_item             |DELETE   |/api/products/{id}                       |
|api_products_put_item                |PUT      |/api/products/{id}                       |
|api_products_patch_item              |PATCH    |/api/products/{id}                       |
|api_vats_get_collection              |GET      |/api/vats                                |
|api_vats_post_collection             |POST     |/api/vats                                |
|api_vats_get_item                    |GET      |/api/vats/{id}                           |
|api_vats_delete_item                 |DELETE   |/api/vats/{id}                           |
|api_vats_put_item                    |PUT      |/api/vats/{id}                           |
|api_vats_patch_item                  |PATCH    |/api/vats/{id}                           |
|api_locale_products_get_collection   |GET      |/api/{localeIso}/products                |
|api_locale_products_get_item         |GET      |/api/{localeIso}/products/{productId}    |