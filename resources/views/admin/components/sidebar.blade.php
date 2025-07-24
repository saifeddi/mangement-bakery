   <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="21">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="21">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="index.html">
                                <i class="las la-house-damage"></i> <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Gestion de
                                production</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarInvoiceManagement" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarInvoiceManagement">
                                <i class="las la-file-invoice"></i> <span data-key="t-invoices">Produit</span>



                            </a>
                            <div class="collapse menu-dropdown" id="sidebarInvoiceManagement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('product.index')}}" class="nav-link" data-key="t-invoice"> Produits </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarClientManagement" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarClientManagement">
                                <i class="las la-file-invoice"></i> <span data-key="t-invoices">Client</span>



                            </a>
                            <div class="collapse menu-dropdown" id="sidebarClientManagement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('client.index')}}" class="nav-link" data-key="t-invoice"> Client </a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="{{route('command.today')}}" class="nav-link" data-key="t-invoice"> commands </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('client.index')}}" class="nav-link" data-key="t-invoice"> Factures </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                       

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>