<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/inventory-management/content/main.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>E-Commerce Header</title>
</head>
<body>
  

  <header class="bg-white border-bottom py-3">
  <div class="container d-flex justify-content-between align-items-center">
    <a href="#" class="navbar-brand fw-bold fs-4">ShopEase</a>
    <nav class="d-none d-md-block">
      <ul class="nav">
        <li class="nav-item"><a class="nav-link text-dark" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#shop">Shop</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#contact">Contact</a></li>
      </ul>
    </nav>
    <div class="d-flex align-items-center gap-3">
      <form class="d-flex d-none d-md-flex">
        <input type="text" class="form-control" placeholder="Search products..." />
        <button class="btn btn-primary ms-2">🔍</button>
      </form>
      <a href="#account" class="text-dark fs-5">👤</a>
      <a href="#wishlist" class="text-dark fs-5">❤️</a>
      <a href="#cart" class="text-dark position-relative fs-5">🛒
        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">2</span>
      </a>
    </div>
  </div>
</header>

  <main class="main">
  <section class="hero">
    <div class="hero-text">
      <h1>Discover Your Style</h1>
      <p>Shop the latest trends with amazing deals.</p>
      <a href="#shop" class="btn">Shop Now</a>
    </div>
  </section>

  <section class="categories">
    <h2>Shop by Category</h2>
    <div class="category-grid">
      <div class="category-item">
        <img src="category1.jpg" alt="Category 1">
        <h3>Men's Fashion</h3>
      </div>
      <div class="category-item">
        <img src="category2.jpg" alt="Category 2">
        <h3>Women's Fashion</h3>
      </div>
      <div class="category-item">
        <img src="category3.jpg" alt="Category 3">
        <h3>Electronics</h3>
      </div>
      <div class="category-item">
        <img src="category4.jpg" alt="Category 4">
        <h3>Home & Living</h3>
      </div>
    </div>
  </section>

  <section class="products">
    <h2>Featured Products</h2>
    <div class="product-grid">
      <div class="product-item">
        <img src="product1.jpg" alt="Product 1">
        <h3>Product Name</h3>
        <p>$49.99</p>
        <a href="#cart" class="btn">Add to Cart</a>
      </div>
      <div class="product-item">
        <img src="product2.jpg" alt="Product 2">
        <h3>Product Name</h3>
        <p>$79.99</p>
        <a href="#cart" class="btn">Add to Cart</a>
      </div>
      <div class="product-item">
        <img src="product3.jpg" alt="Product 3">
        <h3>Product Name</h3>
        <p>$99.99</p>
        <a href="#cart" class="btn">Add to Cart</a>
      </div>
      <div class="product-item">
        <img src="product4.jpg" alt="Product 4">
        <h3>Product Name</h3>
        <p>$59.99</p>
        <a href="#cart" class="btn">Add to Cart</a>
      </div>
    </div>
  </section>
</main>

<footer class="footer">
  <div class="container">
    <div class="footer-about">
      <h3>ShopEase</h3>
      <p>Your one-stop shop for the latest trends and amazing deals. Shop with confidence and style.</p>
    </div>
    <div class="footer-links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#shop">Shop</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div>
    <div class="footer-contact">
      <h4>Contact Us</h4>
      <ul>
        <li>Email: support@shopease.com</li>
        <li>Phone: +123 456 7890</li>
        <li>Address: 123 Market Street, NY</li>
      </ul>
    </div>
    <div class="footer-social">
      <h4>Follow Us</h4>
      <div class="social-icons">
        <a href="#facebook"><i class="fa-brands fa-facebook"></i></a>
        <a href="#twitter"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="#instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2024 ShopEase. All rights reserved.</p>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
