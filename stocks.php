<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial scale=1" name="viewport">
    <title>Jia-Kate's Coffee Admin Page</title>
    <meta content="Jia-Kate's Coffee Admin Page" property="title">
    <meta content="https://www.jiakate.com/" property="url">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <div class="navbar">
            <div class="storename">
                <div class="headerTitle">jia-kate's coffee</div>
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
                <h2>Record of Stocks</h2><br>
                <div style="text-align:center;">
                    <button class="buttonAdd" onclick="openAForm()">Append</button>
                    <button class="buttonAdd" onclick="openForm()">Delete</button>
                    <button class="buttonAdd" onclick="openUForm()">Update</button>
                </div>

                <div class="form-popup" id="myAForm">
                    <form method="POST" action="appendstocks.php" class="form-container">
                        <label><b style="color: white;">New Stock:</b></label>
                        <input type="number" placeholder="Item ID" name="itemid" id="itemid" required>
                        <input type="text" placeholder="Item Name" name="itemname" id="itemname" required>
                        <input type="text" placeholder="Category" name="category" id="category" required>
                        <input type="number" step="0.01" placeholder="Price" name="price" id="price" required>
                        <input type="text" placeholder="Status" name="status" id="status" required>
                        <input type="text" placeholder="Stock Count" name="stockcount" id="stockcount" required>

                        <button type="submit" class="btn">Add</button>
                        <button type="button" class="btn cancel" onclick="closeAForm()">Close</button>
                    </form>
                </div>

                <div class="form-popup" id="myForm">
                    <form method="POST" action="deletestocks.php" class="form-container">
                        <label for="itemid"><b style="color: white;">Item ID</b></label>
                        <input type="number" placeholder="Enter Item ID" name="itemid" id="itemid" required>

                        <button type="submit" class="btn">Delete</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                </div>

                <div class="form-popup" id="myUForm">
                    <form method="POST" action="updatestocks.php" class="form-container">
                        <label for="itemid"><b style="color: white;">Item ID</b></label>
                        <input type="number" placeholder="Enter Item ID" name="itemid" id="itemid" required>

                        <button type="submit" class="btn">Search</button>
                        <button type="button" class="btn cancel" onclick="closeUForm()">Close</button>
                    </form>
                </div>

                <div>
                <?php
                    $mysqli = new mysqli("localhost", "root", "", "cafe");
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        exit();
                    }

                    $query = "SELECT * FROM jiakatestocks";
                    $labels = ["Item ID", "Item Name", "Category", "Price", "Status", "Stock Count"];

                    echo '<table class="table">';
                    echo '<tr>';
                    foreach ($labels as $index => $label) {
                        if ($index === 0) {
                            echo '<th style="text-align: left;">' . $label . '</th>';
                        } else {
                            echo '<th style="text-align: center;">' . $label . '</th>';
                        }
                    }
                    echo '</tr>';

                    if ($result = $mysqli->query($query)) {
                        while ($row = $result->fetch_assoc()) {
                            $itemid = $row["Item ID"];
                            $itemname = $row["Item Name"];
                            $category = $row["Category"];
                            $price = $row["Price"];
                            $status = $row["Status"];
                            $stockcount = $row["Stock Count"];

                            echo '<tr>
                                <td>' . $itemid . '</td>
                                <td style="text-align: center;">' . $itemname . '</td>
                                <td style="text-align: center;">' . $category . '</td>
                                <td style="text-align: center;">' . $price . '</td>
                                <td style="text-align: center;">' . $status . '</td>
                                <td style="text-align: center;">' . $stockcount . '</td>
                            </tr>';
                        }
                        $result->free();
                    }
                    ?>
                        <table>
                        </table>
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
                <h5 class="smalltxt">© 2023 All rights reserved. Developed by Gerasta, Riana & Suyman, Ann.</h5>
            </div>
        </div>
    </div>
    <script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function openUForm() {
        document.getElementById("myUForm").style.display = "block";
    }

    function openAForm() {
        document.getElementById("myAForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    function closeUForm() {
        document.getElementById("myUForm").style.display = "none";
    }

    function closeAForm() {
        document.getElementById("myAForm").style.display = "none";
    }
    </script>
</body>

</html>
