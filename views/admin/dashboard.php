<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
    <div class="card m-4">
        <div class="text-center">
            <h3>Welcome back, USERNAME</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-2 fixed">
                    <div class="card">
                        <p class="m-1 btn btn-primary">Dashboard</p>
                        <p class="m-1 btn btn-primary">Posts</p>
                    </div>
                </div>

                <div class="col-10">
                    <div class="card">
                        <p class="text-center">Here is some text on the larger panel</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>