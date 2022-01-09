<?php
require APPROOT . '/views/includes/head.php';
?>


<form action="<?php echo URLROOT; ?>/users/register" style="border:1px solid #ccc" method="post">
    <div class="container">
        <h1>Register</h1>
        <hr>
        <label for=""><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <div class="invalidFeedback">
            <?php echo $data['usernamelError'] ?>
        </div>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <div class="invalidFeedback">
            <?php echo $data['emailError'] ?>
        </div>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <div class="invalidFeedback">
            <?php echo $data['passwordError'] ?>
        </div>
        <label for="psw-repeat"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="confirmPassword" required>
        <div class="invalidFeedback">
            <?php echo $data['confirmPasswordlError'] ?>
        </div>


        <div class="clearfix">
            <button type="submit" class="signupbtn">Register</button>
        </div>
    </div>
</form>