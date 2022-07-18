 <!-- Vendor JS Files -->
 <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
 <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="assets/vendor/chart.js/chart.min.js"></script>
 <script src="assets/vendor/echarts/echarts.min.js"></script>
 <script src="assets/vendor/quill/quill.min.js"></script>
 <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
 <script src="assets/vendor/tinymce/tinymce.min.js"></script>
 <script src="assets/vendor/php-email-form/validate.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <!-- Template Main JS File -->
 <script src="assets/js/main.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

<script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
<script src="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<script>
    const errorHandle = (response) => {
        if(response.responseJSON.errors==null){
            sweetError(response.responseJSON.message)
        }else{
            let fail = response.responseJSON.errors;
            let key = Object.keys(fail)
            loopingError(fail,key)
        }
    }

    sweetError = (message) => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
        })
    }

    sweetSuccess = (status,message) => {
        Swal.fire(
            'Good job!',
            message,
            status
        );
    }

    loopingError = (fail,key) => {
        $('.is-invalid').removeClass('is-invalid')
        for (let index = 0; index < key.length; index++) {
            if (fail.hasOwnProperty(`${key[index]}`)) {
                $(`#${key[index]}`).addClass('is-invalid');
                $(`#${key[index]}_alert`).text(fail[`${key[index]}`][0]);
                sweetError(fail[`${key[index]}`][0]);
            }
        }
    }
</script>
