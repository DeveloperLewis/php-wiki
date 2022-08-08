<div class="card">
    <div class="row m-4">
        <div class="col-4">

        </div>
        <div class="col-4">

            <?php
                if (isset($_SESSION['errors'])) {
                    foreach ($_SESSION['errors'] as $k => $v) {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $v;
                        echo '</div>';
                    }
                    unset($_SESSION['errors']);
                }
            ?>

            <form action="/category/new" method="post">
                <label>Category Name: </label>
                <input type="text" class="form-control" name="name" value="<?php
                    if (isset($_SESSION['previous'])) {
                        echo $_SESSION['previous'];
                        unset($_SESSION['previous']);
                    }
                ?>">

                <button class="btn btn-primary mt-2" type="submit">Create</button>
            </form>
        </div>
        <div class="col-4">

        </div>
    </div>
</div>
