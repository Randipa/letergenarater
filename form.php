<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission Request Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logo-infive.png" alt="Infive Logo" width="150" height="30">
        </a>
    </div>
</nav>

<!-- Form Container -->
<div class="container mt-5">
    <h2>📄 Permission Request Form</h2>
    <p class="text-muted">Fill in the details to generate the official request letter</p>

    <form id="letterForm" method="POST" action="generate.php">
        <!-- Recipient Information -->
        <div class="mb-4">
            <h5>🔖 Recipient Information</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Recipient's Name <span class="text-danger">*</span></label>
                    <input type="text" name="recipient_name" id="recipient_name" class="form-control" placeholder="John Doe" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIC Number <span class="text-danger">*</span></label>
                    <input type="text" name="nic_number" id="nic_number" class="form-control" placeholder="123456789V" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Organization <span class="text-danger">*</span></label>
                    <input type="text" name="organization" id="organization" class="form-control" placeholder="ABC Corporation" required>
                </div>
            </div>
        </div>

        <!-- Address Details -->
        <div class="mb-4">
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
        <div class="mb-4">
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
            <button type="button" class="btn btn-custom" onclick="previewLetter()">View Your Finished Letter</button>
        </div>

        <!-- Modal for Preview -->
        <div class="modal fade" id="letterModal" tabindex="-1" aria-labelledby="letterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="letterModalLabel">Request Letter Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBodyContent">
                        <!-- Preview content will be injected here -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-custom">Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    function previewLetter() {
        const recipientName = document.getElementById('recipient_name').value.trim();
        const nicNumber = document.getElementById('nic_number').value.trim();
        const organization = document.getElementById('organization').value.trim();
        const address1 = document.getElementById('address1').value.trim();
        const businessName = document.getElementById('business_name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();

        const phonePattern = /^[0-9]{10,18}$/;
        if (!phonePattern.test(phone)) {
            alert('Please enter a valid phone number (10 to 18 digits).');
            return;
        }

        if (!recipientName || !nicNumber || !organization || !address1 || !businessName || !email) {
            alert('Please fill in all required fields.');
            return;
        }

        const previewContent = `
            <p>Dear Sir/Madam,</p>
            
            <p>I would like to formally authorize <strong>Infive Pvt Ltd</strong> to print identity cards bearing the Sri Lankan government logo for <strong>${businessName}</strong>.</p>
            <p>To proceed with this printing, I give my consent to use the state emblem on identity cards issued for official purposes by my organization and to continue this process under my guidance.</p>
            <div class="contact-info mt-4">
                <h6>Contact Information:</h6>
                <ul class="list-unstyled">
                    <li>📞 <strong>${phone}</strong></li>
                    <li>✉️ <strong>${email}</strong></li>
                </ul>
            </div>
        `;

        document.getElementById('modalBodyContent').innerHTML = previewContent;

        const myModal = new bootstrap.Modal(document.getElementById('letterModal'), { keyboard: false });
        myModal.show();
    }
</script>

</body>
</html>
