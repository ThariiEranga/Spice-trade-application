<?php
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['id']) && isset($_POST['price'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    
    $updatequery = "UPDATE products SET price = '$price' WHERE id = $id;";
    $runquery = mysqli_query($connect, $updatequery);
    
    if ($runquery) {
        echo 'success';
    } else {
        echo 'error';
    }
  }
}

mysqli_close($connect);
?>