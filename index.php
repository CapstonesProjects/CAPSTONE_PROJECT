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
    <link rel="stylesheet" href="css/respo/responsiveness_header.css">
    <link rel="stylesheet" href="css/respo/respo_footer.css">

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
        transform: translateY(-2px);
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
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
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
            <h1 class="org_title text-black text-4xl font-semibold">ABOUT THE OFFICE</h1>
            <div class="flex flex-col items-center mt-10">
                <p class="text-lg text-gray-700 max-w-prose">
                The Office of Student Affairs ensures that the student's welfare is implemented; 
                        thus, it includes a comprehensive approach to the student's campus life. 
                        The Office covers the overall supervision of the Student's admission, guidance, discipline,
                        career placement, and continuous development as an Alumni of the Lyceum of Alabang.
                </p>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section id="events" class="events py-10 bg-gray-100 relative">
    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-4xl font-semibold text-center mb-8">Events</h2>
        <div class="slider-container relative">
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
                        $image_path = $row['image_path'];
                        ?>
                        <a href="EventViewMore.php?id=<?php echo $event_id; ?>" target="_blank" class="bg-white rounded-lg shadow-lg overflow-hidden m-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 max-w-xs card">
                            <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2"><?php echo $title; ?></h3>
                                <p class="text-gray-600 mb-2">Date: <?php echo $event_date; ?></p>
                            </div>
                            <div class="view-more text-blue-500 text-sm font-semibold">View More</div>
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
            <!-- Slider Navigation -->
            <button class="slider-button slider-button-prev absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md">
                <i class='bx bx-chevron-left text-2xl'></i>
            </button>
            <button class="slider-button slider-button-next absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md">
                <i class='bx bx-chevron-right text-2xl'></i>
            </button>
        </div>
    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="javascript/hamburger_menu.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sliderWrapper = document.querySelector('.slider-wrapper');
            const slides = document.querySelectorAll('.slider-slide');
            const prevButton = document.querySelector('.slider-button-prev');
            const nextButton = document.querySelector('.slider-button-next');
            let currentIndex = 0;

            function updateSliderPosition() {
                const slideWidth = slides[0].clientWidth;
                sliderWrapper.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            }

            prevButton.addEventListener('click', function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSliderPosition();
                }
            });

            nextButton.addEventListener('click', function () {
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