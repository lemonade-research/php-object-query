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

#### Optional fields

By default, a `Path` throws an `UnresolvablePathException` if it cannot resolve a
property anywhere along the chain. Mark it as `optional()` to instead omit the
corresponding key from the result set entirely.

```php
<?php

use Lemonade\ObjectQuery\Query\Query;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Definition\Path;

$resolver = new QueryResolver(
    new Query('pilotName', (new Path())->get('pilot')->get('name')->optional())
);

$resolver->resolve($someShipWithoutAPilot);
// [] -- 'pilotName' is not present in the result set
```

#### Default values

Instead of omitting an unresolvable field, you can use `default()` to fall back to a
given value. This is useful when you always want the key present in the result set,
even if the underlying data is missing. `default()` takes precedence over `optional()`
if both are set.

```php
<?php

use Lemonade\ObjectQuery\Query\Query;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Definition\Path;

$resolver = new QueryResolver(
    new Query('pilotName', (new Path())->get('pilot')->get('name')->default('Unknown pilot'))
);

$resolver->resolve($someShipWithoutAPilot);
// ['pilotName' => 'Unknown pilot']
```

### Nested

The `Nested` definition lets you return nested data structures instead of a
flat associative array. It navigates to a sub-source using any other
definition (typically a `Path`) and then applies its own set of queries to
it.

If the navigation resolves to a single object, `Nested` returns a nested
associative array. If it resolves to a collection, `Nested` applies its
queries to every entry and returns a list of nested associative arrays.
`Nested` definitions can be combined to build arbitrarily deep structures.

```php
<?php

use Lemonade\ObjectQuery\Query\Query;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Definition\Nested;
use Lemonade\ObjectQuery\Definition\Path;

$resolver = new QueryResolver(
    new Query('name', (new Path())->get('name')),
    new Query('pilot', new Nested(
        (new Path())->get('pilot'),
        new Query('name', (new Path())->get('name')),
        new Query('id', (new Path())->get('id'))
    )),
    new Query('starShips', new Nested(
        (new Path())->get('starShips'),
        new Query('name', (new Path())->get('name'))
    ))
);

$resolver->resolve($someCharacter);
// [
//     'name' => 'Han Solo',
//     'pilot' => ['name' => 'Han Solo', 'id' => 1002],
//     'starShips' => [['name' => 'Millenium Falcon'], ['name' => 'Imperial shuttle']],
// ]
```

If the navigation definition is `optional()` and cannot be resolved, the
`Nested` definition behaves like any other and the corresponding key is
omitted from the result set.
