<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('public/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/loginstyle.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="body">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body">

                            <div class="text-center">
                                <div class="auth-logo">
                                    <a href="javascript:void(0)" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('public/images/Suzen-app-logo.png') }}" alt="" height="40px">
                                        </span>
                                    </a>
                                </div><br>
                                <h3 class="passrecov">Reset Password</h3>
                                <p class="text-muted opoos">Dear user from Maahad Tahfiz Al-Quran Darul Saadah Lilbanat. <br>Your old password has been resetted. Kindly input the new password.</p>
                            </div>
                            <form id="changeNewPassword" action="{{ route('password.post_expired') }}" method="post">
                                @if ( Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                                @if ( Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                                @endif
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                        <!-- <span class="text-danger error-text email_error"></span> -->
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge">
                                    <label for="password">Note : <span style="color:blue;">(password atleast 8 characters and contain both numbers & letters/special characters.):</span></label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <!-- <span class="text-danger error-text password_error"></span> -->
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm New Password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <!-- <span class="text-danger error-text password_confirmation_error"></span> -->
                                    </div>
                                </div><br>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-block signin" type="submit">Confirm</button>
                                </div><br>

                            </form>

                            <div class="text-center">
                                <h5 class="mt-3 text-muted passfooter">2020 - <script>
                                        document.write(new Date().getFullYear())
                                    </script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </h5>
                            </div>


                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->



    <!-- Vendor js -->
    <script src="{{ asset('public/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('public/js/app.min.js') }}"></script>
    <script>
        $(function() {
            // change password
            // $('#changeNewPassword').on('submit', function(e) {
            //     e.preventDefault();
            //     $.ajax({
            //         url: $(this).attr('action'),
            //         method: $(this).attr('method'),
            //         data: new FormData(this),
            //         processData: false,
            //         dataType: 'json',
            //         contentType: false,
            //         beforeSend: function() {
            //             $(document).find('span.error-text').text('');
            //         },
            //         success: function(data) {
            //             if (data.status == 0) {
            //                 $.each(data.error, function(prefix, val) {
            //                     $('span.' + prefix + '_error').text(val[0]);
            //                 });
            //             } else {
            //                 if (data.code == 200) {
            //                     $('#changeNewPassword')[0].reset();
            //                     toastr.success(data.message);
            //                 } else if (data.code == 422) {
            //                     if (data.data.error.old) {
            //                         toastr.error(data.data.error.old[0]);
            //                     }
            //                     if (data.data.error.password) {
            //                         toastr.error(data.data.error.password[0]);
            //                     }
            //                     if (data.data.error.confirmed) {
            //                         toastr.error(data.data.error.confirmed[0]);
            //                     }
            //                 } else {
            //                     toastr.error(data.message);
            //                 }

            //             }
            //         },
            //         error: function(err) {
            //             if (err.responseJSON.code == 422) {
            //                 toastr.error(err.responseJSON.data.error.oldpassword[0] ? err.responseJSON.data.error.oldpassword[0] : 'Something went wrong');
            //             }
            //         }
            //     });
            // });
        });
    </script>
</body>

</html>