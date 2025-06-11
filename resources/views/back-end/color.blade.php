@extends('back-end.components.master')
@section('contents')
     <div class="row">
        {{-- Modal start --}}
        {{-- @include('back-end.messages.user.create') --}}
        @include('back-end.messages.color.create')
        @include('back-end.messages.color.edit')
        {{-- Modal end --}}
        <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Color</h3>
                <p data-bs-toggle="modal" data-bs-target="#modelCreateColor" class="card-description btn btn-primary">New Color</p>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Color ID</th>
                    <th>Name</th>
                    <th>Color_Code</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="color_list">
                {{-- Dynamic data will be inserted here --}}

                </tbody>
            </table>

             <div class="d-flex justify-content-between align-items-center">
                <div class="show-pagination mt-3">

                </div>
                <button onclick="refreshColor()" class="btn btn-danger btn-sm rounded-0">
                    Refresh
                </button>
             </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>


        const listColor = (page = 1, search='') =>{
            $.ajax({
                type: "POST",
                url: "{{route('color.list')}}",
                data: {
                    'page': page,
                    'search': search
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        let colors = response.colors;
                        let tr = '';
                        $.each(colors, function (key, value) {
                            tr +=`
                                <tr>
                                    <td>${value.id}</td>
                                    <td>${value.name}</td>
                                    <td>
                                        <div style="background-color:${value.color_code}; height:30px; width: 30px; border-radius:50%; border:2px solid black" ></div>
                                    </td>
                                    <td>${(value.status == 1) ? '<span class="bg-success text-light p-2 rounded-3">Active</span>' : '<span class="bg-danger text-light p-2 rounded-3">Block</span>' }</td>
                                    <td>
                                        <a href="#" onclick="editColor(${value.id},'${value.name}', '${value.color_code}', ${value.status})" data-bs-toggle="modal" data-bs-target="#modelEditColor" class="btn btn-warning rounded-0 btn-sm">Edit</a>
                                        <a href="javascript:void()" onclick="deleteColor(${value.id})" class="btn btn-danger rounded-0 btn-sm">Delete</a>
                                </tr>
                            `;
                        });
                        $('.color_list').html(tr);

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
                                        pagi += ` <li onclick="paginaColor(${i})" class="page-item ${( i == currentpage ) ? 'active' : ''}"><a class="page-link" href="javascript:void()">${i}</a></li>`;
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
                    }
                }
            });
        }
        listColor();

        const refreshColor = () => {
            listColor();
        }

        const paginaColor = (page=1) =>{
            listColor(page);
        }

        const nextPage = (page) => {
            listColor(page+1);
        }

        const previousPage = (page) => {
            listColor(page-1);
        }

         $(document).on("click",".btn-search", function () {
            let searchValue = $('#search').val();
            listColor(1, searchValue);
            $('#searchModal').modal('hide');
            $('.formSearch').trigger('reset');
        });

        const storeColor = (form) => {
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('color.store')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelCreateColor').modal('hide');
                        $(form).trigger('reset');
                        $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        Message(response.message);
                        listColor();
                    }else{
                        let errors = response.errors;
                        $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.name);
                    }
                }
            });
        }

        const deleteColor = (id) =>{
            if(confirm('Are you sure you want to delete this color?')) {
               $.ajax({
                type: "POST",
                url: "{{route('color.destroy')}}",
                data: {
                    'id':id
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        Message(response.message);
                        listColor();
                    }else{
                        Message(response.message, 'error');
                    }
                }
               });
            }
        }

        const editColor = (id, name, color_code, status) =>{
            $('#color_id').val(id);
            $('.edit_name').val(name);
            $('.color_update').val(color_code);

            $('.status').val(status);
            // if(status == 1){
            //     $('.status_edit').val(1);
            // }else{
            //     $('.status_edit').val(0);
            // }
        }

        const updateColor = (form) =>{
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('color.update')}}",
                data: payloads,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == 200){
                        $('#modelEditColor').modal('hide');
                        $(form).trigger('reset');
                        $('.edit_name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                        Message(response.message);
                        listColor();
                    }else{
                        let errors = response.errors;
                        $('.edit_name').addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.name);
                    }
                }
            });
        }
    </script>
@endsection
