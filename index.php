<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toothy Treats - Sweet Delights</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gradient-to-br from-pink-100 to-blue-100">

  <nav class="candy-gradient shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <a href="index.php" class="text-3xl font-bold text-white">Toothy Treats</a>
          </div>
        </div>
        <div class="md:hidden">
          <button type="button" onclick="toggleMobileMenu()" class="text-white hover:text-pink-200 focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
        <div class="hidden md:block">
          <div class="ml-10 flex items-center space-x-8">
            <a href="index.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">Home</a>
            <a href="about.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">About</a>
            <a href="products.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">Products</a>
            <a href="contact.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">Contact Us</a>
          </div>
        </div>
      </div>
      <div id="mobile-menu" class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
          <a href="index.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">Home</a>
          <a href="about.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">About</a>
          <a href="products.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">Products</a>
          <a href="contact.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">Contact Us</a>
        </div>
      </div>
    </div>
  </nav>

  <section class="relative min-h-screen px-4">
    <div class="absolute inset-0">
      <img src="https://www.shutterstock.com/image-photo/colorful-lollipops-different-colored-round-600nw-1960556065.jpg" alt="Candy Background" class="w-full h-full object-cover object-center">
      <div class="absolute inset-0 bg-gradient-to-r from-pink-600/70 to-blue-600/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto h-screen flex flex-col justify-center items-center text-center">
      <h1 class="text-6xl font-bold text-white mb-6">Welcome to Toothy Treats</h1>
      <p class="text-2xl text-white mb-8">Indulge in our sweetest creations</p>
      <a href="products.php" class="inline-flex items-center px-8 py-4 rounded-lg text-lg font-semibold bg-pink-500 text-white hover:bg-pink-600 shadow-lg hover:shadow-xl border-2 border-white">
        <span>See our products</span>
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  </section>

  <section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-lg shadow-lg">
          <h3 class="text-2xl font-bold text-primary mb-4">Our Story</h3>
          <p class="text-gray-600">It's been 10 sweet years since Toothy Treats began, and we've brought smiles to thousands with our candies! The journey hasn't always been easy, but seeing people enjoy and keep coming back for our treats makes it all worth it.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-lg">
          <h3 class="text-2xl font-bold text-secondary mb-4">Our Mission</h3>
          <p class="text-gray-600">It's our mission to bring joy and sweetness to your life through our carefully crafted treats. For 10 years, we've been proud to share every bite with thousands who continue to support us.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-lg">
          <h3 class="text-2xl font-bold text-primary mb-4">Our Products</h3>
          <p class="text-gray-600">Our treats are made with the finest ingredients — from chewy gummies and sour belts to rich chocolates and lollipops. Each product is crafted to satisfy every sweet craving and spread a little happiness in every pack.</p>
        </div>
      </div>
      <div class="mt-12 text-center">
        <h3 class="text-2xl font-bold text-primary mb-4">Have Questions?</h3>
        <p class="text-gray-600 mb-6">Find answers to commonly asked questions about our products and services.</p>
        <a href="contact.php#faq" class="inline-flex items-center justify-center px-8 py-3 rounded-lg text-lg font-semibold bg-pink-600 text-white hover:bg-pink-700 transition duration-300 shadow-lg hover:shadow-xl">
          <span>View FAQ</span>
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>
    </div>
  </section>

  <footer class="candy-gradient text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="border-t border-pink-200 mt-8 pt-8 text-center text-pink-100">
        <p>&copy; <?php echo date("Y"); ?> Toothy Treats. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    function toggleMobileMenu(){
      const el = document.getElementById('mobile-menu');
      if (el) el.classList.toggle('hidden');
    }
  </script>

</body>
</html>
