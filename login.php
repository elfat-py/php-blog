<?php
    require_once 'includes/header.php';
?>
<div class="auth-form-container">
    <h1 class="auth-welcome">User log in page</h1>

    <form method="post" action="includes/login-inc.php">
        <div class="auth-container">
            <label for="username">Username</label>
            <input type="text" name="username1" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password1" id="password" required>
            <input type="submit"  name="submit" value="Log In">
        </div>
    </form>
</div>
<?php
    require_once 'includes/footer.php';
?>
