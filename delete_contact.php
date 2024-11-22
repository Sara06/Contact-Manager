<?php
require_once('database.php');

// Get IDs
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the contact from the database
if ($contact_id != false && $category_id != false) {
    $query = 'DELETE FROM contacts
              WHERE contactID = :contact_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':contact_id', $contact_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Contact List page
include('index.php');