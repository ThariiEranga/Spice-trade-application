<?php
include 'connect.php'; 

session_start();

if (!isset($_SESSION["uid"])) {
  header("Location: pages-login.php");
  exit;
}

$id = $_SESSION['uid'];
$sql2 = "SELECT * FROM admins WHERE userid = $id;";
$result2 = mysqli_query($connect, $sql2);

if ($result2 && mysqli_num_rows($result2) == 1) {
  $row = mysqli_fetch_assoc($result2);
  $name = $row['name'];
  $email = $row['email'];
  $Username = $row['username'];
} else {
  echo "User details not found.";
}

$sql_products = "SELECT * FROM products;";
$result_products = mysqli_query($connect, $sql_products);

$products_html = '<style>
        .carousel-item img {
            width: 100%;
            height: 300px; /* Set the desired height */
            object-fit: cover; /* Ensure images cover the area while maintaining aspect ratio */
        }
    </style>';

if ($result_products && mysqli_num_rows($result_products) > 0) {
  while ($product = mysqli_fetch_assoc($result_products)) {
    $products_html .= '<div class="card" style="width: 18rem; margin: 20px;">';
    $products_html .= '<form method="POST" onsubmit="updateProduct(event, ' . $product['id'] . ');">';
    $products_html .= '<input type="hidden" name="id" value="' . $product['id'] . '">';
    $products_html .= '<div id="carousel' . $product['id'] . '" class="carousel slide" data-bs-ride="carousel">';
    $products_html .= '<div class="carousel-inner">';
    $products_html .= '<div class="carousel-item active"><img src="' . $product['image1'] . '" class="d-block w-100" alt="..."></div>';
    $products_html .= '<div class="carousel-item"><img src="' . $product['image2'] . '" class="d-block w-100" alt="..."></div>';
    $products_html .= '<div class="carousel-item"><img src="' . $product['image3'] . '" class="d-block w-100" alt="..."></div>';
    $products_html .= '</div>';
    $products_html .= '<button class="carousel-control-prev" type="button" data-bs-target="#carousel' . $product['id'] . '" data-bs-slide="prev">';
    $products_html .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
    $products_html .= '<span class="visually-hidden">Previous</span>';
    $products_html .= '</button>';
    $products_html .= '<button class="carousel-control-next" type="button" data-bs-target="#carousel' . $product['id'] . '" data-bs-slide="next">';
    $products_html .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
    $products_html .= '<span class="visually-hidden">Next</span>';
    $products_html .= '</button>';
    $products_html .= '</div>';
    $products_html .= '<div class="card-body">';
    $products_html .= '<div class="mb-3">';
    $products_html .= '<h5 class="card-title">' . $product['title'] . '</h5>';
    $products_html .= '<label for="price' . $product['id'] . '" class="form-label">Price (per 1kg) </label>';
    $products_html .= '<input type="text" class="form-control" id="price' . $product['id'] . '" name="price" value="' . $product['price'] . '">';
    $products_html .= '</div>';
    $products_html .= '<button type="submit" name="update" class="btn btn-primary">Update Product</button>';
    $products_html .= '</div>';
    $products_html .= '</form>';
    $products_html .= '<div class="card-body">';
    $products_html .= '<form method="POST" onsubmit="deleteProduct(event, ' . $product['id'] . ');">';
    $products_html .= '<input type="hidden" name="delete_id" value="' . $product['id'] . '">';
    $products_html .= '<button type="submit" name="delete" class="btn btn-danger">Delete Product</button>';
    $products_html .= '</form>';
    $products_html .= '</div>';
    $products_html .= '</div>';
  }
} else {
  $products_html = '<p>No products found.</p>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>products</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons --> 
   <link href="assets/img/logo.jpg" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="products.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Products</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo isset($name) ? $name : ''; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo isset($name) ? $name : ''; ?></h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="index1.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" id="sidebar-nav" href="products.php">
          <i class="bi bi-menu-button-wide"></i><span> Products</span>
        </a>
      </li><!-- End Components Nav -->
      <li class="nav-item">
      <a class="nav-link " href="users-profile.php">
      <i class="bi bi-grid"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="index1.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <button type="button" class="btn btn-outline-primary"><a href="add-product.php" style="text-decoration:none"> Add
          product</a> </button>
      <div class="container">
        <div class="row">
          <?php echo $products_html; ?>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main1.js"></script>
  <script>
    function updateProduct(event, productId) {
      event.preventDefault();
      
      let price = document.getElementById('price' + productId).value;
      
      // AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'update-product.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status == 200) {
          window.location.href = "products.php"; 
        } else {
          alert('Failed to update product.');
        }
      };
      xhr.send('id=' + productId + '&price=' + price);
    }

    function deleteProduct(event, productId) {
      event.preventDefault();
      
      // AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'delete-product.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status == 200) {
          window.location.href = "products.php"; 
        } else {
          alert('Failed to delete product.');
        }
      };
      xhr.send('delete_id=' + productId);
    }
  </script>

</body>

</html>

<?php
mysqli_close($connect);
?>