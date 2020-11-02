# Laravel Rest Filters

The Missing RESTFul API AutoFilters Provider for Laravel.

## Quick Start

### Install the Package.

```bash
composer require itsrennyman/laravel-rest-filters
```

### Set Up Filtering

```php
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    return User::withRestFilters()->get();
}
```

### Start Filtering

In order to Filter, pass the parameters in the URI Querystring.

```php
// http://localhost:8000/api/users?email=fframi@example.net

[
  {
    "id": 1,
    "name": "Victoria Shanahan",
    "email": "fframi@example.net",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  }
]
```

And Done. So Sexy So Fresh!

## Available Filters

#### Single Field Where

```php
// http://localhost:8000/api/users?email=fframi@example.net

[
  {
    "id": 1,
    "name": "Victoria Shanahan",
    "email": "fframi@example.net",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  }
]
```

#### Single Field Where with Multiple Values

```php
// http://localhost:8000/api/users?email=fframi@example.net,hamill.marques@example.com

[
  {
    "id": 1,
    "name": "Victoria Shanahan",
    "email": "fframi@example.net",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  },
  {
    "id": 2,
    "name": "Lenore Stroman II",
    "email": "hamill.marques@example.com",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  }
]
```

#### Multiple Fields Where
Multiple fields are joined as multiple AND wheres.

```php
// http://localhost:8000/api/users?email=aryan@example.net&id=3

[
  {
    "id": 3,
    "name": "Orval Lockman Sr.",
    "email": "aryan@example.net",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  }
]

```

#### Field Sorting
You can use the minus operator in front of the field, in order to do the DESC sorting.
Multiple order by are supported, use the comma as separator.

```php
// http://localhost:8000/api/users?sort=-id

[
  {
    "id": 10,
    "name": "Dr. Jason Russel I",
    "email": "qoreilly@example.com",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  },
  {
    "id": 9,
    "name": "Mrs. Yasmine Wintheiser",
    "email": "elmore.krajcik@example.org",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  },
  {
    "id": 8,
    "name": "Garett Botsford Sr.",
    "email": "lueilwitz.kelley@example.com",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  },
  {
    "id": 7,
    "name": "Karli Ondricka",
    "email": "kreiger.andrew@example.com",
    "email_verified_at": "2020-11-02T10:59:10.000000Z",
    "created_at": "2020-11-02T10:59:10.000000Z",
    "updated_at": "2020-11-02T10:59:10.000000Z"
  }
]
```

#### Field Selecting

```php
// http://localhost:8000/api/users?fields=id,name

[
  {
    "id": 1,
    "name": "Mikayla Stanton"
  },
  {
    "id": 2,
    "name": "Mr. Newell Raynor Jr."
  },
  {
    "id": 3,
    "name": "Theodora O'Conner"
  }
]
```
