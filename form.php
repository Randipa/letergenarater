<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission Request Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style for buttons */
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Style for text fields */
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Hide elements by default */
        .hidden {
            display: none;
        }

        /* Preview container styling */
        #letterPreview {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<!-- Top Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="logo-infive.png" alt="Infive Logo" width="150" height="30" class="d-inline-block align-top">
        </a>
        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
               
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="form-header">
        <h2>📄 Permission Request Form</h2>
        <p class="text-muted">Fill in the details to generate official request letter</p>
    </div>

    <form id="letterForm" method="POST" action="generate.php">
        <!-- Recipient Information -->
        <div class="form-card">
            <h5>🔖 Recipient Information</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Recipient's Name <span class="text-danger">*</span></label>
                    <input type="text" name="recipient_name" id="recipient_name" class="form-control" placeholder="John Doe" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Organization <span class="text-danger">*</span></label>
                    <input type="text" name="organization" id="organization" class="form-control" placeholder="ABC Corporation" required>
                </div>
            </div>
        </div>

        <!-- Address Details -->
        <div class="form-card">
            <h5>🏢 Address Details</h5>
            <div class="mb-3">
                <label class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                <input type="text" name="address1" id="address1" class="form-control" placeholder="Street address" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address Line 2</label>
                <input type="text" name="address2" id="address2" class="form-control" placeholder="Suite number">
            </div>
            <div class="mb-3">
                <label class="form-label">Address Line 3</label>
                <input type="text" name="address3" id="address3" class="form-control" placeholder="City, ZIP code">
            </div>
        </div>

        <!-- Client Details -->
        <div class="form-card">
            <h5>📇 Client Details</h5>
            <div class="mb-3">
                <label class="form-label">Business Name <span class="text-danger">*</span></label>
                <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Business Name" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="+94 77 123 4567" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="contact@company.com" required>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-grid gap-2">
            <button type="button" id="viewButton" class="btn btn-custom" onclick="previewLetter()">View Your Finished Letter</button>
            <button type="submit" id="submitButton" class="btn btn-custom hidden">Submit</button>
        </div>

        <!-- Letter Preview -->
        <div id="letterPreview" class="hidden">
            <h4 class="mb-3 text-primary">Request for Permission to Print Identity Cards with the State Emblem</h4>
            <div class="letter-body">
                <p>Dear Sir/Madam,</p>
                <p>I would like to formally authorize Infive Pvt Ltd to print identity cards bearing the Sri Lankan government logo for the <strong id="preview_business_name">[Business Name]</strong>.</p>
                <p>To proceed with this printing, I give my consent to use the state emblem on identity cards issued for official purposes by my organization and to continue this process under my guidance.</p>
                <div class="contact-info mt-4">
                    <h6>Contact Information:</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-phone"></i> <span id="preview_phone">[Phone]</span></li>
                        <li><i class="bi bi-envelope"></i> <span id="preview_email">[Email]</span></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    // Function to preview the letter
    function previewLetter() {
    // Validate form fields
    const recipientName = document.getElementById('recipient_name').value.trim();
    const organization = document.getElementById('organization').value.trim();
    const address1 = document.getElementById('address1').value.trim();
    const businessName = document.getElementById('business_name').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();

    // Validate phone number (only numbers, min 10 digits, max 18 digits)
    const phonePattern = /^[0-9]{10,18}$/; // Regex to match numbers between 10 and 18 digits
    if (!phonePattern.test(phone)) {
        alert('Please enter a valid phone number (10 to 18 digits).');
        return;
    }

    // Validate other required fields
    if (!recipientName || !organization || !address1 || !businessName || !email) {
        alert('Please fill in all required fields.');
        return;
    }

    // Populate preview content
    document.getElementById('preview_business_name').textContent = businessName;
    document.getElementById('preview_phone').textContent = phone;
    document.getElementById('preview_email').textContent = email;

    // Show preview and toggle buttons
    document.getElementById('letterPreview').classList.remove('hidden');
    document.getElementById('viewButton').classList.add('hidden');
    document.getElementById('submitButton').classList.remove('hidden');
}
</script>
</body>
</html>