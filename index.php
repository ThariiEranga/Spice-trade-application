<?php
include 'connect.php'; 

session_start();

$sql_products = "SELECT * FROM products;";
$result_products = mysqli_query($connect, $sql_products);

$products_html = '<style>
        .carousel-item img {
            width: 100%;
            height: 250px; /* Set the desired height */
            object-fit: cover; /* Ensure images cover the area while maintaining aspect ratio */
        }
    </style>';

if ($result_products && mysqli_num_rows($result_products) > 0) {
  while ($product = mysqli_fetch_assoc($result_products)) {
    $products_html .= '<div class="card" style="width: 18rem; margin: 20px;">';
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
    $products_html .= '<h5 class="card-title">' . $product['title'] . '</h5>';
    $products_html .= '<p class="card-text">Price: ' . $product['price'] . '</p>';
    $products_html .= '<a href="#?id=' . $product['id'] . '" class="btn-getstarted">Add to Cart</a>';
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
  <title>Ceylon Spice Traders</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.jpg" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Ceylon Spice Traders</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#menu">Products</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="<?php echo isset($_SESSION['uid']) ? 'index1.php' : 'pages-login.php'; ?>">Admin</a>


    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Your Gateway to Authentic <br>Sri Lankan Flavors</h1>
            <p data-aos="fade-up" data-aos-delay="100">We are spreading Sri Lankan authentic spices all around the world</p>
            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
              <a href="#menu" class="btn-get-started">Check products</a>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <p><span>Learn More</span> <span class="description-title">About Us</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid mb-4" alt="">
          </div>
          <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                Ceylon Spice Traders is the legacy of a company founded in 2022. A visionary entrepreneur with a keen eye into the future, set out to create an export market for his authentic Sri Lankan spices which quickly caught the attention of the World.
              </p>
              <h3>Mission</h3>
              <ul>
                <li><i class="bi bi-check-circle-fill"></i> <span>Ensuring food safety to the end consumer.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Adhering to sustainable production & processing.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Assisting Sri Lankan farmers gain exposure to the world market and help improve their production standards.</span></li>
              </ul>
            
              <div class="position-relative mt-4">
                <img src="assets/img/about-2.png" class="img-fluid" alt="">
                <a href="https://youtu.be/k6IXeXRQJ1k?si=I7hRzwTA6mx6ExJn" class="glightbox pulsating-play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section dark-background">

      <img src="assets/img/hero-background.jpg" alt="" data-aos="fade-in">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
              <p>Clients</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="21" data-purecounter-duration="1" class="purecounter"></span>
              <p>Products</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Menu Section -->
    <section id="menu" class="menu section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <p><span>Check</span> <span class="description-title"> Our Products</span></p>
      </div><!-- End Section Title -->
      <div class="container">
        <div class="row">
          <?php echo $products_html; ?>
        </div>
      </div>
          </div><!-- End Starter Menu Content -->
        </div>

      </div>

    </section><!-- /Menu Section -->
  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>No 21</p>
            <p>Tennekumbura</p>
            <p>Kandy, Sri lanka</p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>+94 11 111 1111</span><br>
              <strong>Email:</strong> <span>info@example.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Ceylon Spice Traders</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>