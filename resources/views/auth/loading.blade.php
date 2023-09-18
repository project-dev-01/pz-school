<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" /> -->
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/common-asset/images/favicon.ico' }}">
    <!-- App css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <!-- icons -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>-->
    <link href="{{ asset('css/custom-minified/loginstyle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/login_loading.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="loading">
    <!-- Begin page -->

    <div class="container">
        <!-- Start Content-->
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center bground">
                    <p class="loadtext">{{ __('messages.welcome_onboard') }},</p>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <p class="loadsa">{{ $user_name }}</p>
                <input type="hidden" id="redirect_route" value="{{ $redirect_route }}" />
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="progress">
                </div>
            </div> <!-- end col -->
        </div>



    </div>

   <script>
        var redirectUrl = document.getElementById("redirect_route").value;
        /* 
         * (class)Progress<nowValue, minValue, maxValue>
         */

        //helper function-> return <DOMelement>
        function elt(type, prop, ...childrens) {
            let elem = document.createElement(type);
            if (prop) Object.assign(elem, prop);
            for (let child of childrens) {
                if (typeof child == "string") elem.appendChild(document.createTextNode(child));
                else elem.appendChild(elem);
            }
            return elem;
        }

        //Progress class
        class Progress {
            constructor(now, min, max, options) {
                this.dom = elt("div", {
                    className: "progress-bar"
                });
                this.min = min;
                this.max = max;
                this.intervalCode = 0;
                this.now = now;
                this.syncState();
                if (options.parent) {
                    document.querySelector(options.parent).appendChild(this.dom);
                } else document.body.appendChild(this.dom)
            }

            syncState() {
                this.dom.style.width = this.now + "%";
            }

            startTo(step, time) {
                if (this.intervalCode !== 0) return;
                this.intervalCode = setInterval(() => {
                    if (this.now + step > this.max) {
                        this.now = this.max;
                        this.syncState();
                        clearInterval(this.interval);
                        this.intervalCode = 0;
                        return;
                    }
                    this.now += step;
                    this.syncState()
                }, time)
            }
            end() {
                this.now = this.max;
                clearInterval(this.intervalCode);
                this.intervalCode = 0;
                this.syncState();
            }
        }


        let pb = new Progress(15, 0, 100, {
            parent: ".progress"
        });

        //arg1 -> step length
        //arg2 -> time(ms)
        pb.startTo(5, 100);

        //end to progress after 5s
        setTimeout(() => {
            pb.end()
            window.location.href = redirectUrl;
        }, 1000)
    </script>


    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>


</body>

</html>