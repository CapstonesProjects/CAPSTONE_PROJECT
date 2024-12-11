<?php
include('config/db_connection.php');

// Fetch events with one image per event from the database
$sql = "SELECT e.id, e.title, e.event_date, e.description, e.location, e.category, 
               (SELECT ei.image_path FROM event_images ei WHERE ei.event_id = e.id LIMIT 1) AS image_path
        FROM events e";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/events.css">
    <link rel="stylesheet" href="css/responsiveness_landingpage.css">
    <link rel="stylesheet" href="css/responsiveness_header.css">
    <link rel="shortcut icon" href="images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>OSA - Lyceum of Alabang</title>
    <style>
        .slider-container {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slider-slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .slider-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .slider-button-prev {
            left: 10px;
        }

        .slider-button-next {
            right: 10px;
        }


        .card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card:hover .view-more {
            opacity: 1;
        }

        .view-more {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        @media (max-width: 768px) {
            .slider-button {
                padding: 8px;
                font-size: 0.9rem;
            }

            .view-more {
                font-size: 1.2rem;
            }

            .card:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            }
        }

        @media (max-width: 480px) {
            .slider-button {
                padding: 6px;
                font-size: 0.8rem;
            }

            .view-more {
                font-size: 1rem;
            }

            .card {
                box-shadow: none;
            }
        }
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
                <div class="relative flex flex-col items-center">
                    <img src="images/danilo.jpg" alt="Person 1" class="w-32 h-32 rounded-full border-4 border-black">
                    <div class="mt-2 text-center">
                        <p class="text-lg font-semibold">Dr. Danilo V. Ayap</p>
                        <p class="text-sm text-gray-600">President / CEO</p>
                    </div>
                    <!-- <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="m18.707 12.707-1.414-1.414L13 15.586V6h-2v9.586l-4.293-4.293-1.414 1.414L12 19.414z"></path>
                        </svg>
                    </div> -->
                </div>
                <!-- Middle Person -->
                <div class="relative flex flex-col items-center mt-10">
                    <img src="images/ayap.jpg" alt="Person 2" class="w-32 h-32 rounded-full border-4 border-black">
                    <div class="mt-2 text-center">
                        <p class="text-lg font-semibold">Ms. Faith M. Ayap-Aquino</p>
                        <p class="text-sm text-gray-600">VP for Administration</p>
                    </div>
                    <!-- <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="m18.707 12.707-1.414-1.414L13 15.586V6h-2v9.586l-4.293-4.293-1.414 1.414L12 19.414z"></path>
                        </svg>
                    </div> -->
                </div>
                <!-- Bottom Row -->
                <div class="flex justify-center mt-10 gap-16 flex-wrap">
                    <div class="flex flex-col items-center relative">
                        <img src="images/3.jpg" alt="Person 3" class="w-32 h-32 rounded-full border-4 border-black">
                        <div class="mt-2 text-center">
                            <p class="text-lg font-semibold">Ms. Ermelyn M. Guan</p>
                            <p class="text-sm text-gray-600">Director OSA</p>
                        </div>
                        <!-- <div class="ml-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                            </svg>
                        </div> -->
                    </div>
                    <div class="flex flex-col items-center relative">
                        <img src="images/4.png" alt="Person 4" class="w-32 h-32 rounded-full border-4 border-black">
                        <div class="mt-2 text-center">
                            <p class="text-lg font-semibold">Ms. Helen G. Patalbo</p>
                            <p class="text-sm text-gray-600">Executive Secretary OSA</p>
                        </div>
                        <!-- <div class="ml-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                            </svg>
                        </div> -->
                    </div>
                    <div class="flex flex-col items-center relative">
                        <img src="images/5.png" alt="Person 5" class="w-32 h-32 rounded-full border-4 border-black">
                        <div class="mt-2 text-center">
                            <p class="text-lg font-semibold">Mr. Mark Anthony G. Alarba</p>
                            <p class="text-sm text-gray-600">Monitoring Officer OSA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- About Us Row -->
        <div class="flex flex-col text-center mt-10 about-school-container">
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
            <div class="slider-container">
                <div class="slider-wrapper">
                    <?php
                    if ($result->num_rows > 0) {
                        $counter = 0;
                        while ($row = $result->fetch_assoc()) {
                            if ($counter % 4 == 0) {
                                if ($counter > 0) {
                                    echo '</div>'; // Close previous slide
                                }
                                echo '<div class="slider-slide flex flex-row flex-wrap justify-center">'; // Open new slide
                            }
                            $event_id = $row['id'];
                            $title = $row['title'];
                            $event_date = date('F j, Y', strtotime($row['event_date']));
                            // $description = $row['description'];
                            $image_path = $row['image_path'];
                    ?>
                            <a href="EventViewMore.php?id=<?php echo $event_id; ?>" target="_blank" class="bg-white rounded-lg shadow-lg overflow-hidden m-4 w-64 card">
                                <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2"><?php echo $title; ?></h3>
                                    <p class="text-gray-600 mb-2">Date: <?php echo $event_date; ?></p>
                                    <!-- <p class="text-gray-700"><?php echo $description; ?></p> -->
                                </div>
                                <div class="view-more">View More</div>
                            </a>
                    <?php
                            $counter++;
                        }
                        echo '</div>'; // Close last slide
                    } else {
                        echo "<p class='text-center'>No events found.</p>";
                    }
                    ?>
                </div>
                <!-- Add Navigation -->
                <button class="slider-button slider-button-prev">
                    <i class='bx bx-chevron-left'></i>
                </button>
                <button class="slider-button slider-button-next">
                    <i class='bx bx-chevron-right'></i>
                </button>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="footer-container grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="footer-content-left">
                    <h3 class="text-lg font-bold mb-2">Lyceum of Alabang</h3>
                    <p>Address: Km.30 National Road, Muntinlupa, 1773 Metro Manila</p>
                    <p>Phone: (02) 8771 5191</p>
                    <p>Email: <a href="#" class="text-blue-400 hover:underline">info@loaofficeofstudentaffairs.com</a></p>
                </div>
                <div class="footer-content-center">
                    <h3 class="text-lg font-bold mb-2">Quick Links</h3>
                    <ul>
                        <li><a href="#" class="text-blue-400 hover:underline">Home</a></li>
                        <li><a href="#" class="text-blue-400 hover:underline">About Us</a></li>
                        <li><a href="#" class="text-blue-400 hover:underline">Admissions</a></li>
                        <li><a href="#" class="text-blue-400 hover:underline">Academics</a></li>
                        <li><a href="#" class="text-blue-400 hover:underline">Contact Us</a></li>
                        <li><a href="https://lyceumalabang.edu.ph/" class="text-blue-400 hover:underline">Lyceum of Alabang Website</a></li>
                        <li><a href="admin_osa_index.php" class="text-blue-400 hover:underline">Admin and OSA Login</a></li>
                    </ul>
                </div>
                <div class="footer-content-right">
                    <h3 class="text-lg font-bold mb-2">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="https://web.facebook.com/lyceumofalabanginc" class="text-blue-400 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.733 0-1.325.592-1.325 1.325v21.351c0 .733.592 1.324 1.325 1.324h11.495v-9.294h-3.125v-3.622h3.125v-2.672c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24h-1.918c-1.504 0-1.794.715-1.794 1.763v2.314h3.587l-.467 3.622h-3.12v9.294h6.116c.733 0 1.325-.591 1.325-1.324v-21.351c0-.733-.592-1.325-1.325-1.325z" />
                            </svg>
                        </a>
                        <a href="#" class="text-blue-400 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.954 4.569c-.885.392-1.83.656-2.825.775 1.014-.608 1.794-1.574 2.163-2.723-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-2.717 0-4.92 2.203-4.92 4.917 0 .385.045.76.127 1.122-4.087-.205-7.713-2.164-10.141-5.144-.423.725-.666 1.562-.666 2.457 0 1.694.863 3.188 2.175 4.065-.802-.026-1.558-.246-2.217-.616v.062c0 2.367 1.684 4.342 3.918 4.788-.41.111-.84.171-1.285.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.6 3.417-1.68 1.318-3.809 2.105-6.102 2.105-.396 0-.79-.023-1.175-.068 2.179 1.397 4.768 2.212 7.548 2.212 9.057 0 14.01-7.496 14.01-13.986 0-.213-.005-.425-.014-.636.961-.695 1.8-1.562 2.462-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-blue-400 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c-5.488 0-9.837 4.449-9.837 9.837 0 4.351 2.813 8.065 6.676 9.387-.092-.799-.175-2.031.036-2.906.191-.812 1.231-5.175 1.231-5.175s-.314-.628-.314-1.556c0-1.457.847-2.545 1.902-2.545.897 0 1.331.672 1.331 1.478 0 .9-.573 2.246-.868 3.494-.247 1.042.524 1.891 1.554 1.891 1.864 0 3.301-1.965 3.301-4.799 0-2.507-1.803-4.267-4.379-4.267-2.984 0-4.742 2.238-4.742 4.551 0 .9.344 1.867.774 2.392.085.103.097.193.072.297-.079.324-.258 1.042-.293 1.186-.045.188-.148.228-.342.138-1.276-.592-2.073-2.448-2.073-3.944 0-3.204 2.329-6.145 6.718-6.145 3.527 0 6.268 2.515 6.268 5.876 0 3.501-2.206 6.308-5.266 6.308-1.027 0-1.994-.533-2.324-1.163l-.633 2.406c-.228.868-.847 1.953-1.263 2.617.949.293 1.949.451 2.993.451 5.488 0 9.837-4.449 9.837-9.837s-4.449-9.837-9.837-9.837z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <p class="text-sm">&copy; 2024 Lyceum of Alabang. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="javascript/hamburger_menu.js"></script>
    <script src="javascript/alerts.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderWrapper = document.querySelector('.slider-wrapper');
            const slides = document.querySelectorAll('.slider-slide');
            const prevButton = document.querySelector('.slider-button-prev');
            const nextButton = document.querySelector('.slider-button-next');
            let currentIndex = 0;

            function updateSliderPosition() {
                const slideWidth = slides[0].clientWidth;
                sliderWrapper.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            }

            prevButton.addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSliderPosition();
                }
            });

            nextButton.addEventListener('click', function() {
                if (currentIndex < slides.length - 1) {
                    currentIndex++;
                    updateSliderPosition();
                }
            });

            window.addEventListener('resize', updateSliderPosition);
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>