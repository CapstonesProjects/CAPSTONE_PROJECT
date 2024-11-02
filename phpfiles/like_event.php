<?php
include('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = intval($_POST['event_id']);

    // Check if the event already has likes
    $check_sql = "SELECT likes_count FROM event_likes WHERE event_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $event_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Update the likes count
        $update_sql = "UPDATE event_likes SET likes_count = likes_count + 1 WHERE event_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $event_id);
        $update_stmt->execute();
    } else {
        // Insert a new record with 1 like
        $insert_sql = "INSERT INTO event_likes (event_id, likes_count) VALUES (?, 1)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("i", $event_id);
        $insert_stmt->execute();
    }

    // Fetch the updated likes count
    $likes_sql = "SELECT likes_count FROM event_likes WHERE event_id = ?";
    $likes_stmt = $conn->prepare($likes_sql);
    $likes_stmt->bind_param("i", $event_id);
    $likes_stmt->execute();
    $likes_result = $likes_stmt->get_result();
    $likes = $likes_result->fetch_assoc()['likes_count'];

    $check_stmt->close();
    $update_stmt->close();
    $insert_stmt->close();
    $likes_stmt->close();
    $conn->close();

    echo json_encode(['success' => true, 'likes' => $likes]);
} else {
    echo json_encode(['success' => false]);
}
?>