<?php
require_once('database.php');
// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$courses = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Contact Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Contact Manager</h1></header>
<main>
    <h1>Category List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <!-- add code for the rest of the table here -->
        <?php foreach ($categories  as $category) : ?>
            <tr>
                <td><?php echo $category['categoryID']; ?></td>
                <td><?php echo $category['categoryName']; ?></td>
                <td><form action="delete_category.php" method="post"  onSubmit="return confirm('Are you sure do you want to delete?')">
                    <input type="hidden" name="contact_id"
                           value="<?php echo $category['contactID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $category['categoryID']; ?>">
                    <input type="submit" class="delete"  value="Delete">

                    </form></td>
              
            </tr>
        <?php endforeach; ?>

    </table>
    <p>
    <h2>Add Category</h2>

    <!-- add code for the form here -->
    <form action="add_category.php" method="post" >

        <label>Category ID:</label>
        <input type="text" name="category_id"><br>
        <label>Category Name:</label>
        <input type="text" name="category_Name"><br>
         <p>

        <label>&nbsp;</label>
        <input type="submit" value="Add Category"><br>

    </form>

    <br>
    <p><a href="index.php">List Contacts</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Contact Manager</p>
    </footer>
</body>
</html>