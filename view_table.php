<?php
session_start();

date_default_timezone_set('Asia/Colombo');

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'db_connect.php';

// Handle search functionality
$search = "";
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

// Build SQL query with optional search filter
$sql = "SELECT * FROM letters WHERE 1=1"; // Base query
if (!empty($search)) {
    $search = $conn->real_escape_string($search); // Prevent SQL injection
    $sql .= " AND (recipient_name LIKE '%$search%' OR organization LIKE '%$search%' OR business_name LIKE '%$search%')";
}
$sql .= " ORDER BY id DESC"; // Sort by ID in descending order

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Letters</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        /* Search Bar Styling */
        .search-bar {
            position: relative;
        }
        .search-bar input {
            padding-right: 40px; /* Space for the clear button */
        }
        .search-bar .clear-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #aaa;
            cursor: pointer;
            font-size: 1.2rem;
        }
        .search-bar .clear-btn:hover {
            color: #000;
        }
        /* Placeholder Animation */
        .search-bar input::placeholder {
            transition: opacity 0.3s ease;
        }
        .search-bar input:focus::placeholder {
            opacity: 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">📋 List of Letters</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a>

        <!-- Search Bar -->
        <form method="GET" class="search-bar mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by recipient name, organization, or business name" value="<?= htmlspecialchars($search) ?>" aria-label="Search">
                <button type="submit" class="btn btn-primary">Search</button>
                <?php if (!empty($search)): ?>
                    <button type="button" class="clear-btn" onclick="clearSearch()">&times;</button>
                <?php endif; ?>
            </div>
        </form>
        <!-- Letters Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Recipient Name</th>
                    <th>Organization</th>
                    <th>Business Name</th>
                  
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['recipient_name']) ?></td>
                            <td><?= htmlspecialchars($row['organization']) ?></td>
                            <td><?= htmlspecialchars($row['business_name']) ?></td>
                         
                            <td>
                                <a href="<?= htmlspecialchars($row['letter_url']) ?>" class="btn btn-primary btn-sm">View Letter</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No letters found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- JavaScript for Clear Button -->
    <script>
        function clearSearch() {
            document.querySelector('.search-bar input').value = '';
            document.querySelector('.search-bar form').submit();
        }
    </script>
</body>
</html>