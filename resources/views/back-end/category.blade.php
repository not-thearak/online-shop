@extends('back-end.components.master')
@section('contents')
     <div class="row">
        {{-- Modal start --}}
        {{-- @include('back-end.messages.user.create') --}}
        @include('back-end.messages.category.create')
        @include('back-end.messages.category.edit')
        {{-- Modal end --}}
        <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Category</h3>
                <p data-bs-toggle="modal" data-bs-target="#modelCreateCategory" class="card-description btn btn-primary">New Categories</p>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Image</th>
                    <th>CategoryName</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="categories_list">
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
        // Select all Category
        const listCategory = () =>{
            $.ajax({
                type: "POST",
                url: "{{route('category.list')}}",
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        let categories = response.categories;
                        let tr = '';
                        $.each(categories, function (key, value) {
                            tr +=`
                                <tr>
                                    <td>${value.id}</td>
                                    <td>
                                        <img src="{{asset('uploads/category/${value.image}')}}" >
                                    </td>
                                    <td>${value.name}</td>
                                    <td>${(value.status == 1) ? '<span class="bg-success text-light p-2 rounded-3">Active</span>' : '<span class="bg-danger text-light  p-2 rounded-3">Block</span>'}</td>
                                    <td>
                                        <a href="#" onclick="editCategory(${value.id})" data-bs-toggle="modal" data-bs-target="#modelEditCategory" class="btn btn-primary rounded-0 btn-sm">Edit</a>
                                        <a href="javascript:void()" onclick="destroyCategory(${value.id})" class="btn btn-danger rounded-0 btn-sm">Delete</a>
                                </tr>
                            `;
                        });
                        $('.categories_list').html(tr);
                    }
                }
            });
        }
        listCategory();
        const editCategory = (id) =>{
            $.ajax({
                type: "POST",
                url: "{{route('category.edit')}}",
                data: {
                    'id':id
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        $('.edit_name').val(response.category.name);
                        $('.category_id').val(response.category.id);
                        $('.form_edit_image').html(`
                            <input type="hidden" name="old_image" value="${response.category.image}">
                            <img style="width:300px; height:300px" src="{{asset('uploads/category/${response.category.image}')}}" >
                            <button onclick="cancelUploadImage('${response.category.image}')" type="button" class="btn btn-danger btn-sm rounded-0 btn-cancel-upload">Cancel</button>
                        `);
                        $('.edit_status').val(response.category.status);
                    //     if(response.category.image){
                    //         let img = `
                    //             <input type="hidden" name="imageCategory" value="${response.category.image}">
                    //             <img style="width:300px; height:300px" src="{{asset('uploads/category/${response.category.image}')}}" >
                    //             <button onclick="cancelUploadImage('${response.category.image}')" type="button" class="btn btn-danger btn-sm rounded-0 btn-cancel-upload">Cancel</button>
                    //         `;
                    //         $('.form-upload-image').html(img);
                    // }
                }
            }
            });
        }
        // Create button Upload Image
        const uploadImage = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('category.upload')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        let img = `
                            <input type="text" name="imageCategory" value="${response.image}">
                            <img style="width:300px; height:300px" src="{{asset('uploads/temp/${response.image}')}}" >
                            <button onclick="cancelUploadImage('${response.image}')" type="button" class="btn btn-danger btn-sm rounded-0 btn-cancel-upload">Cancel</button>
                        `;
                        $('.form-upload-image').html(img);
                        $('input').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        // $(form).trigger('reset');
                        Message(response.message);
                    }else{
                        let errors = response.errors;
                        if(errors.image){
                            $('.image').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.image);
                        }
                    }
                }
            });
        }
        const cancelUploadImage = (img) =>{
            if(confirm('Are you sure you want to cancel the upload?')) {
                $.ajax({
                    type: "POST",
                    url: "{{route('category.cancel')}}",
                    data: {
                        'image': img
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            $('.form-upload-image').html('');
                            Message(response.message);
                        }
                    }
                });
            }
        }
        const storeCategory = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('category.store')}}",
                data: payloads,
                dataType: "json",
                processData:false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelCreateCategory').modal('hide');
                        $('input').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        $('.form-upload-image').html('');
                        $(form).trigger('reset');
                        Message(response.message);
                        listCategory();
                    }else{
                        errors = response.errors;
                        if(errors.name){
                            $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.name);
                        }
                    }
                }
            });
        }
        const destroyCategory = (id) =>{
            if(confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    type: "POST",
                    url: "{{route('category.destroy')}}",
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            Message(response.message);
                            listCategory();
                        }else{
                            Message(response.message, 'error');
                        }
                    }
                });
            }
        }
        const updateCategory = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('category.update')}}",
                data: payloads,
                dataType: "json",
                processData:false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelEditCategory').modal('hide');
                        $('input').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        $('.form_edit_image').html('');
                        $(form).trigger('reset');
                        Message(response.message);
                        listCategory();
                    }else{
                        errors = response.errors;
                        if(errors.name){
                            $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.name);
                        }
                    }
                }
            });
        }
    </script>

@endsection

