<?php
                    $mysqli = new mysqli("localhost", "root", "", "cafe");
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        exit();
                    }

                    // Prepare and bind the parameters
                    $stmt = $mysqli->prepare("INSERT INTO jiakatestocks (`Item ID`, `Item Name`, `Category`, `Price`, `Status`, `Stock Count`) VALUES (?,?,?,?,?,?)");
                    $stmt->bind_param("ississ", $_POST['itemid'], $_POST['itemname'], $_POST['category'], $_POST['price'], $_POST['status'], $_POST['stockcount']);

                    // Execute the statement
                    if ($stmt->execute() === TRUE) {
                        echo "";
                        // Redirect to stocks.php
                        header("Location: stocks.php");
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    // Close the statement and connection
                    $stmt->close();
                    $mysqli->close();
                    ?>