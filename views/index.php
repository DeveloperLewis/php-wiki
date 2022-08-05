<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4">
        <?php 

            if(isset($_SESSION['uid'])) {
                $name = classes\models\user\User::getName($_SESSION['uid']);
                $date = classes\models\user\User::getCreatedAt($_SESSION['uid']);

                echo "Welcome back " . $name['first_name'] . ", your account was created at: " . $date['created_at'];
            }

        ?>
        </div>
        <div class="col-4">
        </div>
    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>