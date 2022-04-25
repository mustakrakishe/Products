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

|Name                                 |Method   |Path                                     |Description
|-------------------------------------|---------|-----------------------------------------|-
|api_countries_get_collection         |GET      |/api/countries                           |Retrieves the collection of Country resources.
|api_countries_post_collection        |POST     |/api/countries                           |Creates a Country resource.
|api_countries_get_item               |GET      |/api/countries/{id}                      |Retrieves a Country resourse.
|api_countries_delete_item            |DELETE   |/api/countries/{id}                      |Removes the Country resource.
|api_countries_put_item               |PUT      |/api/countries/{id}                      |Replaces the Country resource.
|api_countries_patch_item             |PATCH    |/api/countries/{id}                      |Updates the Country resource.
|api_locales_get_collection           |GET      |/api/locales                             |Retrieves the collection of Locale resources.
|api_locales_post_collection          |POST     |/api/locales                             |Creates a Locale resource.
|api_locales_get_item                 |GET      |/api/locales/{id}                        |Retrieves a Locale resourse.
|api_locales_delete_item              |DELETE   |/api/locales/{id}                        |Removes the Locale resource.
|api_locales_put_item                 |PUT      |/api/locales/{id}                        |Replaces the Locale resource.
|api_locales_patch_item               |PATCH    |/api/locales/{id}                        |Updates the Locale resource.
|api_products_get_collection          |GET      |/api/products                            |Retrieves the collection of Product resources.
|api_products_post_collection         |POST     |/api/products                            |Creates a Product resource.
|api_products_get_item                |GET      |/api/products/{id}                       |Retrieves a Product resourse.
|api_products_delete_item             |DELETE   |/api/products/{id}                       |Removes the Product resource.
|api_products_put_item                |PUT      |/api/products/{id}                       |Replaces the Product resource.
|api_products_patch_item              |PATCH    |/api/products/{id}                       |Updates the Product resource.
|api_vats_get_collection              |GET      |/api/vats                                |Retrieves the collection of VAT resources.
|api_vats_post_collection             |POST     |/api/vats                                |Creates a VAT resource.
|api_vats_get_item                    |GET      |/api/vats/{id}                           |Retrieves a VAT resourse.
|api_vats_delete_item                 |DELETE   |/api/vats/{id}                           |Removes the VAT resource.
|api_vats_put_item                    |PUT      |/api/vats/{id}                           |Replaces the VAT resource.
|api_vats_patch_item                  |PATCH    |/api/vats/{id}                           |Updates the VAT resource.
|api_locale_products_get_collection   |GET      |/api/{localeIso}/products                |Retrieves the collection of Locale Product resources.
|api_locale_products_get_item         |GET      |/api/{localeIso}/products/{productId}    |Retrieves a Locale Product resourse.

### Resource schemas

```
Country {
    id:         integer
    name:       string
    locales:    [string($iri-reference)]
    vats:       [string($iri-reference)]
}

Locale {
    id	        integer
    name	    string
    iso	        string
    country	    string($iri-reference)
}

Product {
    id	        integer
    name	    string
    description string
    price	    integer
    vats	    [string($iri-reference)]
}

Vat {
    id	        integer
    readOnly:   true
    product	    string($iri-reference)
    country	    string($iri-reference)
    value	    integer
}

LocaleProduct {
    id	        integer
    name	    string
    description string
    price	    integer
}
```

### Query examples

#### 1. Get a Product collection

##### Request:

[GET] `http://localhost/api/products`

##### Response:

```json
{
	"@context": "\/api\/contexts\/Product",
	"@id": "\/api\/products",
	"@type": "hydra:Collection",
	"hydra:member": [
		{
			"@id": "\/api\/products\/1",
			"@type": "Product",
			"id": 1,
			"name": "Bread",
			"description": "Fresh weat bread",
			"price": 10,
			"vats": [
				"\/api\/vats\/1",
				"\/api\/vats\/3"
			]
		},
		{
			"@id": "\/api\/products\/2",
			"@type": "Product",
			"id": 2,
			"name": "Wine",
			"description": "Bordeaux Red Blends from Napa Valley, California",
			"price": 50,
			"vats": [
				"\/api\/vats\/2",
				"\/api\/vats\/4"
			]
		}
	],
	"hydra:totalItems": 2
}
```

#### 2. Create a Product item

##### Request:

[POST] `http://localhost/api/products`

```json
{
    "name": "Cheese",
    "description": "Sartori BellaVitano Gold Cheese",
    "price": 30
}
```

##### Response:

```json
{
    "@context": "/api/contexts/Product",
    "@id": "/api/products/3",
    "@type": "Product",
    "id": 3,
    "name": "Cheese",
    "description": "Sartori BellaVitano Gold Cheese",
    "price": 30,
    "vats": []
}
```

#### 3. Get a Product item

##### Request:

[GET] `http://localhost/api/products/1`

##### Response:
```json
{
    "@context": "/api/contexts/Product",
    "@id": "/api/products/1",
    "@type": "Product",
    "id": 1,
    "name": "Bread",
    "description": "Fresh weat bread",
    "price": 10,
    "vats": [
        "/api/vats/1",
        "/api/vats/3"
    ]
}
```

#### 4. Update a product item

##### Request:

[PATCH] `http://localhost/api/products/3`

```json
{
    "price": 40
}
```

##### Response:

```json
{
    "@context": "/api/contexts/Product",
    "@id": "/api/products/3",
    "@type": "Product",
    "id": 3,
    "name": "Cheese",
    "description": "Sartori BellaVitano Gold Cheese",
    "price": 40,
    "vats": []
}
```

#### 5. Delete a Product item

##### Request:

[DELETE] `http://localhost/api/products/3`

##### Response:

Response Code: 204 Product resource deleted

#### 6. Get a Locale Product collection

##### Request:

[GET] `http://localhost/api/en/products`

##### Response:

```json
[
	{
		"id": 1,
		"name": "Bread",
		"description": "Fresh weat bread",
		"price": "10.7000"
	},
	{
		"id": 2,
		"name": "Wine",
		"description": "Bordeaux Red Blends from Napa Valley, California",
		"price": "57.5000"
	}
]
```

#### 7. Get a Locale Product item

##### Request:

[GET] `http://localhost/api/en/products/1`

##### Response:

```json
{
    "id": 1,
    "name": "Bread",
    "description": "Fresh weat bread",
    "price": "10.7000"
}
```

## Troubleshooting

If you use Docker on Windows OS it will works slowly than on Linux ones and lead to unexpacted results. A few sitautions was catched:

1. The Nginx container does not start cause of php-container is unhealthy.

Increase a `start-period` parameter of the php container healthcheck command (/docker/php/Dockerfile):

```docker
HEALTHCHECK --interval=3s \
    --timeout=3s \
    --start-period=2m \             # increase it
    --retries=3 \
    CMD netstat -an | grep :9000
```

2. An endpoint request returns 504.

Retry a request.