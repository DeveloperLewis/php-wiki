<div id="articles-panel">
    <div class="card">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Contributors</th>
                <th scope="col">Categories</th>
                <th scope="col">Template</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            //TODO: Fill with real data, this is just a placeholder
            for ($i = 0; $i<10; $i++) {
                ?>
                <tr>
                    <td>Some article title</td>
                    <td>Otto</td>
                    <td>Max, Josh</td>
                    <td>Castles, Characters</td>
                    <td >Building</td>
                    <td>19/03/1974</td>
                </tr>
            <?php } ?>
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