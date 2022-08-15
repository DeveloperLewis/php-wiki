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

            //Display this if no articles exist
            if (!$articles_array = \classes\models\article\Article::getAll($_SESSION['uid'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo "Fetch for categories failed or none exist, try creating a new category!";
                echo '</div>';
            }

            //Display all articles in the table
            else {
                foreach ($articles_array as $k => $v) {
                    $author_name = \classes\models\user\User::getName($v['original_author']);



                    echo '<tr onclick="sendToArticle('. $v['article_id'] . ')" style="cursor: pointer">';
                    echo '<td>' . $v['title'] . '</td>';
                    echo '<td>' . $author_name['first_name'] . '</td>';
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
    <script>
        function sendToArticle(id) {
            location.href = '/article?id=' + id;
        }
    </script>
</div>