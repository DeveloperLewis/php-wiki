<div id="dashboard-panel">
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <?php
                        if ($count_arr_articles = \classes\models\article\Article::getTotalCount($_SESSION['uid'])) {
                            $articles_count = $count_arr_articles['COUNT(original_author)'];
                        } else {
                            $articles_count = 0;
                        }
                    ?>
                    <h5 class="card-title">Total Articles By You: <?= $articles_count ?></h5>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <?php
                        if ($count_arr_categories = \classes\models\article\Category::getTotalCount()) {
                            $categories_count = $count_arr_categories['COUNT(category_id)'];
                        } else {
                            $categories_count = 0;
                        }
                    ?>
                    <h5 class="card-title">Total Categories: <?= $categories_count ?></h5>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Some other stats: 10</h5>
                </div>
            </div>
        </div>
    </div>
</div>