<?php
session_start();
include('../config/db_connection.php');

if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    $query = "SELECT * FROM tblusers_student WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
    $_SESSION['MiddleName'] = $user['MiddleName'];
    $_SESSION['Course'] = $user['Course'];
    $_SESSION['StudentID'] = $user['StudentID'];
    $_SESSION['Suffix'] = $user['Suffix'];
    $_SESSION['YearLevel'] = $user['YearLevel'];
    $_SESSION['StudentType'] = $user['StudentType'];
    $_SESSION['Email'] = $user['Email'];
    $_SESSION['PhoneNumber'] = $user['PhoneNumber'];
    $_SESSION['DateBirth'] = $user['DateBirth'];
    $_SESSION['Address'] = $user['Address'];
    $_SESSION['Gender'] = $user['Gender'];
    $_SESSION['Nationality'] = $user['Nationality'];
    $_SESSION['EmergencyContact'] = $user['EmergencyContact'];
    $_SESSION['MaritalStatus'] = $user['MaritalStatus'];
    $_SESSION['GuardiansName'] = $user['GuardiansName'];
    $_SESSION['GuardiansContact'] = $user['GuardiansContact'];
    $_SESSION['password_changed'] = $user['password_changed']; // Add this line
} else {
    // Redirect to login page or show an error
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/student_profile.css">
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Student profile - LOA OSA</title>
</head>

<body>
    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'profile';
            include('../components/student_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            <?php
            include('../components/student_profile.php');
            ?>
        </div>
    </div>

    <?php include('../alerts/profile_image_change_alerts.php'); ?>
    <?php include('../alerts/file_large_alerts.php'); ?>
    <?php include("../modals/Student_SettingsModal.php"); ?>
    <?php include('../alerts/changepassword_alerts.php'); ?>
    <?php include('../modals/change_password_modal.php'); ?> <!-- Include the modal file -->

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"></script>
<script src="../javascript/sessionmessage.js"></script>
<script src="../javascript/active.js"></script>
<script src="../javascript/alerts.js"></script>

<?php if (isset($_SESSION['password_needs_change']) && $_SESSION['password_needs_change']): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('changePasswordModal').style.display = 'flex';
    });
</script>
<?php endif; ?>

<?php if (isset($_SESSION['password_changed']) && $_SESSION['password_changed'] == 1): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('changePasswordModal').style.display = 'none';
    });
</script>
<?php endif; ?>
</html>