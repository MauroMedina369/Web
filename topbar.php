
<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center" >
    <div class="container d-flex justify-content-between align-items-center">

        <div class="logo">
            <!-- <h1><a href="index.php">SoftLand</a></h1> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="index.php"><img src="assets/img/LogoBlanco2.png" alt="" class="img-fluid" style="width: auto"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="active " href="index.php">Inicio</a></li>
                <li><a href="Nosotros.php">Nosotros</a></li>
                <li>
                    <a href="/THERMOCLOUD"  target="_blank"> <i class="bi bi-activity">  </i>THERMOCLOUD</a>
                </li>
                <!-- 
                    <li class="dropdown"><a href="#productos_section"><span>Productos</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>

                            <li class="dropdown"><a href="#"><span>Ambiente</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="AIR2.php">Dióxido de carbono (CO2)</a></li>
                                    <li><a href="404.php">Humo, Monóxido de carbono (CO) y GAS</a></li>
                                    <li><a href="404.php">Temperatura y humedad</a></li>
                                </ul>
                            </li>

                            <li class="dropdown"><a href="#"><span>Jardín</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="404.php">Humedad de tierra</a></li>
                                </ul>
                            </li>

                            <li class="dropdown"><a href="#"><span>Fluídos</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="404.php">Inundación</a></li>
                                    <li><a href="404.php">Nivel de fluído</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> 
                -->

                <!-- <li class="dropdown"><a href="index.php#Aplicaciones"><span>Aplicaciones</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>

                        <li class=""><a href=""><span>Industria Agroalimentaria</span> </a></li>
                        <li class=""><a href=""><span>Biotecnología</span> </a></li>
                        <li class=""><a href=""><span>Farma & Salud</span> </a></li>
                        <li class=""><a href=""><span>Gastronomía</span> </a></li>
                        <li class=""><a href=""><span>Cadenas de frío</span> </a></li>
                        <li class=""><a href=""><span>Datacenters</span> </a></li>
                    </ul>
                </li>                 -->
                <li><a href="index.php#Soluciones">Soluciones & Servicios</a></li>
                <li><a href="index.php#Aplicaciones">Aplicaciones</a></li>
                <li class="dropdown"><a href="index.php#productos_section"><span>Productos</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li class=""><a href="W23.php"><span>Pixi W23 (Temperatura y Humedad)</span> </a></li>
                        <li class=""><a href="PixiSonda.php"><span>PixiSonda (Con sonda)</span> </a></li>
                        <li class=""><a href="Pixirelay.php"><span>PixiRelay (contacto seco)</span> </a></li>
                        <li class=""><a href="Pixigrow.php"><span>PixiGrow (Cultivo interior)</span> </a></li>
                        <li class=""><a href="AIR2.php"><span>AIR2 (Dióxido de carbono)</span> </a></li>
                        <li class=""><a href="GAS.php"><span>AIR1 (Gas, CO, Humo)</span> </a></li>

                    </ul>
                </li>                
                <li><a href="Soporte.php">Soporte</a></li>                
                <li><a href="contact.php">Contactanos</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

    </div>
</header>
<!-- End Header -->


    <script>
        var path = window. location. pathname;
        var page = path. split("/"). pop();
       if (page == "AIR2.php") document.getElementById('header').style.backgroundColor="#673AB7";
       if (page == "GAS.php") document.getElementById('header').style.backgroundColor="#673AB7";
       if (page == "PixiSonda.php") document.getElementById('header').style.backgroundColor="#673AB7";
       if (page == "W23.php") document.getElementById('header').style.backgroundColor="#673AB7";
       if (page == "Pixigrow.php") document.getElementById('header').style.backgroundColor="#673AB7";
       if (page == "Pixirelay.php") document.getElementById('header').style.backgroundColor="#673AB7";
    </script>