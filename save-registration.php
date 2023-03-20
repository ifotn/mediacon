<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving your Registration...</title>
    <link rel="stylesheet" href="css/app.css" />
</head>
<body>
    <?php
    // capture user data from form POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // validation
    $ok = true;

    if (empty($username)) {
        echo '<p class="error">Username is required.</p>';
        $ok = false;
    }

    // check email formatting too
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo '<p class="error">Email format is invalid.</p>';
        $ok = false;   
    }

    if (empty($password)) {
        echo '<p class="error">Password is required.</p>';
        $ok = false;
    }

    if ($password != $confirm) {
        echo '<p class="error">Passwords must match.</p>';
        $ok = false;
    }

    if ($ok == true) {
        // connect
        require('shared/db.php');

        // set up SQL insert
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        // set up and fill the parameter values for safety
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);

        // hash the password before binding it to the :password parameter
        $password = password_hash($password, PASSWORD_DEFAULT);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);

        // execute the sql command
        $cmd->execute();

        // disconnect
        $db = null;

        // show confirmation
        echo 'Your Registration was Successful!';
    }
        
    ?>
</body>
</html>