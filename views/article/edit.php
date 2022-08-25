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

<div class="container">
    <div class="card m-4">
        <div class="text-center">
            <h3> <?php
                $name_arr = classes\models\user\User::getName($_SESSION['uid']);
                echo ucfirst($name_arr['first_name']);
                ?>'s Dashboard</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-2 fixed">
                    <div class="card">
                        <a class="m-1 btn btn-primary" href="/admin/dashboard" id="dashboard-button">Dashboard</a>
                        <a class="m-1 btn btn-primary" href="/admin/articles" id="articles-button">Articles</a>
                        <a class="m-1 btn btn-primary" href="/admin/categories" id="categories-button">Categories</a>
                    </div>
                </div>

                <div class="col-10">

                    <div id="editarticle-panel">
                        <form action="/article/edit" method="POST">
                            <div class="mb-2">
                                <?php
                                //Display title errors here if there are any
                                if (isset($_SESSION['title_errors'])) {
                                    foreach ($_SESSION['title_errors'] as $k => $v) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $v;
                                        echo '</div>';
                                    }
                                    unset($_SESSION['title_errors']);
                                }

                                ?>

                                <label for="title" class="form-label">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php
                                if(isset($_SESSION['title_previous'])) { echo $_SESSION['title_previous']; unset($_SESSION['title_previous']); }
                                else {
                                    if (isset($article['title'])) {
                                        echo $article['title'];
                                    }
                                }
                                ?>">
                            </div>

                            <div class="row mb-2">
                                <div class="col-2">
                                    <label for="shared" class="form-label">Shared: </label>
                                    <select class="form-select" id="shared" name="shared">
                                        <?php
                                        if (isset($article['shared'])) {
                                            if ($article['shared'] == 1) {
                                                echo '<option selected>Yes</option>';
                                                echo '<option>No</option>';
                                            } else {
                                                echo '<option>Yes</option>';
                                                echo '<option selected>No</option>';
                                            }
                                        }
                                        ?>">
                                    </select>
                                </div>

                                <div class="col-2">
                                    <label for="categorySelection" class="form-label">Category: </label>
                                    <select class="form-select" id="categorySelection">
                                        <?php
                                        $result = \classes\models\article\Category::getAll();

                                        if (!$result) {

                                        } else {
                                            foreach ($result as $k => $v) {
                                                if ($v['category_id'] == $article['category_ids']) {
                                                    echo '<option value="' . $v['category_id'] . '" selected>' . $v['category_name'] . '</option>';
                                                }

                                                echo '<option value="' . $v['category_id'] . '">' . $v['category_name'] . '</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-2">
                                    <label for="category" class="form-label">Selected: </label>
                                    <input class="form-control" type="text" value="" name="category" id="category" readonly>
                                </div>
                            </div>

                            <div class="mb-2">

                                <?php

                                //Display body errors here if there are any
                                if (isset($_SESSION['body_errors'])) {
                                    foreach ($_SESSION['body_errors'] as $k => $v) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $v;
                                        echo '</div>';
                                    }
                                    unset($_SESSION['body_errors']);
                                }

                                ?>

                                <label for="body" class="form-label">Body: </label>
                                <textarea class="form-control" id="body" name="body" style="resize: none; height: 600px;"><?php
                                    if(isset($_SESSION['body_previous'])) { echo $_SESSION['body_previous']; unset($_SESSION['body_previous']); }
                                    else {
                                        if (isset($article['body'])) {
                                            echo $article['body'];
                                        }
                                    }
                                    ?></textarea>
                            </div>

                            <div class="mb-2">

                                <?php

                                //Display notes errors here if there are any
                                if (isset($_SESSION['notes_errors'])) {
                                    foreach ($_SESSION['notes_errors'] as $k => $v) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $v;
                                        echo '</div>';
                                    }
                                    unset($_SESSION['notes_errors']);
                                }

                                ?>

                                <label for="notes" class="form-label">Notes: </label>
                                <textarea class="form-control" id="notes" name="notes" style="resize: none; height: 200px;"><?php
                                    if(isset($_SESSION['notes_previous'])) { echo $_SESSION['notes_previous']; unset($_SESSION['notes_previous']); }
                                    else {
                                        if (isset($article['notes'])) {
                                            echo $article['notes'];
                                        }
                                    }
                                    ?></textarea>
                            </div>

                            <div>
                                <button class="btn btn-primary" type="submit">Edit article</button>
                                <button class="btn btn-danger" type="button" id="cancel-button">Cancel</button>
                            </div>

                            <input type="hidden" name="article_id" value="<?php if (isset($article['article_id'])) { echo $article['article_id']; }?>">
                        </form>

                        <script>
                            let cancelButton = document.getElementById('cancel-button');
                            let categorySelection = document.getElementById('categorySelection');

                            document.getElementById('category').value = categorySelection.value

                            cancelButton.addEventListener('click', function() {
                                let c = confirm('Are you sure you want to cancel editing this article?');

                                if (c) {
                                    console.log('User clicked ok')
                                    window.location.href = "/admin/dashboard"
                                } else {
                                    console.log('user clicked cancel')
                                }
                            }, false);

                            categorySelection.addEventListener('change', function() {
                                document.getElementById('category').value = categorySelection.value
                            })
                        </script>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>