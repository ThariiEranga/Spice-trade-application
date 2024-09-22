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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add products</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

<!-- Favicons -->
<link href="assets/img/logo.jpg" rel="icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
      <a href="index1.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block"> Add Products</span>
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
      <h1>Add product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="index1.php">Dashboard</a></li>
          <li class="breadcrumb-item "><a href="products.php">Products</a></li>
          <li class="breadcrumb-item active">Add products</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="card">
            <div class="card-body">
                <br>
              <!-- Horizontal Form -->
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Product name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="product_name" id="inputText">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Image 1</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="files[]" id="formFile">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">image 2</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="files[]" id="formFile">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">image 3</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="files[]" id="formFile">
                  </div>
                </div>
                <div class="input-group mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Price</label>
                      <span class="input-group-text">Rs</span>
                      <input type="text" class="form-control" name="price" aria-label="Amount (to the nearest dollar)">
                      <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="submit">Add product</button>
                </div>
                <br>
              </form><!-- End Horizontal Form -->

            </div>
          </div>
          
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

</body>

</html>
<?php
if(isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $image_paths = array();
    $uploadOk = 1;

    // Process each uploaded file
    for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
        $file_name = $_FILES['files']['name'][$i];
        $target_file = $target_dir . basename($file_name);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['files']['tmp_name'][$i]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
             echo "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['files']['size'][$i] > 5000000) {
             echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, $allowed_types)) {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // Upload file if no errors
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_file)) {
                // echo "The file " . htmlspecialchars(basename($file_name)) . " has been uploaded.<br>";
                $image_paths[] = $target_file;
            } else {
                 echo "Sorry, there was an error uploading your file.<br>";
                $uploadOk = 0;
            }
        }
    }

    // Insert into database if images uploaded successfully
    if ($uploadOk == 1 && count($image_paths) == 3) {
        $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
        $price = mysqli_real_escape_string($connect, $_POST['price']);

        // Insert into database
        $sql = "INSERT INTO products (title, image1, image2, image3, price) VALUES ('$product_name', '$image_paths[0]', '$image_paths[1]', '$image_paths[2]', '$price')";
        if (mysqli_query($connect, $sql)) {
            // echo "Product added successfully.<br>";
            echo '<script>alert("Product added!"); window.location.href = "products.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
}
mysqli_close($connect);
?>