Object Querying Library
=======================

[![Build Status](https://travis-ci.org/1blankz7/php-object-query.svg?branch=master)](https://travis-ci.org/1blankz7/php-object-query)
[![Test Coverage](https://api.codeclimate.com/v1/badges/7a8ca049f3de48523339/test_coverage)](https://codeclimate.com/github/1blankz7/php-object-query/test_coverage)
[![Maintainability](https://api.codeclimate.com/v1/badges/7a8ca049f3de48523339/maintainability)](https://codeclimate.com/github/1blankz7/php-object-query/maintainability)

This library allows you to query your object graph in a consistent way. You can use it to support object mapping and to
generate data representation based on the requirements of external systems.

## Usage

`Query` and the `QueryResolver` are the two key components of the system. A resolver needs one or more queries and
resolves these queries by processing them on a given object graph.

```php
<?php

use ObjectQuery\Query\Query;
use ObjectQuery\QueryResolver;
use ObjectQuery\Definition\Path;

$resolver = new QueryResolver(
    new Query('shipName', (new Path())->get('name'))
);

$resolver->resolveArray($someShip);
// ['shipName' => 'Millenium Falcon']
```

A query consists of a name which ends up being the key in the result and a definition.

There are three main definitions in the system you can use. `Path`, `Value` and `Composition`.

### Value

The `Value` definition is a plain container which will return the given value.

```php
<?php

use ObjectQuery\Query\Query;
use ObjectQuery\QueryResolver;
use ObjectQuery\Definition\Value;

$resolver = new QueryResolver(
    new Query('two', new Value(2))
);

$resolver->resolveArray($someObject);
// ['two' => 2]
```

### Composition

The `Composition` definition is a more flexible alternative to `Value`. It gives access to the current source.

```php
<?php

use ObjectQuery\Query\Query;
use ObjectQuery\QueryResolver;
use ObjectQuery\Definition\Composition;
use ObjectQuery\Source\ObjectSource;

$composition = new Composition(function(ObjectSource $source) {
    return $source->get('id');
});
$resolver = new QueryResolver(
    new Query('someKey', $composition)
);

$resolver->resolveArray($someObject);
// ['someKey' => 3000]
```

### Path

`Path` is the most complex definition. You can deep walk into the graph, filter collections and transform leaves. Have a
look into the tests to get an impression of the possibilities.

```php
<?php

use ObjectQuery\Query\Query;
use ObjectQuery\QueryResolver;
use ObjectQuery\Definition\Path;

$path = (new Path())->get('appearsIn')
    ->filter(new EpisodeFilter(Episode::EMPIRE))
    ->get('episode');
$resolver = new QueryResolver(new Query('episodes', $path));

$resolver->resolveArray($someObject);
// ['episode' => [1, 2]]
```
