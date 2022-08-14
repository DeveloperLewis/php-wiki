<div id="categories-panel">

        <div class="m-4">
                <div class="row">
                    <div class="col-3">

                    </div>
                    <div class="col-6">
                        <div class="card">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">Categories</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                                if (!$categories_array = \classes\models\article\Category::getAll()) {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo "Fetch for categories failed or none exist, try creating a new category!";
                                    echo '</div>';
                                }

                                else {
                                    foreach ($categories_array as $k => $v) {
                                        echo '<tr class="text-center">';
                                        echo '<td class="text-center">' . $v['category_name'] . '</td>';
                                        echo '</tr>';
                                    }
                                }

                                if (isset($_SESSION['success'])) {
                                    echo '<div class="alert alert-success" role="alert">';
                                    echo $_SESSION['success'];
                                    echo '</div>';
                                    unset($_SESSION['success']);
                                }

                            ?>
                            </tbody>
                        </table>
                        </div>

                        <div class="mt-4">
                            <div class="row">
                                <div class="col-8">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <div class="col-4">
                                    <div class="float-end">
                                        <a class="btn btn-primary" href="/category/new">Create New</a>
                                        <button class="btn btn-danger" form="deleteform">Delete</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">

                    </div>
                </div>
        </div>

    <form id="deleteform" method="POST" action="/category/delete"></form>
</div>