
<!-- Modal -->
<div class="modal fade" id="modelCreateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="formCreateUser">
            <div class="form-group">
                <label for="">username</label>
                <input type="text" name="name" class="name form-control" id="">
                <p></p>
            </div>
            <div class="form-group">
                <label for="">email</label>
                <input type="text" name="email" class="email form-control" id="">
                <p></p>
            </div>
            <div class="form-group">
                <label for="">password</label>
                <input type="password" name="password" class="password form-control" id="">
                <p></p>
            </div>
            <div class="form-group">
                <label for="">role</label>
                <select name="role" class="role form-control" id="">
                    <option value="1">Admin</option>
                    <option value="0">User</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button onclick="StoreUser('.formCreateUser')" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
