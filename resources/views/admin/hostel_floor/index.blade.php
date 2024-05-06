@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.hostel_floor') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2212)">
                                <path d="M15.3399 17.0057C15.2446 16.9451 15.158 16.899 15.0772 16.8413C14.7712 16.6105 14.4681 16.374 14.1592 16.1433C14.134 16.1291 14.1061 16.1202 14.0773 16.1172C14.0485 16.1142 14.0194 16.1172 13.9918 16.126C13.8099 16.1923 13.6367 16.2817 13.452 16.3452C13.4169 16.3552 13.3861 16.3764 13.3642 16.4056C13.3424 16.4348 13.3306 16.4703 13.3307 16.5067C13.2759 16.9105 13.2182 17.3143 13.1604 17.7181C13.1316 17.92 13.0594 17.9834 12.8516 17.9834H11.1195C10.9059 17.9834 10.8309 17.9171 10.8107 17.695C10.7529 17.2826 10.6923 16.8701 10.6288 16.4605C10.6228 16.4373 10.612 16.4155 10.5971 16.3966C10.5821 16.3778 10.5635 16.3622 10.5422 16.3509C10.3488 16.2644 10.1525 16.1808 9.96486 16.1087C9.93861 16.1044 9.91175 16.1056 9.88595 16.112C9.86014 16.1185 9.83592 16.1301 9.81475 16.1462C9.49144 16.3856 9.17102 16.6307 8.84771 16.873C8.67163 17.0057 8.60234 16.9999 8.44935 16.847C8.02982 16.4317 7.6122 16.0144 7.19651 15.5953C7.05795 15.4568 7.05795 15.3905 7.17631 15.2319C7.42456 14.903 7.67572 14.5771 7.91532 14.2425C7.93196 14.2173 7.94312 14.1889 7.94809 14.1591C7.95306 14.1293 7.95173 14.0988 7.94418 14.0695C7.87778 13.8849 7.78829 13.7118 7.7219 13.5272C7.71302 13.4942 7.69353 13.465 7.6664 13.4442C7.63927 13.4233 7.60603 13.412 7.5718 13.4119L6.34783 13.2388C6.15153 13.21 6.08803 13.1379 6.08514 12.9504V11.2054C6.08514 11.0006 6.15443 10.9314 6.35649 10.917C6.76352 10.8593 7.17054 10.7958 7.57756 10.7439C7.61242 10.7418 7.6458 10.7291 7.67316 10.7074C7.70053 10.6858 7.72057 10.6562 7.73056 10.6228C7.79985 10.444 7.86624 10.2651 7.94418 10.095C7.96142 10.0646 7.96795 10.0293 7.96271 9.9948C7.95748 9.96028 7.94079 9.92851 7.91532 9.90461C7.67283 9.58734 7.43324 9.27007 7.19364 8.94991C7.05508 8.76821 7.05796 8.69898 7.21672 8.54034L8.46956 7.28857C8.60235 7.15878 8.68027 7.15878 8.83616 7.28857C9.16235 7.5395 9.48856 7.78755 9.82342 8.02983C9.84975 8.04525 9.87901 8.05501 9.90933 8.05848C9.93965 8.06196 9.97036 8.05908 9.9995 8.05002C10.1843 7.98368 10.3575 7.89427 10.5393 7.82793C10.5704 7.81994 10.5982 7.80217 10.6184 7.77725C10.6387 7.75233 10.6504 7.72156 10.6519 7.68949C10.7067 7.27992 10.7674 6.87324 10.8251 6.46367C10.854 6.25889 10.9232 6.19543 11.1138 6.19543H12.8602C13.0623 6.19543 13.1287 6.26177 13.1489 6.48386C13.2066 6.89054 13.2701 7.29722 13.325 7.70679C13.3263 7.73924 13.3379 7.77043 13.3581 7.79585C13.3784 7.82126 13.4062 7.83957 13.4376 7.84812C13.6165 7.92023 13.7984 7.98656 13.9774 8.06732C14.0058 8.08293 14.0384 8.08911 14.0706 8.08496C14.1028 8.08081 14.1328 8.06656 14.1564 8.04425C14.4768 7.7962 14.7972 7.55681 15.1205 7.31453C15.3024 7.17609 15.3688 7.18186 15.5304 7.34337C15.9422 7.75294 16.3531 8.16347 16.763 8.57496C16.9131 8.72494 16.916 8.79416 16.789 8.96145C16.5408 9.28737 16.2896 9.6133 16.0471 9.94499C16.0324 9.96998 16.023 9.99773 16.0195 10.0265C16.0161 10.0553 16.0186 10.0845 16.0269 10.1123C16.0933 10.294 16.1857 10.467 16.2492 10.6516C16.2584 10.6872 16.2794 10.7185 16.3087 10.7405C16.3381 10.7626 16.3742 10.7739 16.4109 10.7728L17.6204 10.9429C17.8253 10.9747 17.886 11.0439 17.886 11.2516C17.886 11.8284 17.886 12.4053 17.886 12.9821C17.886 13.1956 17.8225 13.2705 17.5973 13.2907C17.1874 13.3484 16.7746 13.409 16.3647 13.4724C16.341 13.4786 16.3189 13.4894 16.2996 13.5043C16.2802 13.5191 16.2641 13.5377 16.2521 13.559C16.1655 13.7522 16.0847 13.9484 16.0125 14.1358C16.0044 14.1884 16.0168 14.2421 16.0471 14.2858C16.2867 14.6089 16.5321 14.929 16.7746 15.2492C16.916 15.4366 16.9102 15.4914 16.7428 15.6587C16.3291 16.0741 15.9143 16.4875 15.4987 16.899C15.4485 16.9385 15.3955 16.9742 15.3399 17.0057ZM9.783 12.1024C9.78358 12.5409 9.91438 12.9693 10.1588 13.3335C10.4033 13.6976 10.7504 13.9811 11.1563 14.1479C11.5621 14.3148 12.0083 14.3576 12.4385 14.2709C12.8687 14.1841 13.2634 13.9718 13.5727 13.6607C13.882 13.3497 14.092 12.9539 14.176 12.5235C14.26 12.0931 14.2142 11.6475 14.0446 11.2432C13.8749 10.8388 13.589 10.4938 13.223 10.2519C12.8569 10.01 12.4273 9.88213 11.9884 9.88441C11.6976 9.88441 11.4096 9.94188 11.1411 10.0535C10.8726 10.1652 10.6288 10.3288 10.4238 10.5349C10.2189 10.7411 10.0567 10.9857 9.94672 11.2547C9.83674 11.5237 9.7811 11.8118 9.783 12.1024Z" fill="#3A4265" />
                                <path d="M12.4792 22.4858C12.6841 22.2781 12.8545 22.0993 13.0334 21.9291C13.0768 21.8781 13.13 21.8363 13.1899 21.8063C13.2499 21.7764 13.3152 21.7588 13.3821 21.7548C13.449 21.7507 13.516 21.7603 13.5791 21.7828C13.6422 21.8053 13.7001 21.8404 13.7493 21.8859C13.8428 21.9621 13.9024 22.072 13.9154 22.1918C13.9283 22.3116 13.8936 22.4318 13.8186 22.5262C13.3394 23.0165 12.8583 23.503 12.3753 23.9856C12.2948 24.064 12.1879 24.1093 12.0755 24.1125C11.9632 24.1157 11.8538 24.0766 11.7691 24.0029C11.7261 23.9714 11.6855 23.9367 11.6478 23.8991C11.2264 23.478 10.8049 23.0626 10.3892 22.6358C10.3004 22.5451 10.235 22.4343 10.1987 22.3127C10.1743 22.2196 10.1835 22.1209 10.2246 22.0338C10.2658 21.9468 10.3363 21.8771 10.4238 21.8368C10.513 21.7857 10.6168 21.7661 10.7184 21.7813C10.8201 21.7965 10.9136 21.8455 10.9839 21.9205C11.1484 22.0762 11.3072 22.2406 11.466 22.3993L11.5814 22.5089V19.6563C11.5763 19.5694 11.5972 19.483 11.6414 19.408C11.6856 19.333 11.7511 19.2729 11.8297 19.2352C11.9 19.1966 11.9799 19.1785 12.06 19.1831C12.1402 19.1877 12.2174 19.2147 12.2829 19.2612C12.3523 19.3054 12.4083 19.3678 12.4449 19.4414C12.4815 19.5151 12.4974 19.5974 12.4907 19.6794C12.4907 20.5447 12.4907 21.4273 12.4907 22.3012L12.4792 22.4858Z" fill="#3A4265" />
                                <path d="M19.6699 5.08502L19.5458 5.19751C18.9281 5.81666 18.3094 6.43486 17.6897 7.05209C17.6341 7.11284 17.5642 7.15881 17.4864 7.18585C17.4086 7.2129 17.3252 7.22016 17.2439 7.207C17.1626 7.19384 17.0858 7.16066 17.0205 7.11045C16.9552 7.06025 16.9034 6.9946 16.8698 6.91941C16.8308 6.81897 16.8252 6.70865 16.8538 6.60477C16.8824 6.50088 16.9437 6.40895 17.0286 6.34256C17.6387 5.7311 18.2478 5.12251 18.8559 4.51682C18.8924 4.48547 18.931 4.45656 18.9714 4.43029L18.9512 4.39568C18.9165 4.39568 18.879 4.39568 18.8415 4.39568C18.5961 4.39568 18.3536 4.39568 18.1082 4.39568C17.9943 4.39276 17.8859 4.34624 17.8053 4.26573C17.7247 4.18522 17.6782 4.07686 17.6752 3.96304C17.6696 3.90416 17.6763 3.84477 17.6949 3.78862C17.7135 3.73247 17.7436 3.68079 17.7832 3.63686C17.8228 3.59293 17.8711 3.55771 17.9251 3.53342C17.9791 3.50914 18.0375 3.49632 18.0967 3.49579C18.7818 3.49579 19.4659 3.49579 20.1491 3.49579C20.206 3.49615 20.2622 3.50785 20.3144 3.53019C20.3667 3.55253 20.414 3.58507 20.4535 3.6259C20.493 3.66673 20.524 3.71503 20.5446 3.76796C20.5652 3.8209 20.575 3.87742 20.5735 3.9342C20.5735 4.60335 20.5735 5.27538 20.5735 5.95319C20.5739 6.01324 20.5622 6.07277 20.5389 6.12815C20.5157 6.18354 20.4814 6.23365 20.4383 6.27543C20.3951 6.31722 20.3439 6.34983 20.2877 6.37128C20.2316 6.39274 20.1717 6.40259 20.1116 6.40025C20.0515 6.39915 19.9922 6.38603 19.9372 6.36165C19.8822 6.33727 19.8326 6.30213 19.7915 6.25831C19.7503 6.21449 19.7183 6.16287 19.6975 6.1065C19.6766 6.05013 19.6672 5.99015 19.6699 5.93011C19.6699 5.6561 19.6699 5.38498 19.6699 5.08502Z" fill="#3A4265" />
                                <path d="M5.01708 19.7775H5.86577C5.95552 19.7734 6.04427 19.7976 6.11942 19.8468C6.19456 19.896 6.25227 19.9676 6.28435 20.0515C6.32481 20.1341 6.33683 20.2279 6.31857 20.3181C6.3003 20.4083 6.25277 20.49 6.18332 20.5504C6.09627 20.6241 5.98819 20.6685 5.87444 20.6773C5.20665 20.6773 4.54078 20.6773 3.87684 20.6773C3.8154 20.6798 3.75413 20.6695 3.69693 20.647C3.63972 20.6244 3.58785 20.5902 3.54465 20.5465C3.50144 20.5028 3.46785 20.4505 3.44602 20.3931C3.42418 20.3357 3.41459 20.2743 3.41786 20.213C3.41786 19.5554 3.41786 18.8987 3.41786 18.243C3.41786 18.1836 3.42958 18.1247 3.45236 18.0697C3.47513 18.0148 3.50852 17.9649 3.5506 17.9228C3.59269 17.8808 3.64265 17.8474 3.69763 17.8247C3.75262 17.8019 3.81156 17.7902 3.87107 17.7902C3.93059 17.7902 3.98951 17.8019 4.0445 17.8247C4.09948 17.8474 4.14946 17.8808 4.19155 17.9228C4.23363 17.9649 4.26701 18.0148 4.28979 18.0697C4.31257 18.1247 4.32429 18.1836 4.32429 18.243C4.32429 18.5113 4.32429 18.7766 4.32429 19.042V19.0622L4.4282 18.967C5.04596 18.3497 5.66467 17.7315 6.28435 17.1124C6.33922 17.0496 6.40927 17.002 6.48781 16.974C6.56636 16.946 6.65079 16.9386 6.73302 16.9525C6.81525 16.9664 6.89254 17.0011 6.95752 17.0533C7.0225 17.1056 7.07298 17.1736 7.10416 17.2508C7.14334 17.3515 7.14876 17.4622 7.11961 17.5662C7.09046 17.6702 7.02831 17.762 6.94251 17.8277L5.11524 19.6534L5.01708 19.7775Z" fill="#3A4265" />
                                <path d="M1.58769 11.6323H4.44264C4.53888 11.6297 4.63342 11.658 4.71239 11.713C4.79136 11.768 4.8506 11.8469 4.88142 11.938C4.91459 12.0278 4.91699 12.1261 4.88826 12.2174C4.85953 12.3088 4.80127 12.388 4.72264 12.4427C4.62979 12.5005 4.52315 12.5324 4.41378 12.535C3.53045 12.535 2.64711 12.535 1.76378 12.535H1.59058L1.70028 12.6562C1.87348 12.8321 2.05534 13.0023 2.21988 13.1898C2.29859 13.275 2.3423 13.3867 2.3423 13.5027C2.3423 13.6187 2.29859 13.7304 2.21988 13.8157C2.13111 13.9011 2.01265 13.9489 1.88937 13.9489C1.76608 13.9489 1.6476 13.9011 1.55883 13.8157C1.08926 13.3522 0.621623 12.885 0.155902 12.4139C0.108463 12.3717 0.0704932 12.3199 0.0444972 12.262C0.0185013 12.2041 0.00506592 12.1413 0.00506592 12.0779C0.00506592 12.0144 0.0185013 11.9517 0.0444972 11.8937C0.0704932 11.8358 0.108463 11.7841 0.155902 11.7419C0.604303 11.2919 1.0527 10.8429 1.5011 10.3949C1.54289 10.3485 1.59363 10.3109 1.65028 10.2845C1.70693 10.2581 1.76833 10.2434 1.8308 10.2413C1.89327 10.2392 1.95552 10.2496 2.01384 10.2721C2.07217 10.2946 2.12536 10.3285 2.17023 10.372C2.2151 10.4155 2.25075 10.4676 2.27501 10.5251C2.29927 10.5827 2.31166 10.6445 2.31145 10.707C2.31123 10.7694 2.2984 10.8312 2.27374 10.8886C2.24908 10.946 2.21309 10.9978 2.16792 11.041C2.01781 11.2025 1.85616 11.3554 1.70028 11.514C1.66852 11.5429 1.63965 11.5775 1.58769 11.6323Z" fill="#3A4265" />
                                <path d="M11.5179 1.69888L10.9724 2.24689C10.9234 2.30678 10.8611 2.35441 10.7904 2.38595C10.7197 2.4175 10.6427 2.43211 10.5653 2.4286C10.4773 2.42741 10.3917 2.39906 10.3204 2.34743C10.2491 2.2958 10.1955 2.22341 10.167 2.14017C10.1297 2.05888 10.118 1.96818 10.1335 1.88011C10.1489 1.79203 10.1908 1.71072 10.2536 1.64696C10.3864 1.5114 10.5249 1.37872 10.6577 1.24316L11.6392 0.265397C11.6824 0.21129 11.7373 0.167608 11.7998 0.137588C11.8623 0.107568 11.9307 0.09198 12 0.09198C12.0693 0.09198 12.1378 0.107568 12.2002 0.137588C12.2627 0.167608 12.3176 0.21129 12.3609 0.265397C12.7881 0.695153 13.2269 1.13068 13.6397 1.56332C13.7211 1.64899 13.7788 1.75435 13.8071 1.86905C13.8322 1.95994 13.8243 2.05679 13.7846 2.14237C13.745 2.22794 13.6762 2.29666 13.5906 2.3363C13.5007 2.39226 13.3942 2.41563 13.2891 2.4025C13.184 2.38937 13.0866 2.34054 13.0132 2.2642C12.8516 2.11133 12.6986 1.94981 12.5427 1.79406C12.5081 1.75945 12.4792 1.71907 12.4474 1.68157H12.4099V1.81425C12.4099 2.7228 12.4099 3.63134 12.4099 4.53988C12.4147 4.65687 12.3737 4.77112 12.2955 4.85837C12.2174 4.94561 12.1083 4.99898 11.9914 5.00714C11.8843 5.01274 11.7785 4.98142 11.6918 4.91841C11.6051 4.8554 11.5427 4.76453 11.5151 4.66102C11.5093 4.59963 11.5093 4.53783 11.5151 4.47643V1.68157L11.5179 1.69888Z" fill="#3A4265" />
                                <path d="M4.94777 4.41586C5.52511 4.99271 6.08513 5.56957 6.64226 6.10893C6.74618 6.21276 6.85011 6.31371 6.95114 6.42043C7.03797 6.50403 7.09007 6.61728 7.09703 6.73757C7.10398 6.85786 7.06529 6.97634 6.98867 7.06939C6.90735 7.15865 6.79462 7.21301 6.67408 7.22108C6.55354 7.22914 6.43456 7.19029 6.34205 7.11265C6.30297 7.08394 6.26629 7.05211 6.23236 7.01747L4.41374 5.20038L4.2896 5.08213C4.2896 5.37055 4.2896 5.6186 4.2896 5.87242C4.29946 5.96329 4.2826 6.05507 4.24107 6.13652C4.19954 6.21797 4.13515 6.28556 4.05577 6.33101C3.96917 6.3777 3.87074 6.39795 3.77272 6.38923C3.6747 6.38052 3.58141 6.34322 3.50442 6.28198C3.46089 6.24239 3.4259 6.19435 3.40158 6.14079C3.37726 6.08723 3.36413 6.02928 3.36298 5.97048C3.36298 5.29845 3.36298 4.62353 3.36298 3.95149C3.36289 3.8923 3.37488 3.83372 3.39821 3.77932C3.42155 3.72491 3.45574 3.67584 3.4987 3.63508C3.54165 3.59432 3.59247 3.56273 3.64805 3.54226C3.70363 3.52178 3.7628 3.51283 3.82195 3.51597C4.48301 3.51597 5.14406 3.51597 5.80511 3.51597C5.86748 3.51098 5.93021 3.51895 5.98934 3.53938C6.04847 3.5598 6.10271 3.59223 6.14868 3.63463C6.19465 3.67704 6.23133 3.72849 6.25642 3.78575C6.28151 3.84301 6.29448 3.90485 6.29448 3.96736C6.29448 4.02986 6.28151 4.0917 6.25642 4.14896C6.23133 4.20622 6.19465 4.25767 6.14868 4.30008C6.10271 4.34248 6.04847 4.37491 5.98934 4.39533C5.93021 4.41576 5.86748 4.42373 5.80511 4.41874C5.5251 4.41874 5.26242 4.41586 4.94777 4.41586Z" fill="#3A4265" />
                                <path d="M19.0435 19.7515L18.4864 19.2006L17.043 17.7585C16.9816 17.7063 16.9349 17.639 16.9075 17.5632C16.8802 17.4874 16.8731 17.4058 16.8872 17.3265C16.9012 17.2472 16.9357 17.1729 16.9874 17.111C17.039 17.0492 17.106 17.0019 17.1816 16.9739C17.2782 16.9385 17.3835 16.9344 17.4826 16.9624C17.5816 16.9904 17.6692 17.0489 17.733 17.1297L19.5689 18.9641C19.6007 18.9987 19.6237 19.042 19.6526 19.0795L19.6959 19.0593V18.2574C19.6924 18.1841 19.7065 18.1109 19.7372 18.0442C19.7678 17.9774 19.8141 17.919 19.872 17.8738C19.956 17.8146 20.0557 17.7817 20.1585 17.7791C20.2613 17.7765 20.3625 17.8045 20.4493 17.8594C20.5102 17.8926 20.5596 17.9434 20.5911 18.0052C20.6225 18.067 20.6345 18.1368 20.6254 18.2055C20.6254 18.8747 20.6254 19.5477 20.6254 20.2245C20.6262 20.2825 20.6153 20.3401 20.5933 20.3939C20.5714 20.4476 20.5388 20.4964 20.4976 20.5373C20.4564 20.5782 20.4074 20.6104 20.3535 20.632C20.2996 20.6536 20.2419 20.6641 20.1838 20.6629C19.5112 20.6629 18.8357 20.6629 18.1631 20.6629C18.0495 20.6519 17.9442 20.5985 17.8683 20.5133C17.7924 20.4282 17.7515 20.3175 17.7537 20.2035C17.7559 20.0895 17.801 19.9805 17.8801 19.8983C17.9592 19.8161 18.0665 19.7668 18.1804 19.7601C18.4546 19.7486 18.7289 19.7515 19.0435 19.7515Z" fill="#3A4265" />
                                <path d="M22.4239 12.512H19.5747C19.4571 12.5169 19.3422 12.4759 19.2543 12.3977C19.1664 12.3194 19.1124 12.2101 19.1038 12.0928C19.0951 11.9755 19.1325 11.8594 19.208 11.7691C19.2835 11.6789 19.3912 11.6215 19.5083 11.6092C19.6584 11.6092 19.797 11.6092 19.9615 11.6092H22.3719C22.3373 11.5689 22.3171 11.54 22.2911 11.5141C22.1265 11.3468 21.962 11.1766 21.7946 11.0122C21.7085 10.9243 21.6603 10.8063 21.6603 10.6834C21.6603 10.5605 21.7085 10.4424 21.7946 10.3546C21.8883 10.2681 22.0124 10.222 22.1399 10.2264C22.2675 10.2307 22.3881 10.285 22.4758 10.3777C22.9204 10.8363 23.3794 11.2833 23.8297 11.7361C23.8819 11.7769 23.9241 11.829 23.9531 11.8884C23.9822 11.9479 23.9973 12.0132 23.9973 12.0794C23.9973 12.1455 23.9822 12.2108 23.9531 12.2703C23.9241 12.3298 23.8819 12.3819 23.8297 12.4226C23.3948 12.8629 22.955 13.3013 22.5105 13.7378C22.4602 13.8019 22.3939 13.8517 22.3183 13.8821C22.2427 13.9126 22.1604 13.9226 22.0796 13.9112C21.9989 13.8998 21.9226 13.8674 21.8584 13.8172C21.7942 13.767 21.7443 13.7009 21.7137 13.6253C21.678 13.5366 21.6702 13.4391 21.6913 13.3458C21.7124 13.2526 21.7616 13.1679 21.8321 13.1033L22.4239 12.512Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2212">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.0952148)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.supervision') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.hostel') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.hostel_floor') }}</a></li>
                </ol>

            </div>    
        
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.floor') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                <div class="card-body collapse show">
                <div class="form-group pull-right">
                    <div class="">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" id="addHostelFloor" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addHostelFloorModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="hostel-floor-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.floor_name') }}</th>
                                    <th>{{ __('messages.block') }}</th>
                                    <th>{{ __('messages.floor_warden') }}</th>
                                    <th>{{ __('messages.total_room') }}</th>
                                    <th>{{ __('messages.floor_leader') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!--- end row -->
        @include('admin.hostel_floor.add')
        @include('admin.hostel_floor.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    //hostelFloor floors
    var hostelFloorList = "{{ route('admin.hostel_floor.list') }}";
    var hostelFloorDetails = "{{ route('admin.hostel_floor.details') }}";
    var hostelFloorDelete = "{{ route('admin.hostel_floor.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_hostel_floor') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end

    // Get PDF Footer Text
    var header_txt="{{ __('messages.floor') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/hostel_floor.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endif
@endsection