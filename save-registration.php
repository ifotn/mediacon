<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving your Registration...</title>
</head>
<body>
    <?php
    // capture user data from form POST
    $email = $_POST['email'];

    // connect
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

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
    ?>
</body>
</html>