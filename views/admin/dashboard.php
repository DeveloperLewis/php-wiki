<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
    <div class="card m-4">
        <div class="text-center">
            <h3>Welcome back, USERNAME</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-2 fixed">
                    <div class="card">
                        <button class="m-1 btn btn-primary" type="button" id="dashboard-button">Dashboard</button>
                        <button class="m-1 btn btn-primary" type="button" id="posts-button">Posts</button>
                    </div>
                </div>

                <div class="col-10">
                    <div class="card">
                        <!--
                            Dashboard
                        -->
                        <div id="dashboard-panel">
                            <p>Here is the dashboard panel!!</p>
                        </div>
                        <!--
                            Posts
                        -->
                        <div id="posts-panel">
                            <table class="table table-striped table-hover" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 30%;">Title</th>
                                    <th scope="col" style="width: 15%;">Author</th>
                                    <th scope="col" style="width: 10%;">Contributors</th>
                                    <th scope="col" style="width: 10%;">Categories</th>
                                    <th scope="col" style="width: 10%;">Template</th>
                                    <th scope="col" style="width: 15%;">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td >Some article title</td>
                                    <td>Otto</td>
                                    <td>Max, Josh</td>
                                    <td>Castles, Characters</td>
                                    <td>Building</td>
                                    <td>19/03/1974</td>
                                </tr>
                                <tr>
                                    <td >Some article title 2</td>
                                    <td>Otto</td>
                                    <td>Max, Josh</td>
                                    <td>Castles, Characters</td>
                                    <td>Building</td>
                                    <td>19/03/1975</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>

<script>
    $(document).ready(function() {
        //Controller for the panels
        function hideAllPanels() {
            $("#dashboard-panel").hide();
            $("#posts-panel").hide();
        }

        //Panel init
        hideAllPanels();
        let current_panel = $("#dashboard-panel");
        current_panel.show();

        //Switch panels
        $('#posts-button').on("click", function() {
            current_panel.hide();
            current_panel = $('#posts-panel');
            current_panel.show();
        })

        $('#dashboard-button').on("click", function() {
            current_panel.hide();
            current_panel = $('#dashboard-panel');
            current_panel.show();
        })




    });
</script>
</body>
</html>