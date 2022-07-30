<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <div class="container">

    <!-- 
        Login Form
    -->

    <div class="row">
        <div class="col-4">

        </div>

        <div class="col-4 mt-4">

            <?php
                if (isset($_SESSION['empty_errors'])) {
                    foreach ($_SESSION['empty_errors'] as $key => $val) {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $val;
                        echo '</div>';
                    };

                    session_destroy();
                }

                if (isset($_SESSION['login_error'])) {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $_SESSION['login_error'];
                        echo '</div>';

                    session_destroy();
                }

                if (isset($_SESSION['developer_errors'])) {
                    foreach ($_SESSION['developer_errors'] as $key => $val) {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $val;
                        echo '</div>';
                    };

                session_destroy();
                }
            ?>

            <form action="/user/login" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
        </div>

        <div class="col-4">
            
        </div>

    </div>
    </div>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>