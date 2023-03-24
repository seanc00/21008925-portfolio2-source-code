<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="device-width, initial-scale=1.0">
        <title>BIBI Books</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="header">
            <a href="index.php" class="logo"><span class="leftName">BIBI</span> <span class="rightName">Books</span></a>
            <div class="headerRight">
              <a href="index.php">Home</a>
              <a href="shop.php">Shop</a>
              <a href="cart.php">Cart</a>
            </div>
          </div>

          <?php
            //connects to local database shoppingcart
            $conn = mysqli_connect("localhost", "root", "root", "shoppingcart");
            //ensures database is connected
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }          

            $sql = "SELECT * FROM x";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
              <div id="productContainer">
                <div id="formContainer">
                  <div id="containerLeft">
                    <img src="<?php echo $row['img']; ?>">
                    <h1> <?php echo $row['name']; ?> </h1>
                  </div>
                  <div id="containerRight">
                    <p id="price">£ <?php echo $row['price']; ?> </p>
                    <p id="itemQuantityCart">Quantity: <?php echo $row['quantity']; ?> </p>
                    <form action="removeItem.php" method="post">
                    <button id="addToCartButton" type="submit">Remove Item</button>
                    <br>
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </br>
                    </form>
                  </div>
                </div>
              </div>

          <?php
            }
          } else {
            echo "
              <div id='noProductMessageContainer'
                <p>There isn't anything in your basket!</p>
              </div>
              ";
          }
          
          
          ?>





    </body>
</html>