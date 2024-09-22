<?php
include('db_connection.php');

// Load Composer's autoloader
require('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load .env variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Fetch barangays
$barangay_query = "SELECT DISTINCT barangay_name FROM locations";
$barangay_result = mysqli_query($conn, $barangay_query);

// Fetch municipalities
$municipality_query = "SELECT DISTINCT municipality_name FROM locations";
$municipality_result = mysqli_query($conn, $municipality_query);

// Sanitize input
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);
    $lastname = sanitize_input($_POST['lastname']);
    $firstname = sanitize_input($_POST['firstname']);
    $address = sanitize_input($_POST['address']);
    $barangay = sanitize_input($_POST['barangay']);
    $municipality = sanitize_input($_POST['municipality']);
    $mobile = sanitize_input($_POST['mobile']);
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $gender = sanitize_input($_POST['gender']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    // Hash the password securely
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Generate a token
    $token = bin2hex(random_bytes(16));

    $query = "INSERT INTO users (username, password, lastname, firstname, address, barangay_name, municipality_name, mobile_number, age, gender, email, token) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ssssssssisss", $username, $password_hashed, $lastname, $firstname, $address, $barangay, $municipality, $mobile, $age, $gender, $email, $token);
        if (mysqli_stmt_execute($stmt)) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            // SMTP credentials in environment variables
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], "Tater's Exam");
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Confirm your email";
            $mail->Body = 'Click <a href="http://localhost/taters/setup_password.php?token='.$token.'">here</a> to setup your password';

            // Send email
            if ($mail->send()) {
                echo "<div class='alert alert-success'>Registration successful. Please check your email.</div>";
            } else {
                error_log("Email sending failed: " . $mail->ErrorInfo);
                echo "<div class='alert alert-danger'>There was a problem sending the email. Please try again later.</div>";
            }
        } else {
            error_log("Database error: " . mysqli_error($conn));
            echo "<div class='alert alert-danger'>There was a problem with your registration. Please try again.</div>";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center text-danger">Sign Up</h1>
        <form method="POST" action="sign-up.php" class="bg-white p-4 rounded shadow">
            <div class="form-group">
                <label for="username">Username (alphanumeric):</label>
                <input type="text" class="form-control" name="username" required pattern="[A-Za-z0-9]+"
                    title="Username should be alphanumeric">
            </div>

            <div class="form-group">
                <label for="password">Password (any characters):</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" class="form-control" name="lastname" required>
            </div>

            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" class="form-control" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="address">Address (House, Street, Village):</label>
                <input type="text" class="form-control" name="address" required>
            </div>

            <div class="form-group">
                <label for="municipality">Municipality:</label>
                <select class="form-control" name="municipality" id="municipality" required>
                    <option value="">Select Municipality</option>
                    <?php
                    $query = "SELECT DISTINCT municipality_name FROM locations";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".htmlspecialchars($row['municipality_name'])."'>".htmlspecialchars($row['municipality_name'])."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="barangay">Barangay:</label>
                <select class="form-control" name="barangay" id="barangay" required>
                    <option value="">Select Barangay</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" class="form-control" name="mobile" required pattern="[0-9]{11}"
                    title="Mobile number should be 11 digits">
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" name="age" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <button type="submit" class="btn btn-danger btn-block">Sign Up</button>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        $('#municipality').on('change', function() {
            var municipality = $(this).val();

            if (municipality) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_barangays.php',
                    data: {
                        municipality: municipality
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#barangay').empty();
                        $('#barangay').append('<option value="">Select Barangay</option>');
                        $.each(response, function(index, barangay) {
                            $('#barangay').append('<option value="' + barangay +
                                '">' + barangay + '</option>');
                        });
                    }
                });
            } else {
                $('#barangay').empty();
                $('#barangay').append('<option value="">Select Barangay</option>');
            }
        });
    });
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>