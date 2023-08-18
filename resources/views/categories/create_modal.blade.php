<div class="modal fade" id="categoryCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoryCreateForm" name="categoryForm" class="form-horizontal">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <label class="switch">
                        <input type="checkbox" name="status" value="1">
                        <span class="slider round"></span>
                    </label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="addCategoryBtn">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
