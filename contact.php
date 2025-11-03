<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Toothy Treats</title>
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
                        <a href="index.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">Home</a>
                        <a href="about.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">About</a>
                        <a href="products.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">Products</a>
                        <a href="contact.php" class="block text-white hover:text-pink-200 px-3 py-2 rounded-md text-base font-medium">Contact Us</a>
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

    <!-- Contact Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-pink-600 mb-12 text-center">Contact Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-pink-600 mb-6">Get in Touch </h3>
                    <form id="contact-form" class="space-y-6">
                        <div>
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 form-input">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 form-input">
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 form-input"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-pink-600 text-white py-2 px-4 rounded-md hover:bg-pink-700 transition duration-300">
                            Send Message
                        </button>
                    </form>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-pink-600 mb-6">Visit Us</h3>
                    <div class="space-y-4">
                        <p class="text-gray-600"><strong>Address:</strong> Blk 1 Lt 1 Sahud Ulan, Tanza, Cavite.</p>
                        <p class="text-gray-600"><strong>Phone:</strong> +631234567890/p>
                        <p class="text-gray-600"><strong>Email:</strong> toothytreats@gmail.com</p>
                        <p class="text-gray-600"><strong>Hours:</strong> 10 am - 10pm</p>
                    </div>
                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-pink-600 mb-4">Follow us on</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-pink-600 hover:text-pink-700">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-pink-600 hover:text-pink-700">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-pink-600 hover:text-pink-700">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-pink-600 mb-12 text-center">Frequently Asked Questions</h2>
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
                <!-- FAQ Item 1 -->
                <div class="mb-4">
                    <button class="w-full flex justify-between items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-all duration-300" onclick="toggleFAQ('faq-1')">
                        <h3 class="text-xl font-semibold text-pink-600">Do you offer custom candy orders?</h3>
                        <svg class="w-6 h-6 text-pink-600 transform transition-transform duration-300" id="icon-faq-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden overflow-hidden transition-all duration-300" id="faq-1">
                        <p class="p-4 text-gray-600">Yes! We love creating custom candy arrangements for special occasions. Please contact us at least one week in advance for custom orders.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="mb-4">
                    <button class="w-full flex justify-between items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-all duration-300" onclick="toggleFAQ('faq-2')">
                        <h3 class="text-xl font-semibold text-pink-600">What are your shipping options?</h3>
                        <svg class="w-6 h-6 text-pink-600 transform transition-transform duration-300" id="icon-faq-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden overflow-hidden transition-all duration-300" id="faq-2">
                        <p class="p-4 text-gray-600">We offer standard delivery (3-5 business days) and express delivery (1-2 business days) within Cavite. For special arrangements outside Cavite, please contact us directly.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="mb-4">
                    <button class="w-full flex justify-between items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-all duration-300" onclick="toggleFAQ('faq-3')">
                        <h3 class="text-xl font-semibold text-pink-600">Are your candies suitable for people with allergies?</h3>
                        <svg class="w-6 h-6 text-pink-600 transform transition-transform duration-300" id="icon-faq-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden overflow-hidden transition-all duration-300" id="faq-3">
                        <p class="p-4 text-gray-600">We clearly label all ingredients in our products. If you have specific allergies, please contact us to discuss safe options for you.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="mb-4">
                    <button class="w-full flex justify-between items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-all duration-300" onclick="toggleFAQ('faq-4')">
                        <h3 class="text-xl font-semibold text-pink-600">Do you offer bulk orders for events?</h3>
                        <svg class="w-6 h-6 text-pink-600 transform transition-transform duration-300" id="icon-faq-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden overflow-hidden transition-all duration-300" id="faq-4">
                        <p class="p-4 text-gray-600">Yes! We offer special pricing for bulk orders and events. Contact us with your requirements for a custom quote.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="mb-4">
                    <button class="w-full flex justify-between items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-all duration-300" onclick="toggleFAQ('faq-5')">
                        <h3 class="text-xl font-semibold text-pink-600">What's your return policy?</h3>
                        <svg class="w-6 h-6 text-pink-600 transform transition-transform duration-300" id="icon-faq-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden overflow-hidden transition-all duration-300" id="faq-5">
                        <p class="p-4 text-gray-600">Due to the nature of our products, we cannot accept returns. However, if you receive damaged items, please contact us within 24 hours of delivery for a replacement.</p>
                    </div>
                </div>
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