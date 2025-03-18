<?php
// Include database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $recipient_name = $_POST['recipient_name'];
    $organization = $_POST['organization'];
    $address1 = $_POST['address1'];
    $address2 = isset($_POST['address2']) ? $_POST['address2'] : '';
    $address3 = isset($_POST['address3']) ? $_POST['address3'] : '';
    $business_name = $_POST['business_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Generate a unique ID for the letter
    $unique_id = uniqid();

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO letters (recipient_name, organization, address1, address2, address3, business_name, phone, email, letter_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $letter_url = "view_letter.php?id=" . $unique_id;
    $stmt->bind_param("sssssssss", $recipient_name, $organization, $address1, $address2, $address3, $business_name, $phone, $email, $letter_url);

    if ($stmt->execute()) {
        // Redirect to the generated letter page
        header("Location: " . $letter_url);
        exit();
    } else {
        echo "Error saving data: " . $stmt->error;
    }

    $stmt->close();
}
?>