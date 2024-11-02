<?php
include('../config/db_connection.php');

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form inputs
    $title = sanitize_input($_POST["event-title"]);
    $date = sanitize_input($_POST["event-date"]);
    $description = sanitize_input($_POST["event-description"]);
    $location = sanitize_input($_POST["event-location"]);
    $category = sanitize_input($_POST["event-category"]);

    // Insert event details into the events table
    $sql = "INSERT INTO events (title, event_date, description, location, category) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $date, $description, $location, $category);

    if ($stmt->execute()) {
        // Get the last inserted event ID
        $event_id = $stmt->insert_id;

        // Handle file uploads
        $upload_dir = "../uploads-events/";
        foreach ($_FILES["event-image"]["tmp_name"] as $key => $tmp_name) {
            $file_name = basename($_FILES["event-image"]["name"][$key]);
            $target_file = $upload_dir . $file_name;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($tmp_name, $target_file)) {
                // Store the relative path without the leading "../"
                $relative_path = "uploads-events/" . $file_name;

                // Insert image path into the event_images table
                $sql = "INSERT INTO event_images (event_id, image_path) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $event_id, $relative_path);
                $stmt->execute();
            }
        }

        // Redirect to a success page or display a success message
        echo "Event added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>