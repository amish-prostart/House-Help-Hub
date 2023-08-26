<div class="modal fade" id="categoryCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @include('flash::message')
            <form id="categoryCreateForm" name="categoryForm" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-body">
                <span id="categoryValidationErrorsBox"></span>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="justify-content-center">
                        <label class="form-label">Image:<span class="required"></span></label>
                    </div>
                    @php
                        $image = asset('assets/images/avatar.png');
                    @endphp
                    <div class="d-block">
                        <div class="image-picker">
                            <div class="image previewImage category-edit-image" id="categoryPreviewImage"
                                 style="background-image: url('{{ $image }}')">
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
                <button type="submit" class="btn btn-primary ms-auto" id="addCategoryBtn">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
