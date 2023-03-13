<?php
$title = 'Edit your Post';
require('shared/header.php');
?>
    <main>
        <?php 
        try {
            // get the postId from the url parameter using $_GET
            $postId = $_GET['postId'];
            if (empty($postId)) {
                header('location:404.php');
                exit();
            }

            // connect - we can re-use for the 2nd query later
            require('shared/db.php');

            // set up & run SQL query to fetch the selected post record.  fetch for 1 record only
            $sql = "SELECT * FROM posts WHERE postId = :postId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':postId', $postId, PDO::PARAM_INT);
            $cmd->execute();
            $post = $cmd->fetch();

            // check query returned a valid post record
            if (empty($post)) {
                header('location:404.php');
                exit();
            }
        }
        catch (Exception $error) {
            header('location:error.php');
            exit();
        }
        ?>
        <h1>Post Details</h1>
        <form action="update-post.php" method="post">
            <fieldset>
                <label for="body">Body:</label>
                <textarea name="body" id="body" required maxlength="4000"><?php echo $post['body']; ?></textarea>
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
                        // select the user that made the current post
                        if ($post['user'] == $user['email']) {
                            echo '<option selected>' . $user['email'] . '</option>';
                        }
                        else {
                            echo '<option>' . $user['email'] . '</option>';
                        }                       
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
            <input name="postId" id="postId" value="<?php echo $postId; ?>" type="hidden" />
        </form>
    </main>
<?php require('shared/footer.php'); ?>