@extends('master.master')

@section('title','Management User')

@section('content')
    <div class="pagetitle">
        <h1>Management User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Master Management</li>
                <li class="breadcrumb-item active">Management User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Master User</h5>
                        <button class="btn btn-primary mb-2"  onclick="showModal('add')">
                            <i class="bi bi-plus me-1"></i> Add User
                        </button>

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered table-sm" id="table">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">#</th>
                                    <th rowspan="2" class="align-middle">NIK</th>
                                    <th rowspan="2" class="align-middle">User Name</th>
                                    <th rowspan="2" class="align-middle">User Email</th>
                                    <th rowspan="2" class="align-middle">Phone Number</th>
                                    <th rowspan="2" class="align-middle">Department</th>
                                    <th rowspan="2" class="align-middle">Role</th>
                                    <th colspan="3" class="align-middle"><center>Action<center></th>
                                </tr>
                                <tr>
                                    <th><center>Edit<center></th>
                                    <th><center>Delete<center></th>
                                    <th><center>Reset Pass<center></th>
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
                            <div class="card-body">
                                <!-- Multi Columns Form -->
                                <form class="row g-3" id="form">
                                    <div class="col-md-12">
                                        <label for="employee_id" class="form-label">Employee ID</label>
                                        <input type="text" class="form-control" id="employee_id" name="employee_id">
                                        <div class="invalid-feedback" id="employee_id_alert"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                        <div class="invalid-feedback" id="name_alert"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                        <div class="invalid-feedback" id="email_alert"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                                        <div class="invalid-feedback" id="phone_number_alert"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="department+_id" class="form-label">Department</label>
                                        <select id="department_id" name="department_id" class="form-select">
                                            <option selected value="">Choose...</option>
                                        </select>
                                        <div class="invalid-feedback" id="department_id_alert"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="role" class="form-label">Role</label>
                                        <select id="role" name="role" class="form-select">
                                            <option  value="">Choose...</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        <div class="invalid-feedback" id="role_alert"></div>
                                    </div>
                                   
                                </form><!-- End Multi Columns Form -->
                            </div>
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
        $('#management-user').addClass('active');
        $('#management-master').addClass('collapsed');
        $('#management-master').addClass('show');
        $('#master').removeClass('collapsed');
        

       
        $(document).ready(function () {
            $('#table').DataTable({
                destroy: true,
                ajax: {
                    url: "{{ url('management-user') }}",
                    type: "get",
                },
                columns : [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "employee_id",
                    name: "employee_id"
                },
                {
                    data: "name",
                    name: "name"
                },
                {
                    data: "email",
                    name: "email"
                },
                {
                    data: "phone_number",
                    name: "phone_number"
                },
                {
                    data: "department.department_name",
                    name: "department.department_name"
                },
                {
                    data: "role",
                    name: "role"
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
                },
                {
                    data:"id",
                    name:"id",
                    render : (data) => {
                        return `<center>
                                    <span class='bx bx-reset' onclick="reset('${data}')"></span>
                                </center>`;
                    }
                }]
            })

            getDepartment();
        });

        const parameters_id = []

        const showModal = (type,id = null) => {
            $('.is-invalid').removeClass('is-invalid')
            $('#form')[0].reset()
            if (type == 'add') {
                $('.modal-title').text('Form Add User');
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
                url : "{{ url('management-user') }}",
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
                url : `{{ url('management-user') }}/${id}/edit`,
                success : (res) => {
                    $('#employee_id').val(res.data.employee_id);
                    $('#name').val(res.data.name);
                    $('#email').val(res.data.email);
                    $('#phone_number').val(res.data.phone_number);
                    $('#department_id').val(res.data.department_id);
                    $('#role').val(res.data.role);
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
                url : "{{ url('management-user') }}/" + id,
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
                url : "{{ url('management-user') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                    $('#form')[0].reset()
                },
                error : (res) => {
                    errorHandle(res)
                },
            })
        }

        const getDepartment = () => {
            $.ajax({
                type:"get",
                url : "{{ url('department') }}",
                success : (res) => {
                    let data = res.data
                    let option = ""
                    for (let index = 0; index < data.length; index++) {
                        option += `<option value="${data[index].id}"> ${data[index].department_code} - ${data[index].department_name}</option>`
                    }
                    $('#department_id').append(option)
                }
            })
        }

        const reset = (id) => {
            $.ajax({
                type : "get",
                url : `{{ url('reset-pass') }}/${id}`,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                },
            })
        }
    </script>
@endsection