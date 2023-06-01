<?php if (isset($_SESSION['email'])) {
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $user_id = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $user_type = $row['user_type'];
        $created_at = $row['created_at'];
    }
}
