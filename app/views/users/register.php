<?php
require APPROOT . '/views/includes/head.php';
?>
<form action="<?php echo URLROOT; ?>/users/register" method="post" enctype="multipart/form-data">
    <div class="container">
        <h1>Register</h1>
        <hr>
        <label for=""><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" 
            value="<?php if (isset($data['username'])) echo $data['username']; ?>" required>
        <div class="invalidFeedback">
            <?php if (isset($data['usernameError'])) echo $data['usernameError']; ?>
        </div>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" 
            value="<?php if (isset($data['email'])) echo $data['email']; ?>" required>
        <div class="invalidFeedback">
            <?php if (isset($data['emailError'])) echo $data['emailError']; ?>
        </div>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" 
            value="<?php if (isset($data['password'])) echo $data['password']; ?>" required>
        <div class="invalidFeedback">
            <?php if (isset($data['passwordError'])) echo $data['passwordError']; ?>
        </div>
        <label for="psw-repeat"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="confirmPassword" 
            value="<?php if (isset($data['confirmPassword'])) echo $data['confirmPassword']; ?>" required>
        <div class="invalidFeedback">
            <?php if (isset($data['confirmPasswordError'])) echo $data['confirmPasswordError']; ?>
        </div>
        <label for=""><b>Avatar</b></label>
        <input type="file" name="file" id="file" required >
        <div class="invalidFeedback">
            <?php if (isset($data['fileError'])) echo $data['fileError']; ?>
        </div>
        <div class="clearfix">
            <button type="submit" class="submit">Register</button>
        </div>
    </div>
</form>