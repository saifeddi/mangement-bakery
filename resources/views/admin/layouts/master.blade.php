<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/invoika/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Jun 2025 08:44:16 GMT -->

<head>

    <meta charset="utf-8" />
    <title>BREAD-LAB app V 1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

  @include('admin.components.style')
  @yield('style')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

         @include('admin.components.navbar')

           <!-- remove notification--->
        <!-- ========== App Menu ========== -->
          @include('admin.components.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    
                    @yield('page-title')
                    <!-- end page title -->
                     @yield('button')
                    @yield('content')
                    
                    <!-- end row -->

                     

                   

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

           @include('admin.components.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onClick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div> -->

    <!-- Theme Settings -->

@include('admin.components.theme-setting')
   @include('admin.components.js')
   @yield('js')
</body>


 
</html>