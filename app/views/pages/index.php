<?php
require APPROOT . '/views/includes/head.php';
$helper = new Helper();
?>

<body>
    <?php
    if ($helper->authenToken() == null) {
        header('location:' . URLROOT . '/users/login');
    }

    ?>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Users Management (<a href="<?php echo URLROOT; ?>/users/logout">Thái Hùng</a>)</h2>
                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                    <h1><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></h1>
                <?php } else { ?>
                    <h1><a href="<?php echo URLROOT; ?>/users/login">Login</a></h1>
                <?php } ?>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td><button class="btn btn-warning">Edit</button></td>
                            <td><button class="btn btn-danger" onclick="deleteUser(1)">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function deleteUser(id) {
            var option = confirm('Ban co chac chan muon xoa thong tin nguoi dung khong???')
            if (!option) return
            //cái này đang sử dụng api
            $.post('form/form-user.php', {
                'action': 'delete',
                'id': id
            }, function(data) {
                location.reload()
            })
        }
    </script>
</body>