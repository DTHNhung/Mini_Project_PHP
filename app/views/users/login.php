<?php
require APPROOT . '/views/includes/head.php';
?>

<body>

    <h2>Login Form</h2>
    <?php
    if (isLoggedIn()) {
        header('location:' . URLROOT . '/pages/index');
    }
    ?>
    <?php
    // echo $COOKIE['username'];
    ?>
    <form action="<?php echo URLROOT; ?>/users/login" method="post">
        <div class="imgcontainer">
            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter username" value="<?php echo (isset($_COOKIE['username'])) ? $_COOKIE['username'] : '';  ?>" name="username" required>
            <div class="invalidFeedback">
                <?php echo $data['usernameError'] ?>
            </div>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" value="<?php echo (isset($_COOKIE['password'])) ? $_COOKIE['password'] : '';  ?>" name=" password" required>
            <div class="invalidFeedback">
                <?php echo $data['passwordError'] ?>
            </div>
            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <span class="psw"><a href="<?php echo URLROOT; ?>/users/register">Đăng kí</a></span>

        </div>
    </form>
</body>

</html>