<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <!-- normalize to remove browser default styles -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- our custom css -->
    <link rel="stylesheet" href="css/app.css" />
</head>
<body>
    <header>
        <h1>
            <a href="#">
                MediaCon
            </a>
        </h1>
        <nav>
            <ul>
                <li><a href="posts.php">Posts</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php 
        // get the postId from the url parameter using $_GET
        $postId = $_GET['postId'];

        // connect - we can re-use for the 2nd query later
        $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

        // set up & run SQL query to fetch the selected post record.  fetch for 1 record only
        $sql = "SELECT * FROM posts WHERE postId = :postId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':postId', $postId, PDO::PARAM_INT);
        $cmd->execute();
        $post = $cmd->fetch();

        ?>
        <h1>Post Details</h1>
        <form action="update-post.php" method="post">
            <fieldset>
                <label for="body">Body:</label>
                <textarea name="body" id="body" required maxlength="4000">
                    <?php echo $post['body']; ?>
                </textarea>
            </fieldset>
            <fieldset>
                <label for="user">User:</label>
                <select name="user" id="user">
                    <?php
                    

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
            <fieldset>
                <label>Date Created:</label>
                <?php echo $post['dateCreated']; ?>
            </fieldset>
            <button class="btnOffset">Update</button>
        </form>
    </main>
</body>
</html>