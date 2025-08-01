
<!-- Modal -->
<div class="modal fade" id="modelCreateBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Brand</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="formCreateBrand" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">BrandName</label>
                <input type="text" name="name" class="name form-control" id="">
                <p></p>
            </div>

            <div class="form-group">
                <label for="">Category</label>
                <select name="category" class="category form-control" id="">
                   @foreach ( $categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                   @endforeach
                </select>
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
        <button onclick="storeBrand('.formCreateBrand')" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
