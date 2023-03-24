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

    <!--
      php to connect database and ensure database is made
    -->
    <?php


      //connects to local database 
      $conn = mysqli_connect("localhost", "root", "root", "shoppingcart");
      //checks to see if database is connected
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      //creates database shopping cart
      $sql = "CREATE DATABASE IF NOT EXISTS shoppingcart";
      mysqli_query($conn, $sql) or die(mysqli_error($conn));
      
      //close connection
      mysqli_close($conn);
    ?>

    <!--
      Then prepopulated said database with this code:

      CREATE TABLE IF NOT EXISTS `products` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(200) NOT NULL,
      `price` decimal(7,2) NOT NULL,
      `quantity` int(11) NOT NULL,
      `img` text NOT NULL,
      PRIMARY KEY (`id`)
      );

      INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `img`) VALUES
      (1, 'All The Light We Cannot See', '16.99', '1000', 'all-the-light-we-cannot-see.webp' ),
      (2, 'Pride and Prejudice', '24.99', '1000', 'pride-and-prejudice.jpg' ),
      (3, 'Surrounded By Idiots', '19.99', '1000', 'surrounded-bhy-idiots.png' ),
      (4, 'The Color Purple', '22.99', '1000', 'the-color-purple.jpeg' ),
      (5, 'The Power of Letting Go', '22.99', '1000', 'the-power-of-letting-go.png' ),
      (6, 'Where The Crawdads Sing', '27.99', '1000', 'where-the-crawdads-sing.jpg' );
    -->

    <!--
      php to connect to created database and acces products table
    -->
    <?php
        //connects to local database shoppingcart
        $conn = mysqli_connect("localhost", "root", "root", "shoppingcart");
        //ensures database is connected
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        //selects data from table product with query
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div id="productContainer">
        <form id="formContainer" action="addToCart.php" method="post">
          <div id="containerLeft">
            <h1 id="bookTitle"><?php echo $row['name' ]; ?></h1>
            <img id="bookCoverShop" src="<?php echo $row['img']; ?>">
          </div>
          <div id="containerRight">
            <p id="price" >£<?php echo $row['price']; ?></p>
            <input id="itemQuantity" type="number" name="quantity" value="1" min="1">
            <button id="addToCartButton" type="submit">Add To Cart</button>
          </div>
          <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
          <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
          <input type="hidden" name="img" value="<?php echo $row['img']; ?>">
        </form>
    </div>

      <?php
        }
        }else {
            echo "No Products in basket!";
          }
      ?>

    <div class="returnToTop">
        <div>
          <a class="returnButton" href="#">Return to top</a>
        </div>
      </div>

  </body>
</html>