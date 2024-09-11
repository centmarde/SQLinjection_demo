<?php
require 'db.php';

$response = array('status' => 'error', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $username = $_POST['username'];
    $password = $_POST['password'];


    /* $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); */

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $response['status'] = 'success';
        $response['message'] = 'Login successful!';

        $allUsersSql = "SELECT * FROM user";
        $allUsersResult = $conn->query($allUsersSql);

        if ($allUsersResult->num_rows > 0) {
            $response['users'] = array();
            while($row = $allUsersResult->fetch_assoc()) {
                $response['users'][] = $row;
            }
        } else {
            $response['message'] = 'No users found!';
        }
    } else {
        $response['message'] = 'Login failed! Invalid credentials.';
    }

    $conn->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
