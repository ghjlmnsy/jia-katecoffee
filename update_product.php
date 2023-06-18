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

// Retrieve the form data
$productId = $_POST['id'];
$productName = $_POST['product_name'];
$type = $_POST['type'];
$description = $_POST['description'];
$servingSize = $_POST['serving_size'];
$price = $_POST['price'];
$recommendedPairings = $_POST['recommended_pairings'];
$popularity = $_POST['popularity'];
$availability = $_POST['availability'];

// Handle the image upload
$image = $_FILES['image'];
$uploadDir = 'uploads/';  // Specify the directory where you want to save the uploaded images

// Check if an image was uploaded
if (!empty($image['name'])) {
    $imagePath = $uploadDir . $image['name'];

    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        // Image upload was successful
        // Update the product in the database
        $query = "UPDATE coffee_products SET product_name = ?, type = ?, description = ?, serving_size = ?, price = ?, recommended_pairings = ?, popularity = ?, availability = ?, product_image = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssdssssi", $productName, $type, $description, $servingSize, $price, $recommendedPairings, $popularity, $availability, $imagePath, $productId);
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $message = "Product updated successfully.";
            header("Location: allproducts.php");
            exit();
        } else {
            $message = "No updates were made or failed to update product.";
        }
    } else {
        // Image upload failed
        $message = "Failed to upload the image.";
    }
} else {
    // No image was uploaded, update the product without modifying the image
    $query = "UPDATE coffee_products SET product_name = ?, type = ?, description = ?, serving_size = ?, price = ?, recommended_pairings = ?, popularity = ?, availability = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssdsssi", $productName, $type, $description, $servingSize, $price, $recommendedPairings, $popularity, $availability, $productId);
    mysqli_stmt_execute($stmt);

     // Check if the update was successful
     if (mysqli_stmt_affected_rows($stmt) > 0) {
        $message = "Product updated successfully.";
        header("Location: allproducts.php");
            exit();
    } else {
        $message = "No updates were made or failed to update product.";
    }
}

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<script>
    var message = "<?php echo $message; ?>";
    alert(message);
    window.history.back();
</script>