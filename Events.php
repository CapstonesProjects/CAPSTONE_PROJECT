<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/events.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Events</title>
</head>

<body>

    <?php
    include('./components/header.php');
    ?>

    <div class="container">

        <div class="slide">
                    
            <div class="item" style="background-image: url(./images/Events/img3.jpg";>
                <div class="content">
                    <div class="name">Happy international Literacy Day!</div>
                    <div class="des">Every story starts with a seed. Today, the world comes together to celebrate the power of words and the endless possibilities that literacy brings. Through reading and learning, individuals are empowered, and brighter futures are written. The ink of literacy never runs dry, spanning from timeless hardbound books to modern digital resources. Together, we are inspired to turn pages, file articles, and craft new narratives, all in the pursuit of building a world where literacy is for everyone!</div>
                    <button class="see-more">See More</button>
                    </div>
            </div>

            <div class="item" style="background-image: url(./images/Events/img8.jpg";>
                <div class="content">
                    <div class="name">Artist: Albert Jan Francisco</div>
                    <div class="des">Lorem ipusm dolor, sit ament consectetur dipisting elit.ab,eum!</div>
                    <button class="see-more">See More</button>
                </div>
            </div>

            <div class="item" style="background-image: url(./images/Events/img4.jpg";>
                <div class="content">
                    <div class="name">To the Teacher who Inspire</div>
                    <div class="des">Lorem ipusm dolor, sit ament consectetur dipisting elit.ab,eum!</div>
                    <button class="see-more">See More</button>
                </div>
            </div>

            
            <div class="item" style="background-image: url(./images/Events/img6.jpg";>
                <div class="content">
                    <div class="name">To the Teacher who Inspire</div>
                    <div class="des">Lorem ipusm dolor, sit ament consectetur dipisting elit.ab,eum!</div>
                    <button class="see-more">See More</button>
                </div>
            </div>

            <div class="item" style="background-image: url(./images/Events/img2.jpg";>
                <div class="content">
                    <div class="name">To the Teacher who Inspire</div>
                    <div class="des">Lorem ipusm dolor, sit ament consectetur dipisting elit.ab,eum!</div>
                    <<button class="see-more">See More</button>
                </div>
            </div>

        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

    </div>
    
    <script>function toggleText(button) {
                const description = button.previousElementSibling;
                if (description.style.display === "none" || description.style.display === "") {
                    description.style.display = "block";
                    button.innerText = "See Less";  // Change button text
                } else {
                    description.style.display = "none";
                    button.innerText = "See More";  // Revert button text
                }
            }
    </script>



</body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="event.js"></script>
   
</html>