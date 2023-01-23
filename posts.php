<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="css/app.css" />
</head>
<body>
    <h1>Posts</h1>
    <?php
    // connect to db
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

    // set up the SQL SELECT command
    $sql = "SELECT * FROM posts";

    // execute the select query
    $cmd = $db->prepare($sql);
    $cmd->execute();

    // store the query results in an array. use fetchAll for multiple records, fetch for 1.
    $posts = $cmd->fetchAll();

    echo '<table>
        <thead><th>Body</th><th>User</th><th>Date</th></thead>';

    // display post data in a loop. $posts = all data, $post = the current item in the loop
    foreach ($posts as $post) {
        echo '<tr>
            <td>' . $post['body'] . '</td>
            <td>' . $post['user']. '</td>
            <td>' . $post['dateCreated']. '</td>
        </tr>';
    }

    // close table
    echo '</table>';

    // disconnect
    $db = null;
    ?>
</body>
</html>