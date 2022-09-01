<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
    <div class="m-4">

        <div class="text-center m-4">
            <h1>Images</h1>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['success'];
                echo '</div>';

                unset($_SESSION['success']);
            }

            if (!$images_array = \classes\models\media\Image::getAll()) {
                echo '<div class="alert alert-danger" role="alert">';
                echo "No images found, try uploading some!";
                echo '</div>';

                unset($_SESSION['success']);
            }
            ?>

            <hr>
        </div>

        <div class="images">
            <div class="row">

                <?php if (is_array($images_array)) { ?>
                <?php foreach ($images_array as $image) { ?>


                <div class="col-xl-2 mt-1">
                    <div class="card selectable" onClick="imageSettings(this.id)" id="<?= $image['image_id'] ?>">
                        <img class="card-img-top" src="../../<?= $image['location'] ?>" height="150">
                        <div class="card-body">
                                <small class="float-start text-muted"><?php
                                    $functions = new \classes\Functions();
                                    echo round($functions->convertBytes($image['storage_size'], "kb")). 'kb';
                                    ?>
                                </small>

                                <small class="float-end text-muted"><?php
                                    $uploader_name = \classes\models\user\User::getName($image['uploader_id']);
                                    echo $uploader_name['first_name'];
                                    ?>
                                </small>
                        </div>
                    </div>
                </div>

                <?php
                    }
                }
                ?>

            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <div class="float-start">
                    <a class="btn btn-danger" href="/admin/dashboard"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="/image/new">Upload New</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function imageSettings(id) {
        alert(id);
    }
</script>
<?php require_once('includes/footer.php'); ?>
</body>
</html>