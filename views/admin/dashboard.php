<?php
/* @var $articles */
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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body" onclick="sendToArticles()" style="cursor: pointer;">
                                                <h5 class="card-title">View Articles<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                            <?php
                                            if ($count_arr_articles = \classes\models\article\Article::getTotalCount($_SESSION['uid'])) {
                                                $articles_count = $count_arr_articles['COUNT(original_author)'];
                                            } else {
                                                $articles_count = 0;
                                            }
                                            ?>
                                            <div class="card-footer">Total Categories Created - <strong><?= $articles_count ?></strong></div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                                            <div class="card-body" onclick="sendToCategories()" style="cursor: pointer;">
                                                <h5 class="card-title">View Categories<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
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
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body" onclick="sendToCreateArticle()" style="cursor: pointer;">
                                                <h5 class="card-title">New Article<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                                            <div class="card-body" onclick="sendToCreateCategory()" style="cursor: pointer;">
                                                <h5 class="card-title">New Category<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                <div class="col-6">
                                    <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                                        <div class="card-body" onclick="sendToImages()" style="cursor: pointer;">
                                            <h5 class="card-title">View Images<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                        </div>
                                        <div class="card-footer">Total Images Uploaded - <strong></strong></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card text-bg-warning text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-body" onclick="sendToUsers()" style="cursor: pointer;">
                                            <h5 class="card-title">View Users<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                        </div>
                                        <div class="card-footer">Total Users Registered - <strong></strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                                        <div class="card-body" onclick="sendToUploadImages()" style="cursor: pointer;">
                                            <h5 class="card-title">Upload New Image<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card text-bg-warning text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-body" onclick="sendToAddNewUser()" style="cursor: pointer;">
                                            <h5 class="card-title">Register New User<span class="float-end"><i class="fa-solid fa-share"></i></span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h2>Recent Article</h2>
                                <hr>
                                    <?php
                                    if (isset($articles)) {
                                        foreach ($articles as $k => $v) {
                                            ?>
                                            <div class="card" style="height: 100%">
                                                <div class="card-header">
                                                    Recent Article
                                                </div>

                                                <img class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $v['title']?></h5>
                                                    <hr>
                                                    <p class="card-text"><?php
                                                        if (strlen($v['body']) > 200) {
                                                            $v['body'] = substr($v['body'], 0, 200) . '...';
                                                            echo $v['body'];
                                                        }
                                                        ?> <a href="/article?id=<?= $v['article_id']; ?>">Read more.</a></p>
                                                </div>
                                                <div class="card-footer">
                                                    <?php
                                                    $category_arr = \classes\models\article\Category::getById($v['category_ids']);
                                                    if (!empty($category_arr)) {
                                                        $category = $category_arr['category_name'];
                                                    } else {
                                                        $category = "None found";
                                                    }
                                                    ?>
                                                    <small class="text-muted">Last updated: <?= substr($v['last_edited_date'], 0, 10) ?></small><span class="badge bg-primary float-end"><?= $category ?></span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                            </div>

                            <div class="col-md-6">
                                <h2>Settings</h2>
                                <hr>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item selectable" onclick="changeTab('general-tab')">
                                        <p class="nav-link user-select-none active" id="general-tab">General</p>
                                    </li>
                                    <li class="nav-item selectable" onclick="changeTab('account-tab')">
                                        <p class="nav-link user-select-none" id="account-tab">Account</p>
                                    </li>
                                    <li class="nav-item selectable" onclick="changeTab('display-tab')">
                                        <p class="nav-link user-select-none" id="display-tab">Display</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>

<script>
    function sendToCategories() {
        location.href = '/admin/categories'
    }

    function sendToArticles() {
        location.href = '/admin/articles'
    }

    function sendToCreateCategory() {
        location.href = '/category/new'
    }

    function sendToCreateArticle() {
        location.href = '/article/new'
    }

    function changeTab(newTab) {
        let currentTab = document.getElementsByClassName('active');
        currentTab[1].classList.remove('active');

        let changeTo = document.getElementById(newTab);
        changeTo.classList.add('active');

    }
</script>
</body>
</html>