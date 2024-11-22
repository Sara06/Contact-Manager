<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
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
        <h1>Add Contact</h1>
        <form action="add_contact.php" method="post"
              id="add_contact_form">

            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>First Name:</label>
            <input type="text" name="firstName"><br>

            <label>Last Name:</label>
            <input type="text" name="lastName"><br>

            <label>Email Address:</label>
            <input type="text" name="emailAddress"><br>

            <label>Phone:</label>
            <input type="text" name="phone"><br>
        

            <label>&nbsp;</label>
            <input type="submit" value="Add Contact"><br>
        </form>
        <p><a href="index.php">View Contact List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Contact Manager, Inc.</p>
    </footer>
</body>
</html>