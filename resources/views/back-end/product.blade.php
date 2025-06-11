{{-- Extends From Master Layout --}}
@extends('back-end.components.master')

{{-- Section In Master Layout --}}
@section('contents')

     <div class="row">
        {{-- Include Modal for Create and Edit Product --}}
        @include('back-end.messages.product.create')
        @include('back-end.messages.product.edit')
        {{-- End Include Modal for Create and Edit Product --}}

        {{-- Show Products --}}
        <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Products</h3>
                <p onclick="handleClickButtonNewProduct()" data-bs-toggle="modal" data-bs-target="#modelCreateProduct" class="card-description btn btn-primary">New Product</p>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="product_list">

                </tbody>
            </table>

             <div class="d-flex justify-content-between align-items-center">

                {{-- Show Pagination --}}
                <div class="show-pagination mt-3">

                </div>
                {{-- End Show Pagination --}}

                {{-- Button Refresh --}}
                <button onclick="refreshProduct()" class="btn btn-danger btn-sm rounded-0">
                    Refresh
                </button>
                {{-- End Button Refresh --}}

             </div>
            </div>
        </div>
        </div>
        {{-- End Show Products --}}
    </div>



@endsection
@section('scripts')
    <script>

        // Can Select all Colors
        $(document).ready(function () {

            $('#color_add').select2({
                placeholder: 'Select options',
                allowClear: true,
                tags: true,
            });

            $('#color_edit').select2({
                placeholder: 'Select options',
                allowClear: true,
                tags: true,
            });
        });
        // End Select all Colors

        // Show Products
        const listProduct = (page = 1, search='') =>{
            $.ajax({
                type: "POST",
                url: "{{ route('product.list')}}",
                data: {
                    'page' : page,
                    'search' : search
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        let products = response.data;
                        let tr = '';
                        $.each(products, function (key, value) {
                            tr += `
                                 <tr>
                                    <td>${value.id}</td>
                                    <td>
                                       `;
                                       if(value.images.length > 0){
                                        tr += `<img style="width:50px; height:50px" src="{{ asset('uploads/product/${value.images[0].image}') }}" alt="">`;
                                       }
                                    tr += `
                                    </td>
                                    <td>${value.name}</td>
                                    <td>${value.category.name}</td>
                                    <td>${value.brand.name}</td>
                                    <td>$${value.price}</td>
                                    <td>${value.qty}</td>
                                    <td>
                                        <span class="text-light p-2 rounded-3 badege ${value.qty >= 1 ? 'badge-success' : 'badge-danger'}">${value.qty >= 1 ? 'In Stock' : 'Out Stock'}</span>
                                    </td>
                                    <td>
                                        ${(value.status == 1) ? '<span class="bg-success text-light p-2 rounded-3">Active</span>' : '<span class="bg-danger text-light p-2 rounded-3">Block</span>'}
                                    </td>
                                    <td>
                                        <button onclick="editProduct(${value.id})" class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#modalUpdateProduct">Edit</button>
                                        <button onclick="destroyProduct(${value.id})" class="btn btn-danger btn-sm rounded-0">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('.product_list').html(tr);


                        // Show Pagination
                        let pagi = '';
                        let totalpages = response.page.totalpage;
                        let currentpage = response.page.currentpage;
                        pagi += `
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item ${(currentpage == 1) ? 'd-none' : 'd-block'}" onclick="previousPage(${currentpage})">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                    </li>`;
                                    for (let i = 1; i <= totalpages; i++){
                                        pagi += ` <li onclick="paginaProduct(${i})" class="page-item ${( i == currentpage ) ? 'active' : ''}"><a class="page-link" href="javascript:void()">${i}</a></li>`;
                                     }
                                    pagi +=`<li onclick="nextPage(${currentpage})" class="page-item  ${(currentpage == totalpages) ? 'd-none' : 'd-block'}">
                                    <a class="page-link" href="javascript:void()" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                </ul>
                            </nav>
                        `;
                        $('.show-pagination').html(pagi);
                        // End Show Pagination
                    }
                }
            });
        }
        listProduct();

        const refreshProduct = () => {
            listProduct();
        }

         const paginaProduct = (page=1) =>{
            listProduct(page);
        }

        const nextPage = (page) => {
            listProduct(page+1);
        }

        const previousPage = (page) => {
            listProduct(page-1);
        }

        $(document).on("click",".btn-search", function () {
            let searchValue = $('#search').val();
            listProduct(1, searchValue);
            $('#searchModal').modal('hide');
            $('.formSearch').trigger('reset');
        });

        // Store Products
        const storeProduct = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('product.store')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelCreateProduct').modal('hide');
                        $(form).trigger('reset');
                        $('#color_add').val(null).trigger('change');
                        $('.show-images').html('');
                        $('input').removeClass("is-invalid").siblings('p').removeClass('text-danger').text('');
                        Message(response.message);
                        listProduct();
                    }else{
                        Message(response.message,false);

                        let errors = response.errors;

                        if(errors.title){
                            $('.title_add').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.title);
                        }else{
                            $('.title_add').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }

                        if(errors.price){
                            $('.price_add').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.price);
                        }else{
                            $('.price_add').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }

                        if(errors.qty){
                            $('.qty_add').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.qty);
                        }else{
                            $('.qty_add').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }
                    }
                }
            });
        }

        // Select Table Categories Brands Colors
        const handleClickButtonNewProduct = () =>{
            $.ajax({
                type: "POST",
                url: "{{ route('product.data')}}",
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        // Category Options
                        let categories = response.data.categories;
                        let cate_options = '';
                        $.each(categories, function (key, value) {
                            cate_options += `
                                <option value="${value.id}">${value.name}</option>
                            `;
                        });

                        $('.category_add').html(cate_options);

                        // End Category Options

                        // Brand Options
                        let brands = response.data.brands;
                        let brand_options = '';
                        $.each(brands, function (key, value) {
                            brand_options += `
                                <option value="${value.id}">${value.name}</option>
                            `;
                        });
                        $('.brand_add').html(brand_options);
                        // End Brand Options

                        // Color Options
                        let colors = response.data.colors;
                        let color_options = '';
                        $.each(colors, function (key, value) {
                            color_options += `
                                <option value="${value.id}">${value.name}</option>
                            `;
                        });
                        $('.color_add').html(color_options);
                    }
                }
            });
        }
        // End Select Table Categories Brands Colors


        // Upload Product Image
        const productUpload = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('image.upload')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        Message(response.message);
                        let images = response.images;
                        let html = '';
                        $.each(images, function (key, value) {
                            html += `
                                <div class="col-lg-3 mb-3">
                                    <input type="hidden" name="image_uploads[]" value="${value}">
                                    <img style="width:200px; height:300px; margin-left:10px"  src="{{ asset('uploads/temp/${value}')}}" >
                                    <button onclick="cancelImageProduct(this,'${value}')" type="button" class="btn btn-danger btn-sm remove-image" >Remove</button>
                                </div>
                            `;
                        });

                        if(form === '.formUpdateProduct'){
                            $('.show-images-edit').append(html);
                            $('#image-edit').val('');
                        }else if(form === '.formCreateProduct'){
                            $('.show-images').append(html);
                            $('#image').val('');
                        }


                   }
                },
            });

        }
        // End Upload Product Image

        // Cancel Product Image
        const cancelImageProduct = (e,image) =>{
            if(confirm('Are you sure you want to cancel this image?')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('image.cancel')}}",
                    data: {
                        'image' : image
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            Message(response.message);
                            $(e).parent().remove();
                        }
                    }
                });
            }
        }
        // End Cancel Product Image

        // edit products
        const editProduct = (id) => {
            $('.show-images-edit').html('');
            $.ajax({
                type: "POST",
                url: "{{ route('product.edit')}}",
                data: {
                    'id' : id
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){

                        // select id from network
                        $('#product_id').val(response.data.product.id);
                        $('.title_edit').val(response.data.product.name);
                        $('.price_edit').val(response.data.product.price);
                        $('.qty_edit').val(response.data.product.qty);
                        $('.desc_edit').val(response.data.product.desc);

                        // respones categories
                        let categories = response.data.categories;
                        let cate_option = '';
                        $.each(categories, function (key, value) {
                            cate_option += `
                                <option value="${value.id}" ${(value.id == response.data.product.category_id) ? 'selected' : ''} >
                                    ${value.name}
                                </option>
                            `;
                        });

                        // inner to category edit
                        $('.category_edit').html(cate_option);

                        // response brands
                         let brands = response.data.brands;
                        let brand_option = '';
                        $.each(brands, function (key, value) {
                            brand_option += `
                                <option value="${value.id}" ${(value.id == response.data.product.brand_id) ? 'selected' : ''} >
                                    ${value.name}
                                </option>
                            `;
                        });

                        // inner to category edit
                        $('.brand_edit').html(brand_option);

                        // response colors
                        let colors = response.data.colors;
                        let cids = response.data.product.color; // 4,2,1 we have
                        let color_option = '';
                        $.each(colors, function (key, value) {
                            // convert colors to string to compare
                            if(cids.includes(String(value.id))){
                                color_option += `
                                    <option value="${value.id}" selected >${value.name}</option>
                                `;
                            }else{
                                color_option +=`
                                    <option value="${value.id}" >${value.name}</option>
                                `;
                            }
                        });

                        $(".color_edit").html(color_option);

                        // response images
                        let images = response.data.productImages;
                        let html = '';
                        $.each(images, function (key, value) {
                            html += `
                                <div class="col-lg-3 mb-3">
                                    <input type="hidden" name="old_image" value="${value.image}">
                                    <img style="width:200px; height:300px; margin-left:10px"  src="{{ asset('uploads/product/${value.image}')}}" >
                                    <button onclick="cancelImageProduct(this,'${value.image}')" type="button" class="btn btn-danger btn-sm remove-image" >Remove</button>
                                </div>
                            `;
                        });
                        $('.show-images-edit').append(html);
                    }
                }
            });
        }

        const updateProduct = (form) => {
            let payload = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('product.update')}}",
                data: payload,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('input').removeClass("is-invalid").siblings('p').removeClass('text-danger').text('');
                        $('#modalUpdateProduct').modal('hide');
                        // $(form).trigger('reset');
                        listProduct();
                    }else{
                        Message(response.message,false);

                        let errors = response.errors;

                        if(errors.title){
                            $('.title_edit').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.title);
                        }else{
                            $('.title_edit').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }

                        if(errors.price){
                            $('.price_edit').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.price);
                        }else{
                            $('.price_edit').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }

                        if(errors.qty){
                            $('.qty_edit').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.qty);
                        }else{
                            $('.qty_edit').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        }
                    }
                }
            });
        }

        const destroyProduct = (id) => {
            if(confirm('Are you sure you want to delete this Product?')){
                $.ajax({
                    type: "POST",
                    url: "{{route('product.destroy')}}",
                    data: {
                        'id' : id
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            Message(response.message);
                            listProduct();
                        }else{
                            Message(response.message,false);
                        }
                    }
                });
            }
        }



    </script>

@endsection
