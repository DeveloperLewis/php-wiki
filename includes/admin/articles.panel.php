<div id="articles-panel">
    <div class="card">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Categories</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>

            <?php

            if (!$articles_array = \classes\models\article\Article::getAll($_SESSION['uid'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo "Fetch for categories failed or none exist, try creating a new category!";
                echo '</div>';
            }

            else {
                foreach ($articles_array as $k => $v) {
                    echo '<tr>';
                    echo '<td>' . $v['title'] . '</td>';
                    //TODO: GET AUTHOR NAME BASED ON ID PROVIDED BY ARTICLES ARRAY
                    echo '<td>' . '</td>';
                    echo '<td>No categories found.</td>';
                    //TODO: Fix the original date and use that instead
                    echo '<td>' . $v['last_edited_date']. '</td>';
                    echo '</tr>';
                }
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
                    <a class="btn btn-primary" href="/article/new">Create New</a>
                    <a class="btn btn-danger" href="/article/edit">Edit</a>
                    <button class="btn btn-danger" form="deleteform">Delete</button>

                </div>
            </div>
        </div>
    </div>

    <form id="deleteform" method="POST" action="/article/delete"></form>
</div>