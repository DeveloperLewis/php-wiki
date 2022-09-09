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
    <div class="m-4">
            <div class="row">
                <div class="col-12">

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
                                <div class="col-md-2">
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

                                <div class="col-md-2">
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

                                <div class="col-md-2">
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
                                <!--
                                    Main Text Editor
                                -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="bold-button"><strong>B</strong></p>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="italic-button"><em>i</em></p>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="underline-button"><u>U</u></p>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <p class="nav-link dropdown-toggle rounded-0 selectable" data-bs-toggle="dropdown" id="headings-button">Aa</p>
                                        <ul class="dropdown-menu">
                                            <li><p class="dropdown-item selectable" id="h1-button">H1</p></li>
                                            <li><p class="dropdown-item selectable" id="h2-button">H2</p></li>
                                            <li><p class="dropdown-item selectable" id="h3-button">H3</p></li>
                                            <li><p class="dropdown-item selectable" id="h4-button">H4</p></li>
                                            <li><p class="dropdown-item selectable" id="h5-button">H5</p></li>
                                            <li><p class="dropdown-item selectable" id="h6-button">H6</p></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="br-button">Br</p>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="hr-button">Hr</p>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="code-button"><i class="fa-solid fa-code"></i></p>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="link-button"><i class="fa-solid fa-link"></i></p>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0 selectable" id="media-button" data-bs-toggle="modal" data-bs-target="#images-modal"><i class="fa-solid fa-image"></i></p>
                                    </li>
                                </ul>

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
                                <button class="btn btn-danger float-start" type="button" id="cancel-button">Cancel</button>
                                <button class="btn btn-primary float-end" type="submit">Save</button>
                                <button class="btn btn-primary float-end mx-2" type="button" id="preview-button">Preview</button>
                            </div>

                            <input type="hidden" name="article_id" value="<?php if (isset($article['article_id'])) { echo $article['article_id']; }?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="preview-area">

        </div>
    </div>

        <!-- Images Selection Modal -->
        <div class="modal modal-lg fade" id="images-modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select an Uploaded Image</h5>
                    </div>
                    <div class="modal-body">
                        <?php
                        if (!$images_array = \classes\models\media\Image::getAll()) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo "No images found, try uploading some!";
                            echo '</div>';

                        }
                        ?>

                        <div class="images">
                            <div class="row">

                                <?php if (is_array($images_array)) { ?>
                                    <?php foreach ($images_array as $image) { ?>


                                        <div class="col-xl-3 mt-3">
                                            <div class="card" id="<?= $image['image_id'] ?>">
                                                <img class="card-img-top" src="../../<?= $image['location'] ?>" height="160">
                                                <div class="card-body">
                                                    <small class="float-start text-muted"><strong><?php
                                                            $functions = new \classes\Functions();
                                                            echo round($functions->convertBytes($image['storage_size'], "kb")). 'kb';
                                                            ?></strong>

                                                        <br><?= $image['upload_date']?>
                                                    </small>

                                                    <div class="float-end">
                                                        <button type="submit" class="btn btn-primary" onclick="insertImageTag('../../<?= $image['location'] ?>')" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

<script>
    let cancelButton = document.getElementById('cancel-button');
    let categorySelection = document.getElementById('categorySelection');

    document.getElementById('category').value = categorySelection.value

    cancelButton.addEventListener('click', function() {
        let c = confirm('Are you sure you want to cancel editing this article?');

        if (c) {
            console.log('User clicked ok')
            window.location.href = "/admin/articles?amount=0"
        } else {
            console.log('user clicked cancel')
        }
    }, false);

    categorySelection.addEventListener('change', function() {
        document.getElementById('category').value = categorySelection.value
    })

    //Preview scripts using ajax to request sanitized preview data.
    function showPreview(title, category, body, notes) {
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('preview-area').innerHTML = this.responseText;
            }
        };
        let params = "title=" + title + '&category=' + category + '&body=' + body + '&notes=' + notes;
        xml.open("POST", "/article/preview", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send(params);
    }

    //Getting elements to input into ajax request
    let previewButton = document.getElementById('preview-button');
    let notes = document.getElementById('notes');
    let body = document.getElementById('body');
    let title = document.getElementById('title');
    let category = document.getElementById("categorySelection");
    let value = category.value;
    let categoryText = category.options[category.selectedIndex].text;


    //Run the ajax request on clicking the preview button
    previewButton.addEventListener('click', function() {
        showPreview(title.value, categoryText, body.value, notes.value);
        window.location.href = "#preview-area";
    });
</script>

<script type="text/javascript" src="../public/js/textEditor.js?1"></script>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>