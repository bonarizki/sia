@extends('master.master')

@section('title','Management Department')

@section('content')
    <div class="pagetitle">
        <h1>Management Archive</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Management Archive</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Master Archive</h5>
                        <button class="btn btn-primary mb-2"  onclick="showModal('add')">
                            <i class="bi bi-plus me-1"></i> Add Archive
                        </button>

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered table-sm" id="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">#</th>
                                    <th rowspan="2" class="align-middle">Archive Code</th>
                                    <th rowspan="2" class="align-middle">Archive Type</th>
                                    <th rowspan="2" class="align-middle">Archive Name</th>
                                    <th rowspan="2" class="align-middle">Archive Subject</th>
                                    <th rowspan="2" class="align-middle">Archive Department</th>
                                    <th rowspan="2" class="align-middle">Archive Position</th>
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
                            <form id="form" >
                                @csrf
                                <div class="card-body row g-3">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <select type="text" class="form-control" id="department_id"
                                                name="department_id" placeholder="Department Code">
                                                <option value="">Choose . .</option>
                                            </select>
                                            <label for="department_id">Department Code</label>
                                        </div>
                                        <div class="invalid-feedback" id="department_id_alert"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="archive_code"
                                                name="archive_code" placeholder="Archive Code">
                                            <label for="archive_code">Archive Code</label>
                                        </div>
                                        <div class="invalid-feedback" id="archive_code_alert"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <select type="text" class="form-control" id="archive_type"
                                                name="archive_type" placeholder="Archive Type">
                                                <option value="">Choose . .</option>
                                                <option value="in">IN</option>
                                                <option value="out">Out</option>
                                            </select>
                                            <label for="archive_type">Archive Code</label>
                                        </div>
                                        <div class="invalid-feedback" id="archive_type_alert"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="archive_name"
                                                name="archive_name" placeholder="Archive Subject">
                                            <label for="archive_name">Archive Name</label>
                                        </div>
                                        <div class="invalid-feedback" id="archive_name_alert"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="archive_subject"
                                                name="archive_subject" placeholder="Archive Subject">
                                            <label for="archive_subject">Archive Subject</label>
                                        </div>
                                        <div class="invalid-feedback" id="archive_subject_alert"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="archive_position"
                                                name="archive_position" placeholder="Archive Position">
                                            <label for="archive_position">Archive Position</label>
                                        </div>
                                        <div class="invalid-feedback" id="archive_position_alert"></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="archive_file">Archive File</label>
                                            <input class="form-control my-pond" placeholder="Archive File"
                                                id="archive_file" name="archive_file" style="height: 100px;">
                                        </div>
                                        <div class="invalid-feedback" id="archive_file_alert"></div>
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
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

        $('#management-archive').removeClass('collapsed');       

        $(document).ready(function () {
            getDepartment();

            $('#table').DataTable({
                destroy: true,
                searchHighlight: true,
                serverSide : true,
                mark : true,
                ajax: {
                    url: "{{ url('archive') }}",
                    type: "get",
                },
                columns : [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "archive_code",
                    name: "archive_code"
                },
                {
                    data: "archive_type",
                    name: "archive_type"
                },
                {
                    data: "archive_name",
                    name: "archive_name"
                },
                {
                    data: "archive_subject",
                    name: "archive_subject"
                },
                {
                    data: "departments.department_name",
                    name: "departments.department_name"
                },
                {
                    data: "archive_position",
                    name: "archive_position"
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

        const parameters_id = []

        const showModal = (type,id = null) => {
            $('.is-invalid').removeClass('is-invalid')
            $('#form')[0].reset()
            $('.my-pond').filepond();
            if (type == 'add') {
                $('.modal-title').text('Form Add Archive');
                $('#modal').modal('show');
                $('#submit').attr('onclick','add()')
            }else{
                $('.modal-title').text('Form Edit Archive');
                edit(id)
            }
        }

        const add = () => {
            let file = $(`.my-pond`).filepond('getFiles');
            let formData = new FormData($('#form').get(0));
            if (file.length != 0) {
                formData.append('file', file[0].file, file[0].file.name);
            }

            $.ajax({
                type: "POST",
                url: "{{ url('archive') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                },
                error: (res) => {
                    errorHandle(res)
                },
            })
        }

        const edit = (id) => {
            $.ajax({
                type : "get",
                url : `{{ url('archive') }}/${id}/edit`,
                success : (res) => {
                    $('#archive_code').val(res.data.archive_code);
                    $('#archive_name').val(res.data.archive_name);
                    $('#archive_subject').val(res.data.archive_subject);
                    $('#archive_type').val(res.data.archive_type);
                    $('#archive_position').val(res.data.archive_position);
                    $('#department_id').val(res.data.department_id);
                    showImage(res.data);
                },
                complete : () => {
                    $('#modal').modal('show');
                    $('#submit').attr('onclick',`update('${id}')`);
                }
            })
        }

        const showImage = (data) => {
            $('.my-pond').filepond();
            if (data.archive_file != null) {
                $('.my-pond').filepond('addFile', `{{asset('archive_file/${data.archive_file}')}}`)
                    .then(function (file) {

                    });
            }
        }

        const update = (id) => {
            let file = $(`.my-pond`).filepond('getFiles');
            let formData = new FormData($('#form').get(0));
            if (file.length != 0) {
                formData.append('file', file[0].file, file[0].file.name);
            }
            formData.append('id',id);
            $.ajax({
                type: "post",
                url: "{{ url('archive-update') }}",
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: (res) => {
                    sweetSuccess(res.status, res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                },
                error: (res) => {
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
                url : "{{ url('archive') }}/" + id,
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

        const getDepartment = () => {
            $.ajax({
                url : "{{ url('department') }}",
                type : "get",
                success : (res) => {
                    console.log(res)
                    let option = '';
                    let data = res.data
                    data.forEach((el,id) => {
                        option += `<option value="${el.id}">${el.department_name} - ${el.department_code}</option>`
                    });
                    $('#department_id').append(option);
                }
            })
        }
    </script>
@endsection