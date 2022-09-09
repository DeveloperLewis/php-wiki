<?php
/* @var $params */
?>

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

            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo $_SESSION['error'];
                echo '</div>';

                unset($_SESSION['error']);
            }

            if (!$images_array = \classes\models\media\Image::pagination(12, $params['amount'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo "No images found, try uploading some!";
                echo '</div>';

            }
            ?>

            <hr>
        </div>

        <div class="images">
            <div class="row">

                <?php if (is_array($images_array)) { ?>
                <?php foreach ($images_array as $image) { ?>


                <div class="col-xl-2 mt-3">
                    <div class="card" id="<?= $image['image_id'] ?>">
                        <img class="card-img-top" src="../../<?= $image['location'] ?>" height="160">
                        <div class="card-body">
                                <small class="float-start text-muted"><strong><?php
                                    $functions = new \classes\Functions();
                                    echo round($functions->convertBytes($image['storage_size'], "kb")). 'kb';
                                        ?></strong>

                                    <br><?= $image['upload_date']?>
                                </small>

                                <form action="/image/delete" method="post" class="float-end">
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    <input type="hidden" value="<?= $image['location']?>" name="location">
                                    <input type="hidden" value="<?= $image['image_id']?>" name="id">
                                </form>
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
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-danger" href="/admin/dashboard"><i class="fa-solid fa-arrow-left"></i> Go Back</a>

                        <?php
                        //pagination button controller
                        $total_amount = \classes\models\media\Image::getTotalCount();
                        $limit_amount = 12;
                        $max_pagination_items = 3;
                        ?>

                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link <?php if (($params['amount'] - 12) < 0) { echo "disabled"; }?>" href="/admin/images?amount=<?= $params['amount'] - 12 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                                $current_pagination_items = 0;
                                for ($i = $params['amount']; $i < $total_amount; $i += $limit_amount) {
                                    $current_pagination_items++;
                                    if ($current_pagination_items < 4) {
                                        echo ' <li class="page-item"><a class="page-link" href="/admin/images?amount=' . $i .'">' . $i / 12 .'</a></li>';
                                    }
                                }
                                ?>
                                <li class="page-item">
                                    <a class="page-link <?php if (($params['amount'] + 12) > $total_amount) { echo "disabled"; }?>" href="/admin/images?amount=<?= $params['amount'] + 12 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <a class="btn btn-primary" href="/image/new">Upload New</a>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>