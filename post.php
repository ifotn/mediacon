<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <h1>Create a New Post</h1>
    <form action="save-post.php" method="post">
        <fieldset>
            <label for="body">Body:</label>
            <textarea name="body" id="body"></textarea>
        </fieldset>
        <fieldset>
            <label for="user">User:</label>
            <input name="user" id="user" />
        </fieldset>
        <button>Post</button>
    </form>
</body>
</html>