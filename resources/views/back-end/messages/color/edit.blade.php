
<!-- Modal -->
<div class="modal fade" id="modelEditColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Color</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="formUpdateColor" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="color_id" id="color_id">
                <label for="">colorName</label>
                <input type="text" name="name" class="name_update edit_name form-control" id="">
                <p></p>
            </div>

            <div class="form-group">
                <label for="">color_Code</label>
                <input type="color" name="color" class="color_update form-control" id="">
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <select name="status" class="status status_edit  form-control" id="">
                    <option value="1">Active</option>
                    <option value="0">Block</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button onclick="updateColor('.formUpdateColor')" type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
