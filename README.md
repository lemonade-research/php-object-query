Object Querying Library
=======================

This library allows you to query your object graph in a consistent way.
You can use it to support object mapping and to generate data representation
based on the requirements of external systems.

## Usage

Because this library does not do any magic, we first need to implement the
resolvers and register them in the query resolver.

```php
<?php

use ObjectQuery\Resolver\ResolverInterface;

class FooResolver implements ResolverInterface
{
    public function getProperty($graph, $name)
    {
        return $graph->$name;
    }
    
    public function getRoot($name)
    {
        return ...;
    }
}
```

The code above is just for the purpose of demonstration and should be avoided in any
real application.

After that we can define the query:

```php
<?php
use ObjectQuery\QueryBuilder;

$query = QueryBuilder::create()
            ->withProperty('foo', 'some.property.path')
            ->build();
```

### Query Path Syntax

A query path consists of a chain of properties separated by a path separator.
The default for the path separator is the dot (`.`).

```
foo.bar
buzz.foo.salt
twee
```

Every root property must be resolved by the given root resolver.

You can use filters to change values of leafs or to restrict the result in a
collection. A filter can be applied through the use of parentheses in combination
with the filter name. 

```
foo.bar(translate)
buzz.foo.salt(currency:0)
twee(limit:3).foo
```

