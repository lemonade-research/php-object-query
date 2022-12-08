Object Querying Library
=======================

This library allows you to query your object graph in a consistent way. You can use it to support object mapping and to
generate data representation based on the requirements of external systems.

## Usage

`Query` and the `QueryResolver` are the two key components of the system. A resolver needs one or more queries and
resolves these queries by processing them on a given object graph.

```php
<?php

use Lemonade\ObjectQuery\Query\Query;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Definition\Path;

$resolver = new QueryResolver(
    new Query('shipName', (new Path())->get('name'))
);

$resolver->resolve($someShip);
// ['shipName' => 'Millenium Falcon']
```

A query consists of a name which ends up being the key in the result and a definition.

There are three main definitions in the system you can use. `Path`, `Value` and `Composition`.

### Value

The `Value` definition is a plain container which will return the given value.

```php
<?php

use Lemonade\ObjectQuery\Query\Query;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Definition\Value;

$resolver = new QueryResolver(
    new Query('two', new Value(2))
);

$resolver->resolve($someObject);
// ['two' => 2]
```

### Composition

The `Composition` definition is a more flexible alternative to `Value`. It gives access to the current source.

```php
<?php

use Lemonade\ObjectQuery\Query\Query;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Definition\Composition;
use Lemonade\ObjectQuery\Source\ObjectSource;

$composition = new Composition(function(ObjectSource $source) {
    return $source->get('id');
});
$resolver = new QueryResolver(
    new Query('someKey', $composition)
);

$resolver->resolve($someObject);
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
