<?php
  header("Location: cart.php");
  $conn = mysqli_connect("localhost", "root", "root", "shoppingcart");
  $id = $_POST['id'];

  if (isset($_POST['id'])) {
    $query = "DELETE FROM X WHERE id=?";
    $result = $conn->prepare($query);
    $result->bind_param("i", $id);
    $result->execute();

    if ($result->error) {
      echo "Error removing item from cart: " . $result->error;
    }
  }

  $conn->close();
?>