<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the item ID to delete
    $itemid = $_POST['itemid'];

    $mysqli = new mysqli("localhost", "root", "", "cafe");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Prepare and execute the deletion query
    $sql = "DELETE FROM jiakatestocks WHERE `Item ID` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $itemid);
    $stmt->execute();

    // Check if any rows were affected by the deletion
    if ($stmt->affected_rows > 0) {
        echo "Record deleted successfully.";
    } else {
        echo "No matching records found.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $mysqli->close();

    // Redirect to another page after deletion
    header("Location: stocks.php");
    exit();
}
?>
