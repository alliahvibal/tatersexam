<?php
include('db_connection.php');

if (isset($_POST['municipality'])) {
    $municipality = mysqli_real_escape_string($conn, $_POST['municipality']);

    // Query the database for barangays in the selected municipality
    $query = "SELECT barangay_name FROM locations WHERE municipality_name = '$municipality'";
    $result = mysqli_query($conn, $query);

    $barangays = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $barangays[] = $row['barangay_name'];
    }
    
    echo json_encode($barangays);
}
?>