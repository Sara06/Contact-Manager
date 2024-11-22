<?php
// Get the contact data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_VALIDATE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone');

// Validate inputs
if ($category_id == null || $category_id == false ||
        $firstName == null || $lastName == null || $emailAddress == false || $phone == null) {
    $error = "Invalid contact data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the contact to the database  
    $query = 'INSERT INTO contacts
                 (categoryID, firstName, lastName, emailAddress,phone)
              VALUES
                 (:category_id, :firstName, :lastName, :emailAddress, :phone)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':emailAddress', $emailAddress);
    $statement->bindValue(':phone', $phone);
    $statement->execute();
    $statement->closeCursor();

    // Display the Contact List page
    include('index.php');
}
?>