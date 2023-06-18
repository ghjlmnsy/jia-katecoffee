<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cafe";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted and the product ID is provided
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Retrieve the product image file name from the database
    $query = "SELECT product_image FROM coffee_products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $productImage);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Delete the product from the database
    $query = "DELETE FROM coffee_products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Delete the product image file from the server
        $imagePath = 'uploads/' . $productImage;
        if (file_exists($imagePath) && is_writable($imagePath)) {
            unlink($imagePath);
        }

        $message = "Product deleted successfully.";
    } else {
        $message = "Failed to delete product.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    $message = "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>

<script>
    var message = "<?php echo $message; ?>";
    alert(message);
    window.history.back();
</script>