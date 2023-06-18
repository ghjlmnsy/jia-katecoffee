<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Jia-Kate's Coffee Admin Page</title>
    <meta content="Jia-Kate's Coffee Admin Page" property="title">
    <meta content="https://www.jiakate.com/" property="url">
    <link rel="stylesheet" href="style.css">
    <style>
    /* CSS for the card layout */
    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .card {
      display: flex;
      flex-basis: 20%;
      flex-direction: column;
      align-items: center;
      width: 200px;
      padding: 10px;
      margin: 10px;
      text-align: center;
    }

    .card img {
      width: 80%;
      border-radius: 200px;
      margin-bottom: 10px;
      text-shadow: #00000075;
    }

    .card img:hover {
        transform: translateY(-5px);
    }

    .card h3 {
      margin: 12px;
      font-family: "Arial";
      font-style: italic;
      color: white;
    }

    .card p {
      margin-top: 17px;
      font-family: "Arial"; /* Apply the universal font */
      font-size: 14px; /* Adjust the font size to small text */
      line-height: 30px;
    }
  </style>
</head>
<body>
    <div class="header">
        <div class="navbar">
            <div class="storename">
                <div class="headerTitle">Jia-Kate's Coffee</div>
            </div>
            <nav>
                <ul>
                    <li><a href="home.html" style="font-family:bodyFont">Home</a></li>
                    <li><a href="products.php" style="font-family:bodyFont">Products</a></li>
                    <li><a href="stocks.php" style="font-family:bodyFont">Stocks</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="header">
        <div class="menuMain">
            <div class="containerProducts">
                <a href="home.html" class="buttonBack">&#10094;</a>
                <h2>Record of Products</h2><br>
                <div style="text-align:center;">
                    <a href="allproducts.php" class="buttonAdd">All</a>
                    <a href="products.php" class="buttonAdd">Hot Drinks</a>
                    <a href="cake.php" class="buttonAdd">Cake</a>
                    <a href="frappe.php" class="buttonAdd">Frappe</a>
                    <a href="bread.php" class="buttonAdd">Bread</a>
                    <a href="cold.php" class="buttonAdd">Cold Drinks</a>
                    <a href="add_product.php" class="prodAdd"> + </a>
                </div>
                <h3 class="category">Cold Drinks</h3>

                <div class="card-container">
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

                    // Fetch data from the database table (replace 'your_table' with the actual table name)
                    $sql = "SELECT * FROM coffee_products WHERE type = 'cold drinks'";
                    $result = $conn->query($sql);

                    // Display the data in cards
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='card'>";
                            echo "<img src='" . $row['product_image'] . "' alt=''>";
                            echo "<h3>" . $row['product_name'] . "</h3>";
                            echo "<p>" . $row['description'] . "</p>";
                            echo "<p><strong>Recommended Pair:</strong> " . $row['recommended_pairings'] . "</p>";
                            echo "<p><strong>PHP " . $row['price'] . "</strong></p>";
                            echo "<p><strong>" . $row['availability'] . "</strong></p>";
                            echo "<p style='font-size: 22px;'><strong>" . $row['popularity'] . "</strong></p>";
                            echo "<div class='button-container'>";
                            echo "<a class='buttonAdd' href='modify_product.php?id=" . $row['id'] . "'>Modify</a>";
                            echo " <a class='buttonAdd' href='delete_product.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No cake products found.";
                    }
                    

                    // Close the database connection
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
        <div class="footer">
            <footer>
                <div class="footer_item">
                    <h2 class="smalltxt">ABOUT US</h2>
                    <ul>
                        <li><a href="#" class="smalltext2 footer_link">Facebook</a></li>
                        <li><a href="#" class="smalltext2 footer_link">Twitter</a></li>
                        <li><a href="#" class="smalltext2 footer_link">Instagram</a></li>
                    </ul>
                </div>
                <div class="footer_item">
                    <h2 class="smalltxt">UPDATES</h2>
                    <ul>
                        <li><a href="#" class="smalltext2 footer_link">Lorem, ipsum dolor.</a></li>
                        <li><a href="#" class="smalltext2 footer_link">Lorem, ipsum dolor.</a></li>
                        <li><a href="#" class="smalltext2 footer_link">Lorem, ipsum dolor.</a></li>
                    </ul>
                </div>
                <div class="footer_item">
                    <h2 class="smalltxt">REWARDS</h2>
                    <ul>
                        <li><a href="#" class="smalltext2 footer_link">Lorem, ipsum dolor.</a></li>
                        <li><a href="#" class="smalltext2 footer_link">Lorem, ipsum dolor.</a></li>
                        <li><a href="#" class="smalltext2 footer_link">Lorem, ipsum dolor.</a></li>
                    </ul>
                </div>
            </footer>
            <div class="footer_item" id="f2">
                <h5 class="smalltxt">© 2023  All rights reserved. Developed by Gerasta, Riana & Suyman, Ann.</h5>
            </div>
        </div>
    </div>
</body>
</html>
