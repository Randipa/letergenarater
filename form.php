<?php include 'header.php'; ?>

<div class="container">
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