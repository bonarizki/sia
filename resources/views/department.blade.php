@extends('master.master')

@section('title','Management Department')

@section('content')
    <div class="pagetitle">
        <h1>Management Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Master Management</li>
                <li class="breadcrumb-item active">Management Department</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Master Department</h5>
                        <button class="btn btn-primary mb-2"  onclick="showModal('add')">
                            <i class="bi bi-plus me-1"></i> Add Department
                        </button>

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered table-sm" id="table">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">#</th>
                                    <th rowspan="2" class="align-middle">Department Name</th>
                                    <th rowspan="2" class="align-middle">Department Code</th>
                                    <th colspan="2"><center>Action<center></th>
                                </tr>
                                <tr>
                                    <th><center>Edit<center></th>
                                    <th><center>Delete<center></th>
                                </tr>
                            </thead>
                            
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form id="form">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="department_name" class="form-label">Department Name</label>
                                        <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Department Name">
                                        <div class="invalid-feedback" id="department_name_alert"></div>
                                    </div>
                                    <div class="col-12">
                                        <label for="department_code" class="form-label">Department Code</label>
                                        <input type="text" class="form-control" id="department_code" name="department_code" placeholder="Department Code">
                                        <div class="invalid-feedback" id="department_code_alert"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div><!-- End Large Modal-->
    </section>
@endsection

@section('script')
    <script>
        $('#management-department').addClass('active');
        $('#management-master').addClass('collapsed');
        $('#management-master').addClass('show');
        $('#master').removeClass('collapsed');
       
        $(document).ready(function () {
            $('#table').DataTable({
                destroy: true,
                serverSide : true,
                ajax: {
                    url: "{{ url('department') }}",
                    type: "get",
                },
                columns : [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "department_name",
                    name: "department_name"
                },
                {
                    data: "department_code",
                    name: "department_code"
                },
                {
                    data:"id",
                    name:"id",
                    render : (data) => {
                        return `<center>
                                    <span class='bi bi-pencil-square' onclick="showModal('edit','${data}')"></span>
                                </center>`;
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data) => {
                        return `<center>
                                    <span class='bx bxs-user-x' onclick="alertDelete('${data}')"></span>
                                </center>`;
                    }
                }
                ]
            })
        });

        const showModal = (type,id = null) => {
            $('.is-invalid').removeClass('is-invalid')
            $('#form')[0].reset()
            if (type == 'add') {
                $('.modal-title').text('Form Add Department');
                $('#modal').modal('show');
                $('#submit').attr('onclick','add()')
            }else{
                edit(id)
            }
        }

        const add = () => {
            let data = $('#form').serialize();
            $.ajax({
                type : "POST",
                url : "{{ url('department') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                },
                error : (res) => {
                    errorHandle(res)
                },
            })
        }

        const edit = (id) => {
            $.ajax({
                type : "get",
                url : `{{ url('department') }}/${id}/edit`,
                success : (res) => {
                    $('#department_name').val(res.data.department_name);
                    $('#department_code').val(res.data.department_code);
                },
                complete : () => {
                    $('#modal').modal('show');
                    $('#submit').attr('onclick',`update('${id}')`);
                }
            })
        }

        const update = (id) => {
            let data = $('#form').serialize();
            $.ajax({
                type : "PATCH",
                url : "{{ url('department') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                    $('#form')[0].reset();
                },
                error : (res) => {
                    errorHandle(res)
                },
            })
        }

        const alertDelete = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    deleteProcess(id)
                }
            })
        }

        const deleteProcess = (id) => {
            $.ajax({
                type : "delete",
                url : "{{ url('department') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                },
                error : (res) => {
                    errorHandle(res)
                },
                complete : () => {
                    $(`#table`).DataTable().ajax.reload();
                    $('#form')[0].reset()
                }
            })
        }
    </script>
@endsection