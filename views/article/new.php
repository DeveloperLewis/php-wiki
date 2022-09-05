<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
            <div class="row m-4">
                <div class="col-md-12">

                    <div id="newarticle-panel">
                        <form action="/article/new" method="POST">
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
                                if(isset($_SESSION['title_previous'])) { echo $_SESSION['title_previous']; }
                                unset($_SESSION['title_previous']);
                                ?>">
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <label for="shared" class="form-label">Shared: </label>
                                    <select class="form-select" id="shared" name="shared">
                                        <option>No</option>
                                        <option>Yes</option>
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
                                                echo '<option value="' . $v['category_id'] . '">' . $v['category_name'] . '</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="category" class="form-label">Selected id:</label>
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
                                    <li class="nav-item dropdown">
                                        <p class="nav-link dropdown-toggle rounded-0 active selectable" data-bs-toggle="dropdown" id="headings-button">H1</p>
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
                                        <p class="nav-link rounded-0" aria-current="page" href="#">Active</p>
                                    </li>
                                    <li class="nav-item">
                                        <p class="nav-link rounded-0" href="#">Link</p>
                                    </li>
                                </ul>
                                <textarea class="form-control border-top-0 rounded-0" id="body" name="body" style="resize: none; height: 600px; outline: none; box-shadow: none;"><?php
                                    if(isset($_SESSION['body_previous'])) { echo $_SESSION['body_previous']; }
                                    unset($_SESSION['body_previous']);
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
                                    if(isset($_SESSION['notes_previous'])) { echo $_SESSION['notes_previous']; }
                                    unset($_SESSION['notes_previous']);
                                    ?></textarea>
                            </div>

                            <div>
                                <button class="btn btn-danger float-start" type="button" id="cancel-button">Cancel</button>
                                <button class="btn btn-primary float-end" type="submit">Create</button>
                                <button class="btn btn-primary float-end mx-2" type="button" id="preview-button">Preview</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="preview-area">

                </div>
            </div>

            <script>
                let cancelButton = document.getElementById('cancel-button');
                let categorySelection = document.getElementById('categorySelection');

                document.getElementById('category').value = categorySelection.value

                //Confirm user wants to cancel creating article.
                cancelButton.addEventListener('click', function() {
                    let c = confirm('Are you sure you want to discard this article?');

                    if (c) {
                        console.log('User clicked ok')
                        window.location.href = "/admin/articles"
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

    <script type="text/javascript" src="../public/js/textEditor.js"></script>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>