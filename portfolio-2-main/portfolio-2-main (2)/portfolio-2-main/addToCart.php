<?php

header("Location: cart.php");
$conn = mysqli_connect("localhost", "root", "root", "shoppingcart");
$productName = $_POST['name'];
$productPrice = $_POST['price'];
$quantity = $_POST['quantity'];
$img = $_POST['img'];

if (isset($_POST['name'], $_POST['price'], $_POST['quantity'])) {
  $query = "INSERT INTO X (name, img, price, quantity) VALUES (?,?,?,?)";
  $result = $conn->prepare($query);
  $result->bind_param("ssdi", $productName,$img, $productPrice, $quantity);
  $result->execute();

  if ($result->error) {
    echo "Error adding data to cart:" . $result->error;
  }
}

$conn->close()



?>