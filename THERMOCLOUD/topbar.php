        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar " data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="#main">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <!-- <img src="assets/images/LogoSM.png" alt="homepage" class="dark-logo" style="max-height:50px;margin-top:5px;margin-left:10px;margin-right:auto"/>
                                <img src="assets/images/LogoSM.png" alt="homepage" class="light-logo" /> -->
                                <a class=" text-center text-dark quicksand " style="font-size:22px;font-family:Quicksand semibold"><strong> <i class="bi bi-activity" style="font-size:36px;" > </i> </strong></a>
                                <!-- <a class="text-dark quicksand " style="margin-top:50px;margin-left:-120px" >by Wisee </a>                     -->
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <label class="text-dark" style="font-size:18px;font-family:Quicksand semibold"> <strong class="">THERMOCLOUD</strong></label>
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Puntitos de la barra de arriba-->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>                   
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
             
                <div class="navbar-collapse collapse  " id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- NOTIFICACIONES BARRA SUPERIOR-->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1" style="cursor:pointer">
                        <li class="nav-item dropdown" style="pointer:cursor">
                            <a class="nav-link dropdown-toggle  position-relative" onclick="ClearAlarms()" id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon" ></i></span>
                                <span class="badge badge-cyan notify-no rounded-circle" id="cantalertstxt"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative" id ="listadoalertstxt">
                                            
                                            <!-- <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-danger rounded-circle btn-circle"><i
                                                        data-feather="airplay" class="text-white"></i></div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">Just see
                                                        the my new
                                                        admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                                </div>
                                            </a> -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">

                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    
                                                    <span class="font-12 text-nowrap d-block text-muted">No hay nuevas alarmas</span>
                                                    
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="#alert-center" data-target="#alert-center" data-toggle="modal">
                                            <strong>Mostrar Todas las alarmas</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Notification -->
                    </ul>


                                        
                    <!-- ============================================================== -->
                    <!-- PERFIL BARRA SUPERIOR -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hola,</span> <span
                                        class="text-dark" id="nametxt">Mauro</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY fade">
                                <a class="dropdown-item" href="#Profile-Modal" data-target="#Profile-Modal" data-toggle="modal" aria-expanded="false"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Perfil</a>
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#Settings-Modal"><i data-feather="settings"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Ajustes</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login.php"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Salir</a>

                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>              
                </div>
            </nav>                     
        </header>   