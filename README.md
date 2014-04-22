# Kindrid PHP Client library example


A very simple example for working with the Kindrid API in PHP

## Installation

Clone this repository and install with composer

```bash
git clone https://github.com/kindrid/kindrid_php.git
cd kindrid_php
composer install
```

Create a new instance of the client with your API key and secret

```php
$k = new \Kindrid\Kindrid($key, $secret);
```

Get all donations

```php
$donations = $k->donations();
```

Get all donors

```php
$donors = $k->donors();
```

Get all disbursals

```php
$disbursals = $k->disbursals();
```
