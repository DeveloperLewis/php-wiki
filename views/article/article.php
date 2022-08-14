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

        <div class="container">
            <div class="card m-4">
                <div class="row">
                    <div class="col">
                        <h2 class="text-center card m-2"><?= $article['title']?></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col card m-3">
                        <p class="text-center"><?= $article['body']?><p>
                        <hr>
                        <p class="text-center"><?= $article['notes']?><p>
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