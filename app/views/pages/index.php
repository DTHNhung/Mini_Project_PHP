<?php
require APPROOT . '/views/includes/head.php';
?>

<body>
    <?php
    if (isLoggedIn() == false) {
        header('location:' . URLROOT . '/users/login');
    }

    ?>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Users Management</h2>
                <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Avatar</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data['info'])) {
                            for($i = 0; $i < sizeOf($data['info']); $i++) {
                                $row = get_object_vars($data['info'][$i]);
                        ?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><img src="<?php echo URLROOT . '/public/img/avatar/' . $row['user_avatar']; ?>" 
                                width='56px'></td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                            </td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>