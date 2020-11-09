# Laravel Rest Filters

The Missing RESTFul API AutoFilters Provider for Laravel.

Table of Contents
=================

* [Quick Start](#quick-start)
* [Basic Filters](#basic-filters)
* [Advanced Filters](#advanced-filters)
* [Contribution](#contribution)

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

## Basic Filters

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

## Advanced Filters

#### Greater Than

```php
// http://localhost:8000/api/users?id=gt:4

[
  {
    "id": 5,
    "name": "Jazmyne Lang",
    "email": "mozelle.bednar@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 6,
    "name": "Matteo Feest",
    "email": "pschroeder@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 7,
    "name": "Tabitha Wiegand Jr.",
    "email": "mayer.adrianna@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  }
]
```

#### Greater Than Equal

```php
// http://localhost:8000/api/users?id=gte:4

[
  {
    "id": 4,
    "name": "Eleanora Harris",
    "email": "beer.jazmyn@example.net",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 5,
    "name": "Jazmyne Lang",
    "email": "mozelle.bednar@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 6,
    "name": "Matteo Feest",
    "email": "pschroeder@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 7,
    "name": "Tabitha Wiegand Jr.",
    "email": "mayer.adrianna@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  }
]
```

#### Less Than

```php
// http://localhost:8000/api/users?id=lt:4

[
  {
    "id": 1,
    "name": "Miss Damaris Medhurst PhD",
    "email": "ttoy@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 2,
    "name": "Ms. Sarina Volkman III",
    "email": "twila.fahey@example.net",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 3,
    "name": "Prof. Asha Hane",
    "email": "aliza60@example.com",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  }
]
```

#### Less Than Equal

```php
// http://localhost:8000/api/users?id=lte:4

[
  {
    "id": 1,
    "name": "Miss Damaris Medhurst PhD",
    "email": "ttoy@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 2,
    "name": "Ms. Sarina Volkman III",
    "email": "twila.fahey@example.net",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 3,
    "name": "Prof. Asha Hane",
    "email": "aliza60@example.com",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 4,
    "name": "Eleanora Harris",
    "email": "beer.jazmyn@example.net",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  }
]
```

#### Like & iLike

NB: Currently iLike is not supported on MySQL.

With the like attribute, the query search the full value passed as parameter.
If you need to do search, be sure to add the percentage '%' to your values.

```php
// http://localhost:8000/api/users?name=like:%Mr%

[
  {
    "id": 17,
    "name": "Mrs. Verlie Cummerata",
    "email": "vhessel@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 19,
    "name": "Mr. Maynard Conn PhD",
    "email": "idooley@example.com",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 26,
    "name": "Mrs. Marcelle Cole IV",
    "email": "gwyman@example.net",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:31.000000Z",
    "updated_at": "2020-11-03T15:43:31.000000Z"
  },
  {
    "id": 68,
    "name": "Mrs. Helga Hansen",
    "email": "meaghan08@example.org",
    "email_verified_at": "2020-11-03T15:43:31.000000Z",
    "created_at": "2020-11-03T15:43:32.000000Z",
    "updated_at": "2020-11-03T15:43:32.000000Z"
  }
]
```

## Contribution

If you have ideas, or improvements for this Project, please open a Pull Request.
