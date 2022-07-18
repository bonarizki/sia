<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SIA | @yield('title')</title>

    @include('master.include.header')

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">S.A</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/icon-user.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->Department->department_name }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" onclick="ChangePass()">
                                <i class="bi bi-key"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Menu</li>

            <li class="nav-item" >
                <a class="nav-link collapsed" href="{{ url('/') }}" id="dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#management-master" data-bs-toggle="collapse" href="#" id="master">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Master Management</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="management-master" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('management-user') }}" id="management-user">
                            <i class="bi bi-circle"></i><span>Management User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('department') }}" id="management-department">
                            <i class="bi bi-circle"></i><span>Management Department</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('archive') }}" id="management-archive">
                    <i class="bi bi-grid"></i>
                    <span>Management Arsip</span>
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <!-- Modal -->
    <div class="modal fade" id="modalChangePass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reset-password">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <label for="old_pass" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="old_password" name="old_password">
                                    <div class="invalid-feedback" id="old_password_alert"></div>

                                </div>
                                <div class="col-12">
                                    <label for="pass_1" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                    <div class="invalid-feedback" id="new_password_alert"></div>
                                </div>
                                <div class="col-12">
                                    <label for="pass_2" class="form-label">Re-New Password</label>
                                    <input type="password" class="form-control" id="re-new_password" name="re-new_password">
                                    <div class="invalid-feedback" id="re-new_password_alert"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveNewPass()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

   @include('master.include.footer')

   @yield('script')

   <script>
        const ChangePass = () => {
            $('#modalChangePass').modal('show');
        }

        const saveNewPass = () => {
            let data = $('#reset-password').serialize()
            $.ajax({
                type : "POST",
                url : "{{ url('changePass') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $('#modalChangePass').modal('hide');
                },
                error : (res) => {
                    errorHandle(res)
                },
                
            })
        }
   </script>

</body>

</html>