# bug-free-potato
Simple (almost) Fluent Active Record API for PHP mimicking Laravel Eloquent (slightly).
It is designed for usage in an assignment in which we were't allowed to use any external libraries.

## Usage
Set database information via a constant
```PHP
define("DATABASE_ENV", [
    'host' => 'db',
    'database' => 'wad',
    'username' => 'root',
    'password' => 'password'
]);

```

For every table in the database, create an equally named table in `models/`.
```PHP
<?php
include 'model.php';

class Users extends Model {
}
```
All `tables` require an `id` field with auto increment enabled.

## API CRUD operations
### Create
```PHP
$user = new User();
$user->name = "Timur";
$user->age = 20;
$user->save();
```

### Read
Retreive a single instance based on ID. 
```PHP
$user = User::find($id);
```

Retrieve all instances
```PHP
$users = User::all();
```

Retrieve instances based on where clauses.
```PHP
$users = (new User()->where('name', 'Timur')->where('age', '18', '>')->get());
```
Syntax is `where($key, $value)` or `where($key, $value, $operator)`

### Update
```PHP
$user = User::find(6);
$user->age = "21";
$user->update();
```

### Delete
Delete existing user
```PHP
$user = User::find(6);
$user->delete();
```

Delete using static context
```PHP
User::find(12)->delete();
```

## Additional functionality
Run your very own query!
```PHP
User::exec('DROP TABLE USERS;');
```

Print debugging data
```PHP
$user->list();
```
