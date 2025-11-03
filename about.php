<?php
// about.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Toothy Treats</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gradient-to-br from-pink-100 to-blue-100">
    <!-- Navbar -->
    <nav class="candy-gradient shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="index.php" class="text-3xl font-bold text-white">Toothy Treats</a>
                    </div>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="text-white hover:text-pink-200 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- Desktop menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-8">
                        <a href="index.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">Home</a>
                        <a href="about.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">About</a>
                        <a href="products.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">Products</a>
                        <a href="contact.php" class="nav-link text-white hover:text-pink-200 px-3 py-2 rounded-md text-lg font-medium">Contact Us</a>
                    </div>
                </div>
            </div>
            <!-- Mobile menu -->
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

    <!-- Store Description Section -->
    <section class="relative min-h-screen flex items-center">
        <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80" 
             alt="Colorful candies background" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-600/80 to-blue-600/80"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="text-white">
                <h2 class="text-6xl font-bold mb-12">Welcome to Toothy Treats</h2>
                <div class="max-w-3xl">
                    <p class="text-2xl mb-8 leading-relaxed">
                        At Toothy Treats, we're passionate about bringing joy and sweetness to your life through our carefully crafted candies and treats. Our store is a haven for candy lovers, offering a wide variety of delicious confections that will satisfy any sweet tooth.
                    </p>
                    <p class="text-2xl leading-relaxed">
                        We pride ourselves on using high-quality ingredients and maintaining the highest standards in candy making. Whether you're looking for classic favorites or unique, innovative treats, Toothy Treats has something special for everyone.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-6">Our Sweet Story</h2>
                <p class="text-xl text-gray-600">Discover the journey of Toothy Treats</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-primary mb-4">Our History</h3>
                    <p class="text-gray-600">It’s been 10 sweet years since Toothy Treats was founded, and throughout our journey, we’ve had the pleasure of bringing smiles to thousands of candy lovers. While the road hasn’t always been easy, our passion for creating delicious, high-quality treats has kept us going. Every time we see a customer enjoying our candies and coming back for more, we know that all the hard work has been worth it. Here’s to many more years of spreading joy, one sweet bite at a time!</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-secondary mb-4">Our Values</h3>
                    <p class="text-gray-600">At Toothy Treats, we are committed to delivering quality by using only the best ingredients and ensuring every candy is crafted with care. Customer satisfaction drives us to exceed expectations through innovative treats and excellent service. We believe in integrity, maintaining honesty in all our practices, and fostering community by bringing people together through the joy of candy.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-primary mb-4">Our Team</h3>
                    <p class="text-gray-600">Our team is a group of passionate individuals dedicated to creating high-quality treats and exceptional customer experiences. From creative candy makers to friendly customer service, we all work together to bring joy to our customers. Collaboration and innovation are at the heart of everything we do, ensuring our products always delight.</p>
                </div>
            </div>

            <div class="mt-16 bg-white p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-primary mb-4">Our Mission</h3>
                <p class="text-gray-600">Our mission at Toothy Treats is to bring joy and sweetness to every life we touch through our carefully crafted candies. For 10 years, we’ve been creating memorable treats that brighten people’s days, and we remain dedicated to spreading happiness, one sweet bite at a time.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="candy-gradient text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Toothy Treats</h3>
                    <p class="text-pink-100">Your one-stop shop for delicious candies and sweet treats!</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-pink-100 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="about.php" class="text-pink-100 hover:text-white transition duration-300">About</a></li>
                        <li><a href="products.php" class="text-pink-100 hover:text-white transition duration-300">Products</a></li>
                        <li><a href="contact.php" class="text-pink-100 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-pink-100">
                        <li>123 Candy Street, Sweet City</li>
                        <li>Phone: (123) 456-7890</li>
                        <li>Email: info@toothytreats.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-pink-100 hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-pink-100 hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                        <a href="#" class="text-pink-100 hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-pink-200 mt-8 pt-8 text-center text-pink-100">
                <p>&copy; <?php echo date("Y"); ?> Toothy Treats. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="js/customer.js"></script>
</body>
</html> 