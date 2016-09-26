<?php

include('models/model.php');

define("DATABASE_ENV", [
    'host' => 'db',
    'database' => 'wad',
    'username' => 'root',
    'password' => 'password'
]);

// Example class
class Dogs extends Model {
}
