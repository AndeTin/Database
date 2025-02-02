<?php
include 'db.php';

$message = '';

if (isset($_POST['add'])) {
    $User_first_name = $_POST['User_first_name'];
    $User_last_name = $_POST['User_last_name'];
    $User_gender = $_POST['User_gender'];
    $User_email = $_POST['User_email'];
    $User_birthday = $_POST['User_birthday'];
    $User_permission = $_POST['User_permission'];
    $User_passwd = password_hash('defaultpassword', PASSWORD_BCRYPT); // 默认密码，可以让用户登录后更改

    $sql = "INSERT INTO user (User_first_name, User_last_name, User_gender, User_email, User_birthday, User_passwd, User_permission) 
            VALUES ('$User_first_name', '$User_last_name', '$User_gender', '$User_email', '$User_birthday', '$User_passwd', '$User_permission')";

    if ($conn->query($sql) === TRUE) {
        $message = "User added successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['update'])) {
    $User_ID = $_POST['User_ID'];
    $User_first_name = $_POST['User_first_name'];
    $User_last_name = $_POST['User_last_name'];
    $User_gender = $_POST['User_gender'];
    $User_email = $_POST['User_email'];
    $User_birthday = $_POST['User_birthday'];
    $User_passwd = $_POST['User_passwd'];
    $User_permission = $_POST['User_permission'];

    $sql = "UPDATE user SET 
            User_first_name='$User_first_name', 
            User_last_name='$User_last_name', 
            User_gender='$User_gender', 
            User_email='$User_email', 
            User_birthday='$User_birthday', 
            User_permission='$User_permission' 
            WHERE User_ID='$User_ID'";

    if ($conn->query($sql) === TRUE) {
        $message = "User updated successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $User_ID = $_POST['User_ID'];

    $sql = "DELETE FROM user WHERE User_ID='$User_ID'";

    if ($conn->query($sql) === TRUE) {
        $message = "User deleted successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: manage_users.php?message=" . urlencode($message));
exit();
?>
