@extends('back-end.components.master')
@section('contents')
     @if (session('success'))
        <div class="alert text-light" id="error-alert" style="background: blue">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
            var alert = document.getElementById('error-alert');
            if(alert) alert.style.display = 'none';
            }, 3000);
        </script>
    @endif
    {{-- Dashboard setting --}}
    <div class="row page-title-header">
        <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
            <ul class="quick-links">
                <li><a href="#">ICE Market data</a></li>
                <li><a href="#">Own analysis</a></li>
                <li><a href="#">Historic market data</a></li>
            </ul>
            <ul class="quick-links ml-auto">
                <li><a href="#">Settings</a></li>
                <li><a href="#">Analytics</a></li>
                <li><a href="#">Watchlist</a></li>
            </ul>
            </div>
        </div>
        </div>
    </div>


    {{-- visit --}}
    <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-6">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">32,451</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Visits</h5>
                            <p class="mb-0 text-muted">+14.00(+0.50%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">15,236</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Impressions</h5>
                            <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">7,688</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Conversation</h5>
                            <p class="mb-0 text-muted">+57.62(+0.76%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">1,553</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Downloads</h5>
                            <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    {{-- table user --}}

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
