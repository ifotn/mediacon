
<?php
$title = 'Register';
require('shared/header.php');
?>
<main>
<h1>User Registration</h1>
    <h5>Passwords must be a minimum of 8 characters,
        including 1 digit, 1 upper-case letter, and 1 lower-case letter.
    </h5>
    <form method="post" action="save-registration.php" id="demo-form">
        <fieldset>
            <label for="username">Username: *</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset>
            <label for="password">Password: *</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            <img id="imgShowHide" src="img/show.png" alt="Show/Hide"
                onclick="showHide();" />
        </fieldset>
        <fieldset>
            <label for="confirm">Confirm Password: *</label>
            <input type="password" name="confirm" id="confirm" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                onkeyup="return comparePasswords();" />
            <span id="pwMsg" class="error"></span>
        </fieldset>
        <button class="btnOffset g-recaptcha" onclick="return comparePasswords();"
        data-sitekey="6LejQHUlAAAAAIVd4FszR25DzM9QYgpXaYLzUin1" 
        data-callback='onSubmit' 
        data-action='submit'>Register</button>
    </form>
</main>
<!-- Google Recaptcha v3 API -->
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
<?php require('shared/footer.php'); ?>
