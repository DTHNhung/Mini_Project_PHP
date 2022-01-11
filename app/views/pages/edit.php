<?php
require APPROOT . '/views/includes/head.php';
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="container">
        <h1>Edit</h1>
        <hr>
        <label for=""><b>Username</b></label>
        <input type="text" name="username" 
            value="<?php echo $data['username']; ?>" required>
        <div class="invalidFeedback">
            <?php if (isset($data['usernameError'])) echo $data['usernameError']; ?>
        </div>

        <label for="psw"><b>Old Password</b></label>
        <input type="password" name="oldPassword" 
            value="<?php echo $data['oldPassword']; ?>" required>
        <div class="invalidFeedback">
            <?php if (isset($data['oldPasswordError'])) echo $data['oldPasswordError']; ?>
        </div>

        <label for="psw"><b>New Password</b></label>
        <input type="password" name="newPassword" 
            value="<?php echo $data['newPassword']; ?>" >
        <div class="invalidFeedback">
            <?php if (isset($data['newPasswordError'])) echo $data['newPasswordError']; ?>
        </div>

        <label for="psw-repeat"><b>Confirm Password</b></label>
        <input type="password" name="confirmPassword" 
            value="<?php echo $data['confirmPassword']; ?>" >
        <div class="invalidFeedback">
            <?php if (isset($data['confirmPasswordError'])) echo $data['confirmPasswordError']; ?>
        </div>

        <label for=""><b>Avatar</b></label>
        <input type="file" name="file" id="file" required >
        <div class="invalidFeedback">
            <?php if (isset($data['fileError'])) echo $data['fileError']; ?>
        </div>
        
        <div class="clearfix">
            <button type="submit" class="submit">Edit</button>
        </div>
    </div>
</form>