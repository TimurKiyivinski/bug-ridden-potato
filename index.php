<?php

include('models/model.php');

// Example class
class Dogs extends Model {
    // XML file
    public static $xml_dir = "./dogs.xml";
    // XML root tag
    public static $xml_root = "dogs";
    // XML child tag
    public static $xml_child = "dog";
}

$dogs = Dogs::all();
foreach ($dogs as $dog) {
    echo "<pre> name: " . $dog->name . ", age: " . $dog->age . "</pre>";
}

$krissy = Dogs::find(1);
echo "<pre> name: " . $krissy->name . ", age: " . $krissy->age . "</pre>";

$billy = (new Dogs())
    ->set('name', 'Billy')
    ->set('age', 15);
$billy->save();
