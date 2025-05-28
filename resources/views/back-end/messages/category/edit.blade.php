
<!-- Modal -->
<div class="modal fade" id="modelEditCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Upadte Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formEditCategory" class="formCreateCategory" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="category_id" class="category_id form-control" id="" >
                <label for="">CategoryName</label>
                <input type="text" name="name" class="name edit_name form-control" id="">
                <p></p>
            </div>
            <div class="form-group">
                <label for="">CategoryImage</label>
                <input type="file" name="image" class="image  form-control" id="">
                <p></p>
                <button onclick="uploadImage('#formEditCategory')" type="button" class="btn btn-success rounded-0 btn_upload">Upload</button>
            </div>
            <div class="form-upload-image form_edit_image">

            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="status" class="role edit_status form-control" id="">
                    <option value="1">Active</option>
                    <option value="0">Block</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button onclick="updateCategory('#formEditCategory')" type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
