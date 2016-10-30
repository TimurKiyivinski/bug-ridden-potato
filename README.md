# bug-ridden-potato
Forked off [bug-free-potato](https://github.com/TimurKiyivinski/bug-free-potato) to create an XML port.

## Usage
All `tables` require an `id` field to work properly.

## API CRUD operations
### Create
```PHP
$user = new User();
$user->name = "Timur";
$user->age = 20;
$user->save();
```

### Read
Retrieve a single instance based on ID. 
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
