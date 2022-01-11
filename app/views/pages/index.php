<?php
require APPROOT . '/views/includes/head.php';
$helper = new Helper();
?>

<body>
    <?php
    if ($helper->authenToken() == null) {
        header('location:' . URLROOT . '/users/index');
    }
    ?>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Users Management</h2>
                <h3><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></h3>
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
                            for ($i = 0; $i < sizeOf($data['info']); $i++) {
                                $row = get_object_vars($data['info'][$i]);
                        ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><img src="<?php echo URLROOT . '/public/img/avatar/' . $row['user_avatar']; ?>" width='56px'></td>
                                    <td>
                                        <button class="btn btn-warning">
                                            <a href="<?php echo URLROOT . '/pages/edit/' . $row['user_name']; ?>">Edit</a>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger">
                                            <a href="<?php echo URLROOT . '/pages/delete/' . $row['user_name']; ?>" onclick=" return confirm('Are you sure you want to delete this item?');">Delete</a>
                                        </button>
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