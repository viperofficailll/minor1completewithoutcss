<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating and Reviews</title>
    <link rel="stylesheet" href="ratingsandreviews.php">
</head>

<body>
    <?php
    session_start(); // Start the session
    // Check if the user is logged in, otherwise redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }

    // Include database connection
    include 'db_conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Get the restaurant ID from the URL parameter
        $restaurantid = $_GET['id'];

        //DISPLAY ABOUT THE RESTAURANT
        $mql = "SELECT * FROM `searchfood` WHERE `restaurantid`=$restaurantid";
        $result1 = $conn->query($mql);
        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $restaurantrating = $row1['ratings'];
            $restaurantName = $row1['restaurant'];
            echo "<p><h3>Restaurant you are going to rate:</h3>  <h1>$restaurantName</p></h1>   ";
            echo "<p><h3>Current rating:</h3>  <h1>$restaurantrating</p></h1><h1>IMAGE</h1>   ";
        }
    } else {
        header("Location:login");
    }



    ?>
  <h1>Rating and Review</h1>
<form action="feedbackhandeler.php?id=<?php echo $restaurantid; ?>" method="post">
    <h2>Rate it out of 5</h2>
    <input type="radio" name="rating" value="1" required> 1
    <input type="radio" name="rating" value="2" required> 2
    <input type="radio" name="rating" value="3" required> 3
    <input type="radio" name="rating" value="4" required> 4
    <input type="radio" name="rating" value="5" required> 5
    <br>
    <input type="hidden" name="restaurantid" value="<?php echo $restaurantid; ?>">
    <input type="text" name="review" placeholder="Review here" required>
    <button type="submit" name="submit">Submit Review</button>
</form>


</body>

</html>