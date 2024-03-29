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
            <h2>Articles</h2>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <div id="articles-panel">

                        <?php
                        if (isset($_SESSION['delete_error'])) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $_SESSION['delete_error'];
                            echo '</div>';

                            unset($_SESSION['delete_error']);
                        }

                        //display that article success messages
                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo $_SESSION['success'];
                            echo '</div>';

                            unset($_SESSION['success']);
                        }

                        if (!$articles_array = \classes\models\article\Article::pagination($_SESSION['uid'], 10, $params['amount'])) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo "Fetch for articles failed or none exist, try creating a new article!";
                            echo '</div>';
                        }
                        ?>



                        <div class="card">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="lato-strong">Title</th>
                                    <th scope="col" class="lato-strong">Author</th>
                                    <th scope="col" class="lato-strong">Category</th>
                                    <th scope="col" class="lato-strong">Date</th>
                                    <th scope="col" class="lato-strong">Edit</th>
                                    <th scope="col" class="lato-strong">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                //Display all articles in the table
                                if ($articles_array) {
                                    foreach ($articles_array as $k => $v) {
                                        $author_name = \classes\models\user\User::getName($v['original_author']);
                                        $category_name = \classes\models\article\Category::getName($v['category_ids']);


                                        echo '<tr onclick="sendToArticle('. $v['article_id'] . ')" style="cursor: pointer;">';
                                        echo '<td>' . $v['title'] . '</td>';
                                        echo '<td>' . $author_name['first_name'] . '</td>';
                                        if (is_array($category_name)) {
                                            echo '<td>' . $category_name['category_name'] . '</td>';
                                        } else {
                                            echo '<td>No categories Found</td>';
                                        }
                                        echo '<td>' . $v['creation_date']. '</td>';

                                        //Edit button with form
                                        echo '<form action="/article/edit" method="get">';
                                        echo '<input type="hidden" value="' . $v['article_id'] .'" name="id">';
                                        echo '<td><button class="btn btn-success" type="submit"><i class="fa-solid fa-eraser"></i></button></td>';
                                        echo '</form>';
                                        //Delete button with form
                                        echo '<form action="/article/delete" method="post">';
                                        echo '<input type="hidden" value="' . $v['article_id'] .'" name="id">';
                                        echo '<td><button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button></td>';
                                        echo '</form>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="row">

                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="btn btn-danger" href="/admin/dashboard"><i class="fa-solid fa-arrow-left"></i> Go Back</a>

                                        <?php
                                            //pagination button controller
                                            $ta = \classes\models\article\Article::getTotalCount($_SESSION['uid']);
                                            $total_amount = $ta['COUNT(original_author)'];
                                            $limit_amount = 10;
                                            $max_pagination_items = 3;
                                        ?>

                                        <nav>
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link <?php if (($params['amount'] - 10) < 0) { echo "disabled"; }?>" href="/admin/articles?amount=<?= $params['amount'] - 10 ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <?php
                                                    $current_pagination_items = 0;
                                                    for ($i = $params['amount']; $i < $total_amount; $i += $limit_amount) {
                                                        $current_pagination_items++;
                                                        if ($current_pagination_items < 4) {
                                                            echo ' <li class="page-item"><a class="page-link" href="/admin/articles?amount=' . $i .'">' . $i / 10 .'</a></li>';
                                                        }
                                                    }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link <?php if (($params['amount'] + 10) > $total_amount) { echo "disabled"; }?>" href="/admin/articles?amount=<?= $params['amount'] + 10 ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>

                                        <a class="btn btn-primary" href="/article/new">Create New</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function sendToArticle(id) {
                                location.href = '/article?id=' + id;
                            }
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
