<?php
session_start();

$response = array(); // Create an empty response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['client_id'])) {
        // Sanitize and save the ID in a session variable.
        $_SESSION['selected_id'] = intval($_POST['client_id']);
        $response['success'] = true;
        $response['message'] = 'ID ' . $_SESSION['selected_id'] . ' saved in session.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Error: ID not provided.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Error: Invalid request method.';
}

// Send a JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>