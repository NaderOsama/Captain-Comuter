<?php
// Retrieve the selected radio button value
$condition = isset($_POST['Condition']) ? $_POST['Condition'] : '';

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'comuter';
$conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }



// Insert the selected value into the database
if ($condition === "1") {
    // Insert into the database with condition as true
    $sql = "INSERT INTO users (conditionTrueOrFalse) VALUES (1)";
} elseif ($condition === "0") {
    // Insert into the database with condition as false
    $sql = "INSERT INTO users (conditionTrueOrFalse) VALUES (0)";
}

if ($conn->query($sql) === TRUE) {
    // Redirect to the appropriate page after successful insertion
    if ($condition === "1") {
        header("Location: comuter.php");
    } elseif ($condition === "0") {
        header("Location: thank_for_time.html");
    } else {
        header("Location: error.php");
    }
    exit;
} else {
    // Handle database insertion error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>