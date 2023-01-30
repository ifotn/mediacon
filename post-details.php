<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <?php 
    //date_default_timezone_set("America/Toronto");
    //$d = date('y-m-d h:i');
    //echo $d; ?>
    <h1>Create a New Post</h1>
    <form action="save-post.php" method="post">
        <fieldset>
            <label for="body">Body:</label>
            <textarea name="body" id="body" required maxlength="4000"></textarea>
        </fieldset>
        <fieldset>
            <label for="user">User:</label>
            <select name="user" id="user">
                <?php
                // connect
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

                // use SELECT to fetch the users
                $sql = "SELECT * FROM users";

                // run the query
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $users = $cmd->fetchAll();

                // loop through the user data to create a list item for each
                foreach ($users as $user) {
                    echo '<option>' . $user['email'] . '</option>';
                }

                // disconnect
                $db = null;
                ?>
            </select>
        </fieldset>
        <button>Post</button>
    </form>
</body>
</html>