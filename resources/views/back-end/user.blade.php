@extends('back-end.components.master')
@section('contents')
    <div class="row">
        {{-- Modal start --}}
        @include('back-end.messages.user.create')
        {{-- Modal end --}}
        <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Users</h4>
                <p data-bs-toggle="modal" data-bs-target="#modelCreateUser" class="card-description btn btn-primary">New Users</p>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="users_list">
                {{-- Dynamic data will be inserted here --}}

                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        // Select all User
        const ListUser = () =>{
            $.ajax({
                type: "POST",
                url: "{{route('user.list')}}",
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        let users = response.users;
                        let tr = '';
                        $.each(users, function (key, value) {
                            tr +=`
                                <tr>
                                    <td>${value.id}</td>
                                    <td>${value.name}</td>
                                    <td>${value.email}</td>
                                    <td>${(value.role == 1) ? 'Admin' : 'User'}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary rounded-0 btn-sm">View</a>
                                        <a href="javascript:void()" onclick="DeleteUser(${value.id})" class="btn btn-danger rounded-0 btn-sm">Delete</a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('.users_list').html(tr);
                    }
                }
            });
        }
        ListUser();

        // Store Data
        const StoreUser = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('user.store')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelCreateUser').modal('hide');
                        $('input').removeClass("is-invalid").siblings('p').removeClass('text-danger').text('');
                        $(form).trigger('reset');
                        ListUser();
                        Message(response.message);
                    }else{
                        let errors = response.errors;

                        if(errors.name){
                            $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.name);
                        }else{
                            $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }

                        if(errors.email){
                            $('.email').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.email);
                        }else{
                            $('.email').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }

                        if(errors.password){
                            $('.password').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.password);
                        }else{
                            $('.password').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }
                    }
                }
            });
        }

        // Delete User
        const DeleteUser = (id) =>{
            if(confirm("Do you want delete this user?")){
                $.ajax({
                    type: "POST",
                    url: "{{route('user.destroy')}}",
                    data: {
                        "id" : id
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            ListUser();
                            Message(response.message);
                        }
                        else{
                            Message(response.message);
                        }
                    }
                });
            }
        }

    </script>

@endsection
