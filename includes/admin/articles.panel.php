<div id="articles-panel">
    <div class="card">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col" style="display: inline-block; width: 52%;">Title</th>
                <th scope="col" style="display: inline-block; width: 10%">Author</th>
                <th scope="col" style="display: inline-block; width: 10%">Categories</th>
                <th scope="col" style="display: inline-block; width: 20%">Date</th>
            </tr>
            </thead>
            <tbody style="overflow-y: auto; height:550px; display: block;">

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
                    echo '<form action="/category/delete" method="post">';
                    echo '<input type="hidden" value="' . '' .'" name="delete">';
                    echo '<td><button class="btn btn-danger" type="submit" style="float:right;">X</button></td>';
                    echo '</form>';

                    echo '<form action="/category/edit" method="post">';
                    echo '<input type="hidden" value="' . '' .'" name="messageid">';
                    echo '<td><button class="btn btn-success" type="submit" style="float:right;">Edit</button></td>';
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
                <div class="float-end">
                    <a class="btn btn-primary" href="/article/new">Create New</a>
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