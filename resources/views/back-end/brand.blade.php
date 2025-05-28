@extends('back-end.components.master')
@section('contents')
     <div class="row">
        {{-- Modal start --}}
        {{-- @include('back-end.messages.user.create') --}}
        @include('back-end.messages.brand.create')
        @include('back-end.messages.brand.edit')
        {{-- Modal end --}}
        <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Category</h3>
                <p data-bs-toggle="modal" data-bs-target="#modelCreateBrand" class="card-description btn btn-primary">New Brand</p>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="brand_list">
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
        const storeBrand = (form) => {
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('brand.store')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelCreateBrand').modal('hide');
                        $(form).trigger('reset');
                        $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        Message(response.message);
                        listBrand();
                    }else{
                        let errors = response.errors;
                        $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.name);
                    }
                }
            });
        }

        // Select all Brand
        const listBrand = () =>{
            $.ajax({
                type: "POST",
                url: "{{route('brand.list')}}",
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        let brands = response.brands;
                        let tr = '';
                        $.each(brands, function (key, value) {
                            tr +=`
                                <tr>
                                    <td>${value.id}</td>
                                    <td>${value.name}</td>
                                    <td>${value.category.name}</td>
                                    <td>${(value.status == 1) ? '<span class="bg-success text-light p-2 rounded-3">Active</span>' : '<span class="bg-danger text-light p-2 rounded-3">Block</span>' }</td>
                                    <td>
                                        <a href="#" onclick="editBrand(${value.id},'${value.name}')" data-bs-toggle="modal" data-bs-target="#modelEditBrand" class="btn btn-warning rounded-0 btn-sm">Edit</a>
                                        <a href="javascript:void()" onclick="deleteBrand(${value.id})" class="btn btn-danger rounded-0 btn-sm">Delete</a>
                                </tr>
                            `;
                        });
                        $('.brand_list').html(tr);
                    }
                }
            });
        }
        listBrand();

        const deleteBrand = (id) =>{
            if(confirm('Are you sure you want to delete this brand?')) {
               $.ajax({
                type: "POST",
                url: "{{route('brand.destroy')}}",
                data: {
                    'id':id
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        Message(response.message);
                        listBrand();
                    }else{
                        Message(response.message, 'error');
                    }
                }
               });
            }
        }

        const editBrand = (id, name) =>{
            $('#brand_id').val(id);
            $('.edit_name').val(name);
            // $('.brand_category').val(category);
        }

        const updateBrand = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('brand.update')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelEditBrand').modal('hide');
                        $(form).trigger('reset');
                        $('.edit_name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        Message(response.message);
                        listBrand();
                    }else{
                        let errors = response.errors;
                        $('.edit_name').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.name);
                    }
                }
            });
        }
    </script>
@endsection
