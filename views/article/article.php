<?php
/* @var $article */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

    <?php
    //If the article did not return anything based on the params, display this:
    if (isset($not_found)) {
        echo '<h2 class="text-center">' . $not_found . '</h2>';
    } else {
        ?>

            <div class="container-fluid mt-4" style="max-width: 1100px;">
                <div class="card">
                    <div class="card-header">
                        <small class="text-muted">Written By: <?php $author = \classes\models\user\User::getName($article['original_author']); echo $author['first_name'] ?>, </small>
                        <small class="text-muted">Written On: <?= substr($article['creation_date'], 0, 10); ?> </small>
                        <span class="badge bg-primary float-end"><?php $cat = \classes\models\article\Category::getName($article['category_ids']); echo $cat['category_name']; ?></span>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h2 class=""><?= $article['title']?></h2>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p><?= $article['body']?><p>

                                    <?php
                                    if (!empty($article['notes'])) {
                                        echo '<hr>';
                                        echo '<p>' . $article['notes'] . '<p>';
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>

<?php require_once('includes/footer.php'); ?>
</body>
</html>