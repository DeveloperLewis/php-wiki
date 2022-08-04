<div id="newarticle-panel">
    <form action="/article/new" method="POST">
        <div class="mb-2">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="row mb-2">
            <div class="col-2">
                <label for="shared" class="form-label">Shared: </label>
                <select class="form-select" id="shared" name="shared">
                    <option>No</option>
                    <option>Yes</option>
                </select>
            </div>

            <div class="col-2">
                <label for="template" class="form-label">Template: </label>
                <select class="form-select" id="template" name="template">
                    <option>Character</option>
                    <option>Place</option>
                    <option>Item</option>
                </select>
            </div>
        </div>

        <div class="mb-2">
            <label for="body" class="form-label">Body: </label>
            <textarea class="form-control" id="body" name="body" style="resize: none; height: 600px;"></textarea>
        </div>

        <div class="mb-2">
            <label for="body" class="form-label">Notes: </label>
            <textarea class="form-control" id="notes" name="notes" style="resize: none; height: 200px;"></textarea>
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