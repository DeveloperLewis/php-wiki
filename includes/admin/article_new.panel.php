<div id="newarticle-panel">
    <form action="/article/new" method="POST">
        <div class="mb-2">

            <?php

            if (isset($_SESSION['title_errors'])) {
                foreach ($_SESSION['title_errors'] as $k => $v) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $v;
                    echo '</div>';
                }
                unset($_SESSION['title_errors']);
            }

            ?>

            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php
                if(isset($_SESSION['title_previous'])) { echo $_SESSION['title_previous']; }
                unset($_SESSION['title_previous']);
            ?>">
        </div>

        <div class="row mb-2">
            <div class="col-2">
                <label for="shared" class="form-label">Shared: </label>
                <select class="form-select" id="shared" name="shared">
                    <option>No</option>
                    <option>Yes</option>
                </select>
            </div>

        </div>

        <div class="mb-2">

            <?php

            if (isset($_SESSION['body_errors'])) {
                foreach ($_SESSION['body_errors'] as $k => $v) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $v;
                    echo '</div>';
                }
                unset($_SESSION['body_errors']);
            }

            ?>

            <label for="body" class="form-label">Body: </label>
            <textarea class="form-control" id="body" name="body" style="resize: none; height: 600px;"><?php
                if(isset($_SESSION['body_previous'])) { echo $_SESSION['body_previous']; }
                unset($_SESSION['body_previous']);
                ?></textarea>
        </div>

        <div class="mb-2">

            <?php

            if (isset($_SESSION['notes_errors'])) {
                foreach ($_SESSION['notes_errors'] as $k => $v) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $v;
                    echo '</div>';
                }
                unset($_SESSION['notes_errors']);
            }

            ?>

            <label for="notes" class="form-label">Notes: </label>
            <textarea class="form-control" id="notes" name="notes" style="resize: none; height: 200px;"><?php
                if(isset($_SESSION['notes_previous'])) { echo $_SESSION['notes_previous']; }
                unset($_SESSION['notes_previous']);
                ?></textarea>
        </div>

        <div>
            <button class="btn btn-primary" type="submit">Create Article</button>
            <button class="btn btn-danger" type="button" id="cancel-button">Cancel</button>
        </div>
    </form>

    <script>
        let cancelButton = document.getElementById('cancel-button');

        cancelButton.addEventListener('click', function() {
            let c = confirm('Are you sure you want to cancel this article?');

            if (c) {
                console.log('User clicked ok')
                window.location.href = "/admin/dashboard"
            } else {
                console.log('user clicked cancel')
            }
        }, false);
    </script>
</div>