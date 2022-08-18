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

                        //Success message for when the new category was added.
                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo $_SESSION['success'];
                            echo '</div>';

                            unset($_SESSION['success']);
                        }

                        //If the getAll() method failed, then display this
                        if (!$categories_array = \classes\models\article\Category::getAll()) {
                            echo '<div class="alert alert-danger m-2" role="alert">';
                            echo "Fetch for categories failed or none exist, try creating a new category!";
                            echo '</div>';
                        }
                        ?>

                        <div class="card">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Categories</th>
                            </tr>
                            </thead>
                            <tbody style="overflow-y: auto; height:550px; display: block;">
                            <?php
                                //Show all categories in a table
                                    foreach ($categories_array as $k => $v) {
                                        echo '<tr>';

                                        echo '<td style="width: 100%;">' . $v['category_name'] . '</td>';

                                        echo '<form action="/category/delete" method="post">';
                                        echo '<input type="hidden" value="' . $v['category_id'] .'" name="id">';
                                        echo '<td><button class="btn btn-danger" type="submit" style="float:right;">X</button></td>';
                                        echo '</form>';

                                        echo '<form action="/category/edit" method="get">';
                                        echo '<input type="hidden" value="' . $v['category_id'] .'" name="id">';
                                        echo '<td><button class="btn btn-success" type="submit" style="float:right;">Edit</button></td>';
                                        echo '</form>';

                                        echo '</tr>';
                                    }
                            ?>
                            </tbody>
                        </table>
                        </div>

                        <div class="mt-4">
                            <div class="row">
                                <div class="col-12">
                                        <a class="btn btn-primary float-end" href="/category/new">Create New</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>

    <form id="deleteform" method="POST" action="/category/delete"></form>
</div>