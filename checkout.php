<html>

<head>
    <!-- link is not working -->
    <link rel="stylesheet" href="checkout.css"> 
    <style>
        
    </style>
</head>

<?php
session_start();
$_SESSION["book"];
$_SESSION["book_name"];
$_SESSION["author_name"];
$_SESSION["category_name"];
?>

<body>
    <ul>
        <li style="margin-left: 1.5em;"><a class="active" href="index.php">Home</a></li>
        <li style="margin-left: 1.5em;"><a href="bookstore.php"> Our Book-Store </a></li>
        <li style="margin-left: 28em;"><a class="active" href="index.php">AMAZON</a></li>
    </ul>
    <div class="main-box">
        <fieldset>
            <legend> <strong> Order's Details </strong></legend>
            <?php echo '<img id="book-img" src="images/' . $_SESSION['book_name'] . '.jpg' . '" width = "200" height="200"> </img>' ?>
            <p> Book Name: <?php echo ($_SESSION["book_name"]) ?> </p>
            <p> Author: <?php echo ($_SESSION["author_name"]) ?> </p>
            <p> Category: <?php echo ($_SESSION["category_name"]) ?> </p>
            <p> Price: <?php echo ($_SESSION["price"]) ?> </p>

        </fieldset>

        <form action="checkout.php" method="post">
            <fieldset>
                <legend> <strong> Customer's Details </strong> </legend>
                <div id="wrapper">
                    <div id="left">
                        <p>Name: <input type="text" name="username"></p>
                        <p>Address: <input type="text" name="address"></p>
                        <p>Debit/Credit Number: <input type="text" name="debitcredit"></p>
                        <p>Phone Number: <input type="text" name="phone"></p>
                        <p><input class="buy-btn" type="submit" name="submit" value="Submit"></p>
                    </div>

                    <div id="right">
                        <?php

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            require("mysqli_connect.php");
                            //Book name POST
                            $book_name = mysqli_real_escape_string($dbc, trim($_SESSION['book_name']));
                            //Name Required
                            if (empty($_POST['username'])) {
                                echo "<p>Name  is required!</p>";
                                $errors = ["error!"];
                            } else {
                                $customer_name = mysqli_real_escape_string($dbc, trim($_POST['username']));
                            }

                            //Address Required
                            if (empty($_POST['address'])) {
                                echo "<p>Address  is required!</p>";
                                $errors = ["error!"];
                            } else {
                                $address = mysqli_real_escape_string($dbc, trim($_POST['address']));
                            }

                            //Debit/Credit Card Required
                            if (empty($_POST['debitcredit'])) {
                                echo "<p>Enter your payment details!</p>";
                                $errors = ["error!"];
                            } else if ((strlen($_POST['debitcredit'])) != 16) {
                                echo "<p>Your card numbers should have 16 numbers only!</p>";
                                $errors = ["error!"];
                            } else {
                                $debitcredit = mysqli_real_escape_string($dbc, trim($_POST['debitcredit']));
                            }

                            //Phone number required
                            if (empty($_POST['phone'])) {
                                echo "<p>Enter your phone number!</p>";
                                $errors = ["error!"];
                            } else if ((strlen($_POST['phone'])) != 10) {
                                echo "<p>Your card numbers should have 10 numbers only!</p>";
                                $errors = ["error!"];
                            } else {
                                $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
                            }

                            //After all the validation
                            if (empty($errors)) {
                                $q = "INSERT INTO orders VALUES ('$book_name', null , '$customer_name', '$address', '$debitcredit' , '$phone')";
                                $u = "UPDATE book_store_inventory SET quantity = quantity - 1 WHERE book_name = '$book_name'";
                                $r = @mysqli_query($dbc, $q) or die(mysqli_error($dbc));
                                $r2 = @mysqli_query($dbc, $u) or die(mysqli_error($dbc));

                                echo "<h2> Thank YOU FOR SHOPPING WITH US </h2>";
                            }
                            mysqli_close($dbc);
                        }
                        ?>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

    

</body>