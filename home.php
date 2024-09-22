<?php
session_start();

include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: sign_in.php");
    exit();
}
$username = $_SESSION['username'];

$query = "SELECT firstname FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $firstname = $row['firstname'];
} else {
    $firstname = "User"; 
}
$stmt->close();

// Handle report queries
$reportData = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filterType = $_POST['filterType'] ?? '';
    $filterValue = $_POST['filterValue'] ?? '';

    $query = "SELECT username, CONCAT(lastname, ', ', firstname) AS name, barangay_name, municipality_name, mobile_number, age, gender FROM users";
    
    if ($filterType === 'barangay' && !empty($filterValue)) {
        $query .= " WHERE barangay_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $filterValue);
    } elseif ($filterType === 'municipality' && !empty($filterValue)) {
        $query .= " WHERE municipality_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $filterValue);
    } elseif ($filterType === 'age' && is_numeric($filterValue)) {
        $query .= " WHERE age = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $filterValue);
    } elseif ($filterType === 'gender' && in_array($filterValue, ['M', 'F'])) {
        $query .= " WHERE gender = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $filterValue);
    } elseif ($filterType === 'all' && !empty($filterValue)) {
        $query .= " WHERE username LIKE ? OR CONCAT(lastname, ', ', firstname) LIKE ?";
        $stmt = $conn->prepare($query);
        $likeFilterValue = '%' . $filterValue . '%';
        $stmt->bind_param('ss', $likeFilterValue, $likeFilterValue);
    } else {
        $stmt = $conn->prepare($query);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $reportData[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #dc3545;">

        <a class="navbar-brand text-white" href="#">Taters Exam</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-danger">Hello, <?php echo htmlspecialchars($firstname); ?>👋 Welcome to my Test Page!</h1>

        <form method="POST" action="" class="mb-4">
            <div class="form-group">
                <label for="filterType">Select Filter:</label>
                <select name="filterType" id="filterType" class="form-control" required>
                    <option value="">--Select--</option>
                    <option value="all">All Data</option>
                    <option value="barangay">By Barangay</option>
                    <option value="municipality">By Municipality</option>
                    <option value="age">By Age</option>
                    <option value="gender">By Gender</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="filterValue" class="form-control" placeholder="Enter value">
            </div>

            <button type="submit" class="btn btn-danger btn-block">Query Reports</button>
        </form>

        <h2>Report Results:</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Barangay</th>
                    <th>Municipality</th>
                    <th>Mobile Number</th>
                    <th>Age</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reportData)): ?>
                <?php foreach ($reportData as $data): ?>
                <tr>
                    <td><?php echo htmlspecialchars($data['username']); ?></td>
                    <td><?php echo htmlspecialchars($data['name']); ?></td>
                    <td><?php echo htmlspecialchars($data['barangay_name']); ?></td>
                    <td><?php echo htmlspecialchars($data['municipality_name']); ?></td>
                    <td><?php echo htmlspecialchars($data['mobile_number']); ?></td>
                    <td><?php echo htmlspecialchars($data['age']); ?></td>
                    <td><?php echo htmlspecialchars($data['gender']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No results found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>