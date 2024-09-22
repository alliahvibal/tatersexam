<?php
session_start();
include('db_connection.php');

// Check if the token is valid
if (!isset($_GET['token'])) {
    echo "No token provided.";
    exit;
}

$token = $_GET['token'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Verify the token and update the password in the database
    $query = "SELECT * FROM users WHERE token='$token'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // Token is valid, update the password
        $update_query = "UPDATE users SET password='$new_password', token=NULL WHERE token='$token'";
        mysqli_query($conn, $update_query);
        
        header("Location: sign-in.php");
        exit;
    } else {
        echo "Invalid token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Up Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-danger text-center">Create password</h1>

        <form method="POST" action="setup_password.php?token=<?php echo htmlspecialchars($token); ?>" class="mt-4">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-danger btn-block">Set Password</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>