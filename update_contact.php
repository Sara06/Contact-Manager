<?php 
// Get the contact data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);
$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_VALIDATE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone');
 


// Validate inputs
if ($category_id == null || $category_id == false || $contact_id == null || $contact_id == false || 
       empty($firstName) || empty($lastName) || empty($emailAddress) || empty($phone) ||  $firstName == null || $lastName == null || $emailAddress == false || $phone == null) {
    $error = "Invalid contact data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    
    // Update the contact to the database  
        
    $query = 'UPDATE Contacts
        SET firstName = :firstName,
            lastName = :lastName,
            emailAddress = :emailAddress,
            phone = :phone,          
            categoryID = :category_id
        WHERE contactID = :contact_id';
    
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':emailAddress', $emailAddress);
        $statement->bindValue(':phone', $phone);        
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':contact_id', $contact_id);
        $statement->execute();
        $statement->closeCursor();


        
    // Display the Contact List page
        include('index.php');
    //}
}
?>