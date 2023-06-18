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
    $itemid = $_POST['itemid'];

    // Execute SELECT query to fetch the record
    $selectQuery = "SELECT * FROM jiakatestocks WHERE `Item ID` = $itemid";
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (isset($_POST['submit'])) {
            $updateditemid = $_POST['updateditemid'];
            $itemname = $_POST['ItemName'];
            $category = $_POST['Category'];
            $status = $_POST['availability'];
            $price = isset($_POST['price']) ? $_POST['price'] : '';
            $price = floatval($price);
            $stockcount = $_POST['StockCount'];

            $sql = "UPDATE jiakatestocks SET `Item ID`=?, `Item Name`=?, `Category`=?, `Price`=?, `Status`=?, `Stock Count`=? WHERE `Item ID`=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ississs", $updateditemid, $itemname, $category, $price, $status, $stockcount, $itemid);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Record updated successfully.";
                header("Location: stocks.php");
                exit();
            } else {
                echo "Failed to update the record.";
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "No record found for the given Item ID.";
        header("Location: stocks.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta content="width=device-width, initial scale=1" name="viewport">
    <title>Jia-Kate Coffee</title>
    <meta content="Jia-Kate Coffee" property="title">
    <meta content="https://www.jiakate.com/" property="url">
    <link rel="stylesheet" href="style.css">

    <style>
    .containerProducts {
        width: 700px;
        margin: 15px auto 0;
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
        margin-top: 15px;
    }

    .containerProducts label {
        display: block;
        margin-bottom: 5px;
        color: white;
        font-weight: bold;
    }

    .containerProducts input[type="text"],
    .containerProducts input[type="number"],
    .containerProducts textarea{
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
            <h2>Update Record of Stocks</h2>
            <br><br>
            <form method="POST" action="updatestocks.php" enctype="multipart/form-data">
                <input type="hidden" name="itemid" value="<?php echo $row['Item ID']; ?>">

                <div class="form-row">
                    <div class="col">
                        <label for="updateditemid">Item ID:</label>
                        <input type="number" id="updateditemid" name="updateditemid" value="<?php echo $row['Item ID']; ?>">
                    </div>
                    <div class="col">
                        <label for="ItemName">Item Name:</label>
                        <input type="text" id="ItemName" name="ItemName" value="<?php echo $row['Item Name']; ?>">
                    </div>
                </div>
                <br><br>

                <div class="form-row">
                    <div class="col">
                        <label for="Category">Category:</label>
                        <input type="text" id="Category" name="Category" value="<?php echo $row['Category']; ?>">
                    </div>
                    <div class="col">
                        <label for="price">Price:</label>
                        <input type="number" step="0.01" name="price" value="<?php echo isset($row['Price']) ? $row['Price'] : ''; ?>">
                    </div>
                </div>
                <br><br>

                <div class="form-row">
                    <div class="col">
                        <label for="StockCount">Stock Count:</label>
                        <input type="text" id="StockCount" name="StockCount" value="<?php echo $row['Stock Count']; ?>">
                    </div>
                    <div class="col">
                        <label for="Status">Status:</label>
                        <select name="availability">
                            <option value="Available" <?php if ($row['Status'] === 'Available') echo 'selected'; ?>>Available</option>
                            <option value="Out of Stock" <?php if ($row['Status'] === 'Out of Stock') echo 'selected'; ?>>Out of Stock</option>
                        </select>
                    </div>
                </div>
                <br>
                <input type="submit" name="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
