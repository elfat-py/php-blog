<?php
    require_once 'includes/header.php';
?>
<div class="auth-form-container">
    <h1 class="auth-welcome">User registration page</h1>

    <form method="post" action="includes/register-inc.php">
        <div class="auth-container">
            <label for="name">Full Name</label>
            <input type="text" name="full-name" id="name" required>


            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>

            <label for="age">Age</label>
            <input type="text" name="age" id="age" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="password-confirm">Password Confirm</label>
            <input type="password" name="password-confirm" id="password-confirm" required>
            <input type="submit"  name="submit" value="Register">
        </div>
    </form>
</div>
<?php
    require_once 'includes/footer.php';
?>
