<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
    <div class="m-4 row">
        <div class="col-md-3">

        </div>

        <div class="col-md-6">

            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo $_SESSION['error'];
                echo '</div>';

                unset($_SESSION['error']);
            }
            ?>
            <div class="d-flex justify-content-center">

                <form action="/image/new" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="file" accept=".jpg, .jpeg, .png, .gif" name="file" id="file" >
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="float-end">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>

                            <div class="float-start">
                                <button class="btn btn-danger float-start" type="button" id="cancel-button">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-3">

        </div>
    </div>
</div>

<script>
    let cancelButton = document.getElementById('cancel-button');
    //Confirm user wants to cancel creating article.
    cancelButton.addEventListener('click', function() {
        let c = confirm('Are you sure you want to cancel uploading an image?');

        if (c) {
            console.log('User clicked ok')
            window.location.href = "/admin/images?amount=0"
        } else {
            console.log('user clicked cancel')
        }
    }, false);
</script>

<?php require_once('includes/footer.php'); ?>
</body>
</html>