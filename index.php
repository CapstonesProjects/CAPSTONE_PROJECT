<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/events.css">
    <link rel="shortcut icon" href="images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>LOA OSA</title>
    <style>
      
    </style>
</head>

<body>

    <?php include('./components/header.php'); ?>

    <section id="home" class="home">
        <div class="home-title-container">
            <h1 class="title-sm">Welcome to the</h1>
            <h4 class="title-xl">Lyceum of Alabang</h4>
            <h4 class="title-xl">Office of Student Affairs</h4>
            <div class="btn-officialsite-container">
                <button class="btn-officialsite"><a href="#" class="">Official Site</a></button>
            </div>
        </div>
    </section>

    <?php include('./components/index_footer.php'); ?>

    <section id="about" class="about flex flex-row h-screen p-6">
        <!-- Organizational Chart Row -->
        <div class="flex flex-col text-center org-container w-full">
            <h1 class="org_title text-black text-4xl font-semibold">ORGANIZATIONAL CHART</h1>
            <div class="flex flex-col items-center mt-10">
                <!-- Top Person -->
                <div class="relative">
                    <img src="images/3.jpg" alt="Person 3" class="w-32 h-32 rounded-full border-4 border-black">
                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="m18.707 12.707-1.414-1.414L13 15.586V6h-2v9.586l-4.293-4.293-1.414 1.414L12 19.414z"></path>
                        </svg>
                    </div>
                </div>
                <!-- Middle Person -->
                <div class="relative mt-10">
                    <img src="images/3.jpg" alt="Person 3" class="w-32 h-32 rounded-full border-4 border-black">
                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="m18.707 12.707-1.414-1.414L13 15.586V6h-2v9.586l-4.293-4.293-1.414 1.414L12 19.414z"></path>
                        </svg>
                    </div>
                </div>
                <!-- Bottom Row -->
                <div class="flex justify-center mt-10" style="gap: 4rem;">
                    <div class="flex items-center relative">
                        <img src="images/3.jpg" alt="Person 3" class="w-32 h-32 rounded-full border-4 border-black">
                        <div class="ml-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center relative">
                        <img src="images/4.png" alt="Person 4" class="w-32 h-32 rounded-full border-4 border-black">
                        <div class="ml-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center relative">
                        <img src="images/5.png" alt="Person 5" class="w-32 h-32 rounded-full border-4 border-black">
                    </div>
                </div>
            </div>
        </div>

        <!-- About Us Row -->
        <div class="flex flex-col text-center mt-10">
            <h1 class="org_title text-black text-4xl font-semibold">ABOUT THE SCHOOL</h1>
            <div class="flex flex-col items-center mt-10">
                <p class="text-lg text-gray-700 max-w-prose">
                    Welcome to our school! We are dedicated to providing a nurturing and stimulating environment for our students. Our mission is to foster academic excellence, personal growth, and social responsibility. We offer a wide range of programs and activities to support the diverse needs and interests of our students. Join us in our journey to create a brighter future!
                </p>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section id="events" class="events py-10 bg-gray-100 relative">
        <div class="container mx-auto mt-10">
            <h2 class="text-4xl font-semibold text-center mb-8">Events</h2>
            <div class="flex flex-row flex-wrap justify-center relative">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden m-4 w-64">
                    <img src="images/image_slider1.jpg" alt="Event 1" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Event Title 1</h3>
                        <p class="text-gray-600 mb-2">Date: January 1, 2023</p>
                        <p class="text-gray-700">Join us for an exciting event filled with fun activities and great experiences.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden m-4 w-64">
                    <img src="images/image_slider2.jpg" alt="Event 2" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Event Title 2</h3>
                        <p class="text-gray-600 mb-2">Date: February 1, 2023</p>
                        <p class="text-gray-700">Don't miss out on this amazing event with lots of surprises and entertainment.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden m-4 w-64">
                    <img src="images/image_slider3.jpg" alt="Event 3" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Event Title 3</h3>
                        <p class="text-gray-600 mb-2">Date: March 1, 2023</p>
                        <p class="text-gray-700">Experience a day of fun and excitement at our upcoming event.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden m-4 w-64">
                    <img src="images/image_slider4.jpg" alt="Event 4" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Event Title 4</h3>
                        <p class="text-gray-600 mb-2">Date: April 1, 2023</p>
                        <p class="text-gray-700">Join us for a memorable event with lots of activities and fun.</p>
                    </div>
                </div>

                <div class="swiper-button-next">
                    <i class='bx bx-chevron-right'></i>
                </div>
                <div class="swiper-button-prev">
                    <i class='bx bx-chevron-left'></i>
                </div>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>