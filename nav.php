<?php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        echo '<nav class="navbar">
            <a href="index.php">Home</a>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="view_users.php">Manage Users</a>
            <a href="add_user.php">Add User</a>
            <a href="reports.php">Reports</a>
            <a href="logout.php">Logout</a>
        </nav>';
    } else {
        echo '<nav class="navbar">
            <a href="index.php">Home</a>
            <a href="user_dashboard.php">Dashboard</a>
            <a href="create_request.php">Create Request</a>
            <a href="view_requests.php">My Requests</a>
            <a href="logout.php">Logout</a>
        </nav>';
    }
}
?>
