<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving your Post...</title>
</head>
<body>
    <?php
    // capture the form body input using the $_POST array & store in a var
    $body = $_POST['body'];
    $user = $_POST['user'];

    // calculate the date and time with php
    $dateCreated = date("d/m/y h:i");
    //echo $dateCreated;
    //echo $body;

    // connect to the db using the PDO library
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');
    if ($db) {
        echo 'Connected';
    }
    else {
        echo 'Connection Failed';
    }

    // set up an SQL INSERT
    $sql = "INSERT INTO posts (body, user, dateCreated) VALUES (:body, :user, :dateCreated)";

    // map each input to the corresponding db column
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':body', $body, PDO::PARAM_STR, 4000);
    $cmd->bindParam(':user', $user, PDO::PARAM_STR, 100);
    $cmd->bindParam(':dateCreated', $dateCreated, PDO::PARAM_STR);

    // execute the insert
    $cmd->execute();

    // disconnect
    $db = null;

    // show the user a message
    echo 'Post saved';
    ?>
</body>
</html>