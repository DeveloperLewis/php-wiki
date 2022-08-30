<?php
session_start();
$title = $_POST['title'];
$body = $_POST['body'];
$category = $_POST['category'];
$notes = $_POST['notes'];

$validator = new \classes\Validation();
$title = $validator->purifyHtml($title);
$body = $validator->purifyHtml($body);
$notes = $validator->purifyHtml($notes);


//Previewing HTML:
?>
<?php if (isset($_POST['title']) && isset($_POST['body']) && isset($_POST['category']) && isset($_POST['notes'])) { ?>

    <div class="container-fluid mt-4 mb-4" style="max-width: 1100px;" id="preview">
        <div class="card">
            <div class="card-header">
                <small class="text-muted">Written By: <?php $author = \classes\models\user\User::getName($_SESSION['uid']); echo $author['first_name'] ?>, </small>
                <small class="text-muted">Written On: Today! </small>
                <span class="badge bg-primary float-end"><?= $category ?></span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class=""><?= $title ?></h2>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <p><?= $body?><p>

                            <?php
                            if (!empty($notes)) {
                                echo '<hr>';
                                echo '<p>' . $notes . '<p>';
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>