<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoryEditForm" name="categoryForm" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="categoryValidationErrorsBox"></div>
                <input type="hidden" class="form-control" name="id"  id="editCategoryID">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" id="editCategoryName">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="editCategoryStatus">
                        <span class="slider round"></span>
                    </label>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="justify-content-center">
                        <label class="form-label">Image:<span class="required"></span></label>
                    </div>
                    <div class="d-block">
                        <div class="image-picker">
                            <div class="image previewImage category-edit-image" id="categoryPreviewImage">
                            </div>
                            <span class="picker-edit rounded-circle text-gray-500 fs-small">
                                    <label>
                                    <i class="fa-solid fa-pen" id="categoryImageIcon"></i>
                                        <input type="file" name="image" id="categoryImage" class="d-none image-upload" accept=".png, .jpg, .jpeg">
                                    </label>
                                </span>
                        </div>
                    </div>
                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto" id="editCategoryBtn">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
