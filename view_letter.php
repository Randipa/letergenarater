<?php
include 'header.php';

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the letter data from the database
    include 'db_connect.php';
    $stmt = $conn->prepare("SELECT * FROM letters WHERE letter_url LIKE ?");
    $stmt->bind_param("s", $url_pattern);
    $url_pattern = "%id=" . $id; // Match the unique ID in the URL
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Display the letter content
        echo '<div class="container">';
        echo '<div class="letter-preview">';
        echo '<div class="text-end mb-4"><button onclick="window.print()" class="btn btn-custom"><i class="bi bi-printer"></i> Print</button></div>';

        echo <<<HTML
        <div class="mb-4">
            <p class="mb-0"><strong>{$data['recipient_name']}</strong></p>
            <p class="mb-0">{$data['organization']}</p>
            <p class="mb-0">{$data['address1']}</p>
            <p class="mb-0">{$data['address2']}</p>
            <p class="mb-0">{$data['address3']}</p>
        </div>

        <div class="mb-4">
            <h6>Manager</h6>
            <p class="mb-0">Infive Pvt Ltd</p>
            <p class="mb-0">2nd Floor, 206A Wilgoda Estate Rd</p>
            <p class="mb-0">Kurunegala</p>
        </div>

        <h4 class="mb-3 text-primary">Request for Permission to Print Identity Cards with the State Emblem</h4>

        <div class="letter-body">
            <p>Dear Sir/Madam,</p>
            <p>I would like to formally authorize Infive Pvt Ltd to print identity cards bearing the Sri Lankan government logo for the <strong>{$data['business_name']}</strong>.</p>
            
            <p>To proceed with this printing, I give my consent to use the state emblem on identity cards issued for official purposes by my organization and to continue this process under my guidance.</p>
            
            <div class="contact-info mt-4">
                <h6>Contact Information:</h6>
                <ul class="list-unstyled">
                    <li><i class="bi bi-phone"></i> {$data['phone']}</li>
                    <li><i class="bi bi-envelope"></i> {$data['email']}</li>
                </ul>
            </div>
            
            <div class="signature mt-4">
                <p>Sincerely,</p>
                <p class="mb-0"><strong>{$data['recipient_name']}</strong></p>
                <p class="mb-0">{$data['nic_number']}</p> <!-- Display NIC Number -->
            </div>
        </div>
HTML;

        echo '</div></div>';
    } else {
        echo '<div class="container"><div class="alert alert-danger">Letter not found!</div></div>';
    }
} else {
    echo '<div class="container"><div class="alert alert-warning">Invalid request!</div></div>';
}
?>