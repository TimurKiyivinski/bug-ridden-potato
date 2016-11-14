# bug-ridden-potato
Forked off [bug-free-potato](https://github.com/TimurKiyivinski/bug-free-potato) to create an XML port.

## Usage
All `tables` require an `id` field to work properly.

## API CRUD operations
### Create Class
```PHP
class User extends Model {
    // XML file
    public static $xml_dir = "../data/user.xml";
    // XML root tag
    public static $xml_root = "users";
    // XML child tag
    public static $xml_child = "user";
}
```
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
$users = User::where($key, $value);
```

### Update
```PHP
$user = User::find(6);
$user->age = "21";
$user->update();
```

### Delete
Delete existing user
```PHP
User::delete(6);
```

## Additional functionality
Print debugging data
```PHP
$user->list_contents();
```
