<?php
include 'connect.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  $delete_id = $_POST['delete_id'];
  
  $delete_query = "DELETE FROM products WHERE id = $delete_id;";
  $delete_result = mysqli_query($connect, $delete_query);
  
  if ($delete_result) {
      echo 'success';
  } else {
      echo 'error';
  }
}


mysqli_close($connect);
?>
