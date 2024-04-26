<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tips.php">Tips while Traveling</a></li>
            <li><a href="forum.php">Travel Forum</a></li>
            <li><a href="book.php">Book a Trip</a></li>
        </ul>
    </div>
    <h1>Transaction Completed</h1>
    <?php
    $from = $_GET['from'];
    $to = $_GET['to'];
    $days = $_GET['days'];
    $flyers = $_GET['flyers'];
    $fullName = $_GET['fullName'];
    $email = $_GET['email'];
    $phoneNumber = $_GET['phoneNumber'];
    echo "FROM: $from TO: $to <br>";
    echo "$days - Day Trip <br>";
    echo "Reservation name under $fullName <br>";
    echo "E-mail: $email <br> Phone Number: $phoneNumber";
    ?>
</body>
</html>