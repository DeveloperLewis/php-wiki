<div id="categories-panel">
    <div class="card">
        <div class="m-4">
            <div class="card">
                <h2 class="text-center">All Categories</h2>
            </div>

            <div class="mt-4">
                <div class="row">
                    <div class="col-4">
                        <p class="btn btn-info text-white" style="width: 100%;">People</p>
                        <p class="btn btn-info text-white" style="width: 100%;">Castles</p>
                    </div>

                    <div class="col-4">
                        <p class="btn btn-info text-white" style="width: 100%;">Castles</p>
                        <p class="btn btn-info text-white" style="width: 100%;">Castles</p>

                    </div>

                    <div class="col-4">
                        <p class="btn btn-info text-white" style="width: 100%;">Castles</p>
                        <p class="btn btn-info text-white" style="width: 100%;">Castles</p>
                    </div>
                </div>
            </div>
        </div>
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

    <form id="deleteform" method="POST" action="/category/delete"></form>
</div>