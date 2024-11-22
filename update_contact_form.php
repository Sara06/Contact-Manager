<?php
require('database.php');

//requested contact id
$contact_id = $_REQUEST['contact_id'];

//get all categoryid and category name
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

//get contact details of requested contact id
 $query = "SELECT *
          FROM  contacts
          WHERE contactID = $contact_id";
$statement = $db->prepare($query);
$statement->execute();
$contacts = $statement->fetchAll();

//Edit the contact details
 
if(count($contacts) > 0)
{
$firstName = $contacts[0]['firstName'];
$lastName = $contacts[0]['lastName'];
$emailAddress = $contacts[0]['emailAddress'];
$phone = $contacts[0]['phone'];

}


?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Contact Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Contact Manager</h1></header>

    <main>
        <h1>Update Contact</h1>
        <form action="update_contact.php" method="post"
              id="update_contact_form">
             <input type="hidden"  name="contact_id" value="<?php echo $contact_id; ?>">
            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>       
                <option value="<?php echo $category['categoryID']; ?>">
                     <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>First Name:</label>
            <input type="text" name="firstName"   value="<?php echo htmlspecialchars($firstName); ?>"> <br>

            <label>Last Name:</label>
            <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>"><br>

            <label>Email Address:</label>
            <input type="text" name="emailAddress" value="<?php echo htmlspecialchars($emailAddress); ?>"><br>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>
        

            <label>&nbsp;</label>
            <input type="submit" value="Update Contact"><br>
        </form>
        <p><a href="index.php">View Contact List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Contact Manager, Inc.</p>
    </footer>
</body>
</html>