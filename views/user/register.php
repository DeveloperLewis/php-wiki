<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
        <div class="container">

            <!-- 
                Register form 
            -->

            <div class="row">
                <div class="col-4">

                </div>

                <div class="col-4 mt-4">

                    <!--
                    Errors
                     -->
                    <?php 
                        if (isset($_SESSION['developer_errors']) || isset($_SESSION['name_errors']) || isset($_SESSION['email_errors']) || isset($_SESSION['password_errors'])) {

                            if (isset($_SESSION['developer_errors'])) {
                                foreach ($_SESSION['developer_errors'] as $key => $val) {
            
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $val;
                                    echo '</div>';
                                    };
                            }

                            if (isset($_SESSION['name_errors'])) {
                                foreach ($_SESSION['name_errors'] as $key => $val) {

                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $val;
                                    echo '</div>';
                                    };
                            };

                            if (isset($_SESSION['email_errors'])) {
                                foreach ($_SESSION['email_errors'] as $key => $val) {

                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $val;
                                    echo '</div>';
                                    };
                            };

                            if (isset($_SESSION['password_errors'])) {
                                foreach ($_SESSION['password_errors'] as $key => $val) {

                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $val;
                                    echo '</div>';
                                    };
                            };

                            session_destroy();
                        };

                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo 'You have successfully registered, login <a href="/user/login">here</a>.';
                            echo '</div>';

                            session_destroy();
                        };
                    ?>

                    <form action="/user/register" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php if (isset($_SESSION['saved_values'])) {echo $_SESSION['saved_values']['name'];};?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" value="<?php if (isset($_SESSION['saved_values'])) {echo $_SESSION['saved_values']['email'];};?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm-password">
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Create Account</button>
                    </form>
                </div>

                <div class="col-4">
                    
                </div>

            </div>
        </div>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>