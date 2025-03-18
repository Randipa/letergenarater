<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission Request Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style for the logo */
        .logo {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        /* Style for the submit button */
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

        /* Style for the text fields */
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
    </style>
</head>
<body>

<div class="container">
    <!-- Logo -->
    <img src="logo-infive.png" alt="Infive Logo" class="logo">

    <div class="form-header">
        <h2>📄 Permission Request Form</h2>
        <p class="text-muted">Fill in the details to generate official request letter</p>
    </div>

    <form method="POST" action="generate.php">
        <div class="form-card">
            <h5>🔖 Recipient Information</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Recipient's Name <span class="text-danger">*</span></label>
                    <input type="text" name="recipient_name" class="form-control" placeholder="John Doe" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Organization <span class="text-danger">*</span></label>
                    <input type="text" name="organization" class="form-control" placeholder="ABC Corporation" required>
                </div>
            </div>
        </div>

        <div class="form-card">
            <h5>🏢 Address Details</h5>
            <div class="mb-3">
                <label class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                <input type="text" name="address1" class="form-control" placeholder="Street address" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address Line 2</label>
                <input type="text" name="address2" class="form-control" placeholder="Suite number">
            </div>
            <div class="mb-3">
                <label class="form-label">Address Line 3</label>
                <input type="text" name="address3" class="form-control" placeholder="City, ZIP code">
            </div>
        </div>

        <div class="form-card">
            <h5>📇 Client Details</h5>
            <div class="mb-3">
                <label class="form-label">Business Name <span class="text-danger">*</span></label>
                <input type="text" name="business_name" class="form-control" placeholder="Business Name" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="+94 77 123 4567" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="contact@company.com" required>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-custom">
                <i class="bi bi-file-earmark-text"></i> Submit
            </button>
        </div>
    </form>
</div>

</body>
</html>