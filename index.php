<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}

// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();


// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Get contacts for selected category
$queryContacts = 'SELECT * FROM contacts
                  WHERE categoryID = :category_id
                  ORDER BY contactID';
$statement3 = $db->prepare($queryContacts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$contacts = $statement3->fetchAll();
$statement3->closeCursor();
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
    <h1>Contact List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of contacts -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Phone</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>

            <?php foreach ($contacts as $contact) : ?>
            <tr>
                <td><?php echo $contact['firstName']; ?></td>
                <td><?php echo $contact['lastName']; ?></td>
                <td><?php echo $contact['emailAddress']; ?></td>
                <td><?php echo $contact['phone']; ?></td>
                <td><form action="delete_contact.php" method="post"  onSubmit="return confirm('Are you sure do you want to delete?')">
                    <input type="hidden" name="contact_id"
                           value="<?php echo $contact['contactID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $contact['categoryID']; ?>">
                    <input type="submit" class="delete"  value="Delete">
                   
                </form></td>
                <td><form action="update_contact_form.php" method="post"  id="update_contact_form" >
                    <input type="hidden" name="contact_id"
                           value="<?php echo $contact['contactID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $contact['categoryID']; ?>">
                    <input type="submit" value="Edit">
                   
                </form></td>

            </tr>
            <?php endforeach; ?>


        </table>
        <p><a href="add_contact_form.php">Add Contact</a></p>
        <p><a href="category_list.php">List Categories</a></p>  
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Contact Manager</p>
</footer>
</body>
</html>