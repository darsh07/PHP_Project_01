<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

    session_start();
    $_SESSION["book"] = "$_POST[bookID]";
    $_SESSION["book_name"] = "$_POST[bookName]";
    $_SESSION["author_name"] = "$_POST[AuthorName]";
    $_SESSION["category_name"] = "$_POST[Category]";
    $_SESSION["price"] = "$_POST[Price]";

    header("Location: checkout.php");

}

session_start();
?>

<html>

<head>
    <link rel="stylesheet" href="bookstore.css">
</head>

<body>
    <ul>
        <li style="margin-left: 1.5em;"><a class="active" href="index.php">Home</a></li>
        <li style="margin-left: 1.5em;"><a href="bookstore.php"> Our Book-Store </a></li>
        <li style="margin-left: 28em;"><a class="active" href="index.php">AMAZON</a></li>
    </ul>
</body>

<?php
require("mysqli_connect.php");
$main_query = "SELECT book_store_inventory.book_id,book_store_inventory.book_name,book_store_inventory.price, author.name, category.category_name  from author 
JOIN book_store_inventory ON book_store_inventory.author_id = author.author_id 
JOIN category ON book_store_inventory.category_id = category.category_id";

$query = "SELECT * from book_store_inventory";
$query2 = "SELECT * from author";

$result = @mysqli_query($dbc, $main_query);

$num = mysqli_num_rows($result);

if ($num > 0) {

    // echo "<p><strong> There are currently $num registered books </strong></p>";

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        echo '<div class = "main-box">' .
            '<img id="book-img" src="images/' . $row['book_name'] . '.jpg' . '" width = "200" height="200"> </img>' . '&emsp;' . "<p><strong> Book Name : </strong>" . $row['book_name'] . '<br>' .
            "<strong> Author : </strong>" . $row['name'] . '<br>' .
            "<strong> Category : </strong>" . $row['category_name'] . '<br> ' .
            "<strong> Price : </strong>" . $row['price'] . '<strong> $ </strong> <br> <br>' .
            '<form method="post" action="bookstore.php" class="form"> 
                    <input type="hidden" name="bookID" value="' . $row['book_id'] . '" />
                    <input type="hidden" name="bookName" value="' . $row['book_name'] . '" />
                    <input type="hidden" name="AuthorName" value="' . $row['name'] . '" />
                    <input type="hidden" name="Category" value="' . $row['category_name'] . '" />
                    <input type="hidden" name="Price" value="' . $row['price'] . '" /> ' . '<br> <br> <br> <br> <br> <br>' .
                '<input class="buy-btn" style="" type="submit" type="button" id=". " ' . $row['book_id'] . ' " value = "Buy Now " />
            </form> </p>' .
            '</div>';
    }
} else {
    echo '<p class="error"> There are currently no registered books available </p>';
}

mysqli_close($dbc);
?>