<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafe";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch existing product data for editing
$product = null; // Initialize the $product variable
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $query = "SELECT * FROM coffee_products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productName = $_POST['product_name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $servingSize = $_POST['serving_size'];
    $price = $_POST['price'];
    $recommendedPairings = $_POST['recommended_pairings'];
    $popularity = $_POST['popularity'];
    $availability = $_POST['availability'];
    $productImage = $_FILES['product_image'];

    // File upload handling
    $targetDirectory = "uploads/"; // Specify the directory to store uploaded files
    $targetFilePath = $targetDirectory . basename($productImage['name']);

    // Move uploaded file to the target directory
    if (move_uploaded_file($productImage['tmp_name'], $targetFilePath)) {
        // Prepare the SQL query
        $query = "INSERT INTO coffee_products (product_image, product_name, type, description, serving_size, price, recommended_pairings, popularity, availability)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssdsss", $targetFilePath, $productName, $type, $description, $servingSize, $price, $recommendedPairings, $popularity, $availability);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Product added successfully.'); window.history.back();</script>";
            header("Location: allproducts.php");
            exit();
        } else {
            echo "<script>alert('Error adding product: " . $stmt->error . "'); window.history.back();</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Error uploading product image.'); window.history.back();</script>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Jia-Kate Coffee</title>
    <meta content="Jia-Kate Coffee" property="title">
    <meta content="https://www.jiakate.com/" property="url">
    <link rel="stylesheet" href="style.css">

    <style>
        .containerProducts {
            width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #61564d;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.25);
        }

        .containerProducts h2 {
            text-align: center;
            color: whitesmoke;
        }

        .containerProducts form {
            margin-top: 20px;
        }

        .containerProducts label {
            display: block;
            margin-bottom: 5px;
            color: white;
            font-weight: bold;
        }

        .containerProducts input[type="text"],
        .containerProducts textarea {
            width: 100%;
            padding: 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            box-sizing: border-box;
            margin-bottom: 10px;
            background-color: transparent;
            color: white;
        }

        .containerProducts select {
            width: 100%;
            padding: 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            box-sizing: border-box;
            margin-bottom: 10px;
            background-color: transparent;
            color: white;
        }

        .containerProducts select option {
            background-color: transparent;
            color: #000000;
        }

        .containerProducts .form-row {
            display: flex;
            justify-content: space-between;
        }

        .containerProducts .form-row .col {
            width: 48%;
        }

        .containerProducts input[type="submit"] {
            width: 100%;
            padding: 8px;
            background-color: #3d1616;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .containerProducts input[type="submit"]:hover {
            background-color: #280f0f;
        }

        .containerProducts textarea {
            resize: vertical;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="navbar">
            <div class="storename">
                <div class="headerTitle">Jia-Kate's Coffee</div>
            </div>
        </div>
    </div>

    <div class="menuMain">
        <div class="containerProducts">
            <h2>Add Coffee Product</h2>
            <form method="POST" action="add_product.php" enctype="multipart/form-data">
                <?php if (isset($product)): ?>
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <?php endif; ?>

                <div class="form-row">
                    <div class="col">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" value="<?php echo isset($product['product_name']) ? $product['product_name'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="type">Type:</label>
                        <select name="type">
                            <option value="hot drinks" <?php if (isset($product['type']) && $product['type'] === 'hot drinks') echo 'selected'; ?>>Hot Drinks</option>
                            <option value="cake" <?php if (isset($product['type']) && $product['type'] === 'cake') echo 'selected'; ?>>Cake</option>
                            <option value="frappe" <?php if (isset($product['type']) && $product['type'] === 'frappe') echo 'selected'; ?>>Frappe</option>
                            <option value="bread" <?php if (isset($product['type']) && $product['type'] === 'bread') echo 'selected'; ?>>Bread</option>
                            <option value="cold drinks" <?php if (isset($product['type']) && $product['type'] === 'cold drinks') echo 'selected'; ?>>Cold Drinks</option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="description">Description:</label>
                        <textarea name="description"><?php echo isset($product['description']) ? $product['description'] : ''; ?></textarea>
                    </div>
                    <div class="col">
                        <label for="recommended_pairings">Recommended Pairings:</label>
                        <textarea name="recommended_pairings"><?php echo isset($product['recommended_pairings']) ? $product['recommended_pairings'] : ''; ?></textarea>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="price">Price:</label>
                        <input type="text" name="price" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="serving_size">Serving Size:</label>
                        <input type="text" name="serving_size" value="<?php echo isset($product['serving_size']) ? $product['serving_size'] : ''; ?>">
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="popularity">Popularity:</label>
                        <select name="popularity">
                            <option value="☆" <?php if (isset($product['popularity']) && $product['popularity'] === '☆') echo 'selected'; ?>>☆</option>
                            <option value="☆☆" <?php if (isset($product['popularity']) && $product['popularity'] === '☆☆') echo 'selected'; ?>>☆☆</option>
                            <option value="☆☆☆" <?php if (isset($product['popularity']) && $product['popularity'] === '☆☆☆') echo 'selected'; ?>>☆☆☆</option>
                            <option value="☆☆☆☆" <?php if (isset($product['popularity']) && $product['popularity'] === '☆☆☆☆') echo 'selected'; ?>>☆☆☆☆</option>
                            <option value="☆☆☆☆☆" <?php if (isset($product['popularity']) && $product['popularity'] === '☆☆☆☆☆') echo 'selected'; ?>>☆☆☆☆☆</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="availability">Availability:</label>
                        <select name="availability">
                            <option value="Available" <?php if (isset($product) && $product['availability'] === 'Available') echo 'selected'; ?>>Available</option>
                            <option value="Not Available" <?php if (isset($product) && $product['availability'] === 'Not Available') echo 'selected'; ?>>Not Available</option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="product_image">Image:</label>
                        <input type="file" name="product_image">
                    </div>
                </div>
                <br>

                <input type="submit" value="Add Product">
            </form>
        </div>
    </div>
</body>
</html>
