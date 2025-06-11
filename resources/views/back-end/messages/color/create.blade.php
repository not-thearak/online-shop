
<!-- Modal -->
<div class="modal fade" id="modelCreateColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Color</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="formCreateColor" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">colorName</label>
                <input type="text" name="name" class="name form-control" id="">
                <p></p>
            </div>

            <div class="form-group">
                <label for="">color_Code</label>
                <input type="color" name="color" class="color form-control" id="">
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <select name="status" class="status form-control" id="">
                    <option value="1">Active</option>
                    <option value="0">Block</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button onclick="storeColor('.formCreateColor')" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
