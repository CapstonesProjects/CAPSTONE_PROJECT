<?php
include('config/db_connection.php');

// Get the event ID from the query parameter
$event_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch event details from the database
$sql = "SELECT e.id, e.title, e.event_date, e.description, e.location, e.category
        FROM events e
        WHERE e.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

// Fetch all images for the event
$images_sql = "SELECT image_path FROM event_images WHERE event_id = ?";
$images_stmt = $conn->prepare($images_sql);
$images_stmt->bind_param("i", $event_id);
$images_stmt->execute();
$images_result = $images_stmt->get_result();
$images = [];
while ($row = $images_result->fetch_assoc()) {
    $images[] = $row['image_path'];
}

// Fetch the number of likes for the event
$likes_sql = "SELECT likes_count FROM event_likes WHERE event_id = ?";
$likes_stmt = $conn->prepare($likes_sql);
$likes_stmt->bind_param("i", $event_id);
$likes_stmt->execute();
$likes_result = $likes_stmt->get_result();
$likes = $likes_result->fetch_assoc()['likes_count'] ?? 0;

$stmt->close();
$images_stmt->close();
$likes_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/osa_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/respo/respo_viewmore.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Event Details - Lyceum of Alabang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .event-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .event-image {
            width: calc(33.333% - 10px);
            height: auto;
            border-radius: 10px;
        }

        .event-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .event-date,
        .event-location,
        .event-category {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 10px;
        }

        .event-description {
            font-size: 1rem;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .back-button,
        .like-button,
        .share-button {
            display: inline-block;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-right: 10px;
            font-size: 1rem;
            cursor: pointer;
        }

        .back-button:hover,
        .like-button:hover,
        .share-button:hover {
            background-color: #0056b3;
        }

        .like-share-container {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .like-share-container .like-button,
        .like-share-container .share-button {
            background-color: transparent;
            color: #007bff;
        }

        .like-share-container .like-button:hover,
        .like-share-container .share-button:hover {
            background-color: transparent;
            color: #0056b3;
        }

        .like-indicator {
            font-size: 1rem;
            color: #555;
            margin-left: 5px;
        }

        .icon {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>



    <section id="event-details" class="event-details py-10 bg-gray-100">
        <div class="container mx-auto">
            <div class="event-container">
                <?php if ($event): ?>
                    <div class="event-images">
                        <?php foreach ($images as $image): ?>
                            <img src="<?php echo $image; ?>" alt="Event Image" class="event-image">
                        <?php endforeach; ?>
                    </div>
                    <h1 class="event-title"><?php echo $event['title']; ?></h1>
                    <p class="event-date"><i class='bx bx-calendar icon'></i>Date: <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p>
                    <p class="event-location"><i class='bx bx-map icon'></i>Location: <?php echo $event['location']; ?></p>
                    <p class="event-category"><i class='bx bx-category icon'></i>Category: <?php echo $event['category']; ?></p>
                    <p class="event-description"><?php echo nl2br($event['description']); ?></p>
                    <div class="like-share-container">
                        <button class="like-button" id="like-button" onclick="likeEvent(<?php echo $event_id; ?>)">
                            <i class='bx bx-heart icon' id="heart-icon"></i>
                        </button>
                        <span class="like-indicator" id="like-count"><?php echo $likes; ?> Likes</span>
                        <button class="share-button"><i class='bx bx-share-alt icon'></i></button>
                    </div>
                    <a href="index.php#events" class="back-button"><i class='bx bx-arrow-back icon'></i></a>
                <?php else: ?>
                    <p class="text-center">Event not found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script>
        function likeEvent(eventId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'phpfiles/like_event.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('like-count').innerText = response.likes + ' Likes';
                        const heartIcon = document.getElementById('heart-icon');
                        heartIcon.classList.remove('bx-heart');
                        heartIcon.classList.add('bxs-heart');
                        heartIcon.style.color = '#e87aba';
                        location.reload();
                    }
                }
            };
            xhr.send('event_id=' + eventId);
        }
    </script>
</body>

</html>