<?php
/* @var $functions */
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
                    <div id="dashboard-panel">

                                <div class="row">
                                    <div class="col-4">
                                        <div class="card text-bg-primary mb-3" style="">
                                            <div class="card-body" onclick="sendToArticles()" style="cursor: pointer;">
                                                <h5 class="card-title">Manage Articles<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                            <?php
                                            if ($count_arr_articles = \classes\models\article\Article::getTotalCount($_SESSION['uid'])) {
                                                $articles_count = $count_arr_articles['COUNT(original_author)'];
                                            } else {
                                                $articles_count = 0;
                                            }
                                            ?>
                                            <div class="card-footer">Total Articles Created - <strong><?= $articles_count ?></strong></div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="card text-bg-danger mb-3" style="">
                                            <div class="card-body" onclick="sendToCategories()" style="cursor: pointer;">
                                                <h5 class="card-title">Manage Categories<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                            <?php
                                            if ($count_arr_categories = \classes\models\article\Category::getTotalCount()) {
                                                $categories_count = $count_arr_categories['COUNT(category_id)'];
                                            } else {
                                                $categories_count = 0;
                                            }
                                            ?>
                                            <div class="card-footer">Total Categories Created - <strong><?= $categories_count ?></strong></div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="card text-bg-success mb-3" style="">
                                            <div class="card-body" onclick="sendToImages()" style="cursor: pointer;">
                                                <h5 class="card-title">Manage Images<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                            <div class="card-footer">Total Images Uploaded - <strong><?= \classes\models\media\Image::getTotalCount() ?></strong></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="card text-bg-primary mb-3" style="">
                                            <div class="card-body" onclick="sendToCreateArticle()" style="cursor: pointer;">
                                                <h5 class="card-title">New Article<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="card text-bg-danger mb-3" style="">
                                            <div class="card-body" onclick="sendToCreateCategory()" style="cursor: pointer;">
                                                <h5 class="card-title">New Category<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="card text-bg-success mb-3" style="">
                                            <div class="card-body" onclick="sendToUploadImages()" style="cursor: pointer;">
                                                <h5 class="card-title">Upload New Image<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h2>Site Stats</h2>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-4 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Site Visits</h5>
                                            </div>
                                            <div class="card-footer"><?= \classes\models\site\Visitor::totalVisitors() ?> Visits</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Article Views</h5>
                                            </div>
                                            <div class="card-footer"><?= \classes\models\article\Article::totalArticleViewsForAll() ?> Views</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Storage Used</h5>
                                            </div>
                                            <div class="card-footer"><?= $functions->totalStorageUsage()?> MB</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Total Users</h5>
                                            </div>
                                            <div class="card-footer"><?= \classes\models\user\User::getTotalUsers() ?> Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h2>Settings</h2>
                                <hr>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item selectable" onclick="changeTab('general-tab', 'general-settings')">
                                        <p class="nav-link user-select-none active" id="general-tab">General</p>
                                    </li>
                                    <li class="nav-item selectable" onclick="changeTab('account-tab', 'account-settings')">
                                        <p class="nav-link user-select-none" id="account-tab">Account</p>
                                    </li>
                                    <li class="nav-item selectable" onclick="changeTab('display-tab', 'display-settings')">
                                        <p class="nav-link user-select-none" id="display-tab">Display</p>
                                    </li>
                                </ul>

                                <div id="account-settings" class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <?php
                                                if (isset($_SESSION['password_changed'])) {
                                                    echo '<div class="alert alert-success" role="alert">';
                                                    echo $_SESSION['password_changed'];
                                                    echo '</div>';

                                                    unset($_SESSION['password_changed']);
                                                }
                                            ?>

                                            <p><?= \classes\models\user\User::getEmail($_SESSION['uid']) ?></p>
                                            <a class="btn btn-primary" href="/user/change-password">Change Password</a>
                                        </div>
                                    </div>
                                </div>

                                <div id="general-settings" class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>General Settings</p>
                                        </div>
                                    </div>
                                </div>

                                <div id="display-settings" class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Display Settings</p>
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>

<script>

    let account = document.getElementById("account-settings");
    let general = document.getElementById("general-settings");
    let display = document.getElementById("display-settings");

    account.style.display = 'none';
    display.style.display = 'none';

    function sendToCategories() {
        location.href = '/admin/categories?amount=0';
    }

    function sendToArticles() {
        location.href = '/admin/articles?amount=0';
    }

    function sendToCreateCategory() {
        location.href = '/category/new';
    }

    function sendToCreateArticle() {
        location.href = '/article/new';
    }

    function sendToUsers() {
        location.href = '/admin/users';
    }

    function sendToImages() {
        location.href = '/admin/images?amount=0';
    }

    function sendToUploadImages() {
        location.href = '/image/new';
    }

    function changeTab(newTab, newPanel) {
        let currentTab = document.getElementsByClassName('active');
        currentTab[1].classList.remove('active');

        let changeTo = document.getElementById(newTab);
        changeTo.classList.add('active');

        hideAll()

        let changeToPanel = document.getElementById(newPanel);
        changeToPanel.style.removeProperty('display');
    }

    function hideAll() {
        account.style.display = 'none';
        display.style.display = 'none';
        general.style.display = 'none';
    }

</script>
</body>
</html>