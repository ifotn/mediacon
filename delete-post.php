<?php
// no html required as this is an invisible page
// it deletes the post then redirects to the updated feed

// identify which post to remove. use $_GET to read the url param called "postId"
$postId = $_GET['postId'];

// connect to db
$db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

// create SQL delete statement
$sql = "DELETE FROM posts WHERE postId = :postId";
$cmd = $db->prepare($sql);

// populate the SQL delete with the selected postId
$cmd->bindParam(':postId', $postId, PDO::PARAM_INT);

// execute delete in the database
$cmd->execute();

// disconnect 
$db = null;

// redirect to updated feed
//echo 'Deleted';
header('location:posts.php');
?>