<?php
header('Content-Type: text/html; charset=utf-8');

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $productName = $_POST['product_name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $servingSize = $_POST['serving_size'];
    $price = $_POST['price'];
    $recommendedPairings = $_POST['recommended_pairings'];
    $popularity = $_POST['popularity'];
    $availability = $_POST['availability'];

    // Update the product in the database
    $query = "UPDATE coffee_products SET
        product_name = ?,
        type = ?,
        description = ?,
        serving_size = ?,
        price = ?,
        recommended_pairings = ?,
        popularity = ?,
        availability = ?
        WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssdsssi",
        $productName,
        $type,
        $description,
        $servingSize,
        $price,
        $recommendedPairings,
        $popularity,
        $availability,
        $productId
    );
    mysqli_stmt_execute($stmt);

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Retrieve the product details from the database
    $productId = $_GET['id'];
    $query = "SELECT * FROM coffee_products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial scale=1" name="viewport">
    <title>Jia-Kate Coffee</title>
    <meta content="Jia-Kate Coffee" property="title">
    <meta content="https://www.jiakate.com/" property="url">
    <link rel="stylesheet" href="style.css">

    <style>
        .containerProducts {
            width: 900px;
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
        .current-image {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .current-image img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 50%;
        }
        .preview {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: whitesmoke;
        }
        .preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 50%;
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
        <a href="#" onclick="goBack()" class="buttonBack">&#10094;</a>
            <h2>Modify Product</h2><br>

            <div class="current-image">
                <img src="<?php echo $product['product_image']; ?>" alt="Current Image">
            </div><br>

            <form method="POST" action="update_product.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                <div class="form-row">
                    <div class="col">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>">
                    </div>
                    <div class="col">
                        <label for="type">Type:</label>
                        <select type="text" name="type">
                            <option value="hot drinks" <?php if ($product['type'] === 'hot drinks') echo 'selected'; ?>>Hot Drinks</option>
                            <option value="cake" <?php if ($product['type'] === 'cake') echo 'selected'; ?>>Cake</option>
                            <option value="frappe" <?php if ($product['type'] === 'frappe') echo 'selected'; ?>>Frappe</option>
                            <option value="bread" <?php if ($product['type'] === 'bread') echo 'selected'; ?>>Bread</option>
                            <option value="cold drinks" <?php if ($product['type'] === 'cold drinks') echo 'selected'; ?>>Cold Drinks</option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="description">Description:</label>
                        <textarea name="description"><?php echo $product['description']; ?></textarea>
                    </div>
                    <div class="col">
                        <label for="recommended_pairings">Recommended Pairings:</label>
                        <textarea name="recommended_pairings"><?php echo $product['recommended_pairings']; ?></textarea>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="price">Price:</label>
                        <input type="text" name="price" value="<?php echo $product['price']; ?>">
                    </div>
                    <div class="col">
                        <label for="serving_size">Serving Size:</label>
                        <input type="text" name="serving_size" value="<?php echo $product['serving_size']; ?>">
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="popularity">Popularity:</label>
                        <select name="popularity">
                            <option value="☆" <?php if ($product['popularity'] === '☆') echo 'selected'; ?>>☆</option>
                            <option value="☆☆" <?php if ($product['popularity'] === '☆☆') echo 'selected'; ?>>☆☆</option>
                            <option value="☆☆☆" <?php if ($product['popularity'] === '☆☆☆') echo 'selected'; ?>>☆☆☆</option>
                            <option value="☆☆☆☆" <?php if ($product['popularity'] === '☆☆☆☆') echo 'selected'; ?>>☆☆☆☆</option>
                            <option value="☆☆☆☆☆" <?php if ($product['popularity'] === '☆☆☆☆☆') echo 'selected'; ?>>☆☆☆☆☆</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="availability">Availability:</label>
                        <select name="availability">
                            <option value="Available" <?php if ($product['availability'] === 'Available') echo 'selected'; ?>>Available</option>
                            <option value="Not Available" <?php if ($product['availability'] === 'Not Available') echo 'selected'; ?>>Not Available</option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="image">Image:</label>
                        <input style="color: whitesmoke;" type="file" name="image">
                    </div>
                </div>
                <br>

                <input type="submit" value="Modify">
            </form>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>