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
            <h2>Categories</h2>
        </div>


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div id="categories-panel">
                        <div class="">
                            <div class="row">

                                <div class="col">



                                    <?php
                                    //Error message for deleting a category
                                    if (isset($_SESSION['delete_error'])) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $_SESSION['delete_error'];
                                        echo '</div>';

                                        unset($_SESSION['delete_error']);
                                    }

                                    //Error message for deleting a category that is in ue
                                    if (isset($_SESSION['in_use'])) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $_SESSION['in_use'];
                                        echo '</div>';

                                        unset($_SESSION['in_use']);
                                    }

                                    //Success message for when the new category was added.
                                    if (isset($_SESSION['success'])) {
                                        echo '<div class="alert alert-success" role="alert">';
                                        echo $_SESSION['success'];
                                        echo '</div>';

                                        unset($_SESSION['success']);
                                    }

                                    if (!$categories_array = \classes\models\article\Category::pagination(10, $params['amount'])) {
                                        echo '<div class="alert alert-danger m-2" role="alert">';
                                        echo "Fetch for categories failed or none exist, try creating a new category!";
                                        echo '</div>';
                                    }
                                    ?>

                                    <div class="card">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="lato-strong">Categories</th>
                                                <th scope="col" class="lato-strong">Edit</th>
                                                <th scope="col" class="lato-strong">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Show all categories in a table
                                            if (is_array($categories_array)) {
                                                foreach ($categories_array as $k => $v) {
                                                    echo '<tr>';

                                                    echo '<td style="width: 100%;">' . $v['category_name'] . '</td>';

                                                    echo '<form action="/category/edit" method="get">';
                                                    echo '<input type="hidden" value="' . $v['category_id'] .'" name="id">';
                                                    echo '<td><button class="btn btn-success" type="submit"><i class="fa-solid fa-eraser"></i></button></td>';
                                                    echo '</form>';

                                                    echo '<form action="/category/delete" method="post">';
                                                    echo '<input type="hidden" value="' . $v['category_id'] .'" name="id">';
                                                    echo '<td><button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button></td>';
                                                    echo '</form>';

                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a class="btn btn-danger" href="/admin/dashboard"><i class="fa-solid fa-arrow-left"></i> Go Back</a>

                                                    <?php
                                                    //pagination button controller
                                                    $ta = \classes\models\article\Category::getTotalCount();
                                                    $total_amount = $ta['COUNT(category_id)'];
                                                    $limit_amount = 10;
                                                    $max_pagination_items = 3;
                                                    ?>

                                                    <nav>
                                                        <ul class="pagination">
                                                            <li class="page-item">
                                                                <a class="page-link <?php if (($params['amount'] - 10) < 0) { echo "disabled"; }?>" href="/admin/categories?amount=<?= $params['amount'] - 10 ?>" aria-label="Previous">
                                                                    <span aria-hidden="true">&laquo;</span>
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $current_pagination_items = 0;
                                                            for ($i = $params['amount']; $i < $total_amount; $i += $limit_amount) {
                                                                $current_pagination_items++;
                                                                if ($current_pagination_items < 4) {
                                                                    echo ' <li class="page-item"><a class="page-link" href="/admin/categories?amount=' . $i .'">' . $i / 10 .'</a></li>';
                                                                }
                                                            }
                                                            ?>
                                                            <li class="page-item">
                                                                <a class="page-link <?php if (($params['amount'] + 10) > $total_amount) { echo "disabled"; }?>" href="/admin/categories?amount=<?= $params['amount'] + 10 ?>" aria-label="Next">
                                                                    <span aria-hidden="true">&raquo;</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>

                                                    <a class="btn btn-primary" href="/category/new">Create New</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <form id="deleteform" method="POST" action="/category/delete"></form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>

