</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->

<!-- Vendor js -->
<script src="{{ asset('public/js/vendor.min.js') }}"></script>
<!-- App js-->
<script src="{{ asset('public/js/app.min.js') }}"></script>

<script src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>

<script>
    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>