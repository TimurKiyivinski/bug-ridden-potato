<?php

include 'models/model.php';

class Dogs extends Model {
}

// Save
$test_0 = new Dogs();
$test_0->name = "Charlie";
$test_0->breed = "Cat";
$test_0->age = "1";
$test_0->save();

// Update
$test_1 = new Dogs();
$test_1->name = "Woof";
$test_1->breed = "Doggo";
$test_1->age = "1";
$test_1->id = 4;
$test_1->update();

// Get
$test_2 = (new Dogs())
    ->where('breed', 'Doggo')
    ->where('age', '3', '>')
    ->get();

// All
Dogs::all();

// Find
Dogs::find(3);
