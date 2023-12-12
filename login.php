<?php
session_start();
include('config.php');

$login_button = '';

// Check if the user is already logged in
if (isset($_SESSION['access_token'])) {
    header("Location: index.php"); // Redirect to dashboard if logged in
    exit();
}

if (isset($_GET["code"])) {
    // Code to handle token fetching and user data retrieval (unchanged)
    // ...

    // If user data is fetched, set session variables
    if (!empty($data['given_name'])) {
        $_SESSION['user_first_name'] = $data['given_name'];
    }
    // Similarly, set other user data in session variables...
}

if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '"><img src="sign-in-with-google.png" width="250" height="65"></a>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login | API Website</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin-left: 500px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 500px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .or-text {
            font-size: 14px;
            margin: 5px 0;
        }
      
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>Login</h2>
            <form>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="submit" value="Login">
            </form>
            <div class="or-text">or</div>
            <div class="panel panel-default">
                <form action="login.php" method="post">
                    <?php
                    if ($login_button == '') {
                        if (isset($_SESSION['user_image'])) {
                            echo '<img src="' . $_SESSION["user_image"] . '" class="img-responsive img-circle img-thumbnail" />';
                        }
                        echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
                        echo '<h3><b>Name :</b> ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h3>';
                        echo '<h3><b>Email :</b> ' . $_SESSION['user_email_address'] . ' </h3>';
                        echo '<h3><a href="logout.php">Logout</h3></div>';
                    } else {
                        echo '<div class="google-login">' . $login_button . '</div>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>