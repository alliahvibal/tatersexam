<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #ffffff;
    }

    .container {
        margin-top: 100px;
        text-align: center;
    }

    h1 {
        color: #c72c3b;
        /* Red color */
        font-size: 2.5em;
        margin-bottom: 20px;
    }

    .btn-custom {
        background-color: #c72c3b;
        /* Red */
        color: white;
    }

    .btn-custom:hover {
        background-color: #a0212e;
        /* Darker red */
    }

    .btn-secondary-custom {
        background-color: #000000;
        /* Black */
        color: white;
    }

    .btn-secondary-custom:hover {
        background-color: #444444;
        /* Dark gray */
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to the Application</h1>
        <p>Please choose an option:</p>

        <a href="sign-up.php" class="btn btn-custom btn-lg">Create an Account</a>
        <a href="sign-in.php" class="btn btn-secondary-custom btn-lg">Login</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>