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
    $email = $_POST['email'];

    // validation
    $ok = true;

    if (empty($email)) {
        echo '<p class="error">Email is required.</p>';
        $ok = false;
    }

    // check email formatting too
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p class="error">Email format is invalid.</p>';
        $ok = false;   
    }

    if ($ok == true) {
        // connect
        $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

        // set up SQL insert
        $sql = "INSERT INTO users (email) VALUES (:email)";

        // set up and fill the parameter values for safety
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 100);

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