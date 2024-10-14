<?php
session_start();
include('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $target_dir = "../osa_profiles_upload/";
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

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $_SESSION['file_large'] = 'Sorry, your file is too large.';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $_SESSION['file_invalid_format'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $uploadOk = 0;
    }

    // Backup the old profile picture path
    $osa_number = $_SESSION['OSA_number'];
    $sql = "SELECT profile_picture FROM tblusers_osa WHERE OSA_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $osa_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $old_profile_picture = $row['profile_picture'];

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: ../OSA/OSA_Profile.php");
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Save the new file path in the database
            $sql = "UPDATE tblusers_osa SET profile_picture = ? WHERE OSA_number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $target_file, $osa_number);
            $stmt->execute();

            // Update the session variable
            $_SESSION['ProfilePicture'] = $target_file;
            $_SESSION['success_image_change'] = 'Your profile picture has been updated successfully.';

            // Redirect back to the profile page
            header("Location: ../OSA/OSA_Profile.php");
        } else {
            // If upload fails, retain the old profile picture path
            $_SESSION['ProfilePicture'] = $old_profile_picture;
            $_SESSION['error_image_change'] = 'Sorry, there was an error uploading your file.';
            header("Location: ../OSA/OSA_Profile.php");
        }
    }
}
?>