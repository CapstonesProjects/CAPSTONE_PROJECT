<?php
session_start();
include('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['file_not_image'] = 'File is not an image.';
        $uploadOk = 0;
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $_SESSION['file_large'] = 'Sorry, your file is too large.';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Backup the old profile picture path
    $student_id = $_SESSION['StudentID'];
    $sql = "SELECT profile_picture FROM tblusers_student WHERE StudentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $old_profile_picture = $row['profile_picture'];

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {

        // $_SESSION['error_image_change'] = 'Sorry, there was an error uploading your file.';
        header("Location: ../Student/Student_Dashboard.php");
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Save the new file path in the database
            $sql = "UPDATE tblusers_student SET profile_picture = ? WHERE StudentID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $target_file, $student_id);
            $stmt->execute();

            // Update the session variable
            $_SESSION['ProfilePicture'] = $target_file;
            $_SESSION['success_image_change'] = 'Your profile picture has been updated successfully.';

            // Redirect back to the profile page
            header("Location: ../Student/Student_Dashboard.php");
        } else {
            // If upload fails, retain the old profile picture path
            $_SESSION['ProfilePicture'] = $old_profile_picture;
            $_SESSION['error_image_change'] = 'Sorry, there was an error uploading your file.';
        }
    }
}
?>