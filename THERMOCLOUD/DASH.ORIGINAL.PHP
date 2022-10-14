<?php
session_start();
error_reporting(0);

    if(!$_SESSION['auth']) {
        header('location:login.php');
        die();
      }
      else {
        $currentTime = time();
        if($currentTime > $_SESSION['expire']) {
          session_unset();
          session_destroy();
          header('location:login.php');
          die();
        }
    }

?>
<!DOCTYPE html>
<html dir="ltr" lang="es">

<?php include "header.php"?>

<body style="height:100%;">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" style="" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <?php include("topbar.php") ?>   
        <?php include("left-sidebar.php") ?>   

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="overflow:hidden;background-color:#4480ce">

            <div class="container-fluid" id="mainpage">  

                <div id="alertdiv">

                </div>        
                <!-- *************************************************************** -->
                <!-- Tarjetas de arriba -->
                <!-- *************************************************************** -->
                <div class="card-group">
                    <div class="card border-right" style="border-radius:30px">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="mb-1 font-weight-medium text-dark" id="onlinetxt">22</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate" >Online</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="fa fa-2x fa-wifi"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card border-right" style="border-radius:30px">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="offlinetxt">3</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Fuera de línea
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="fa fa-2x fa-unlink"></i></span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="card border-right" style="border-radius:30px">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium" id="fueravalortxt">3</h2>
                                        <!-- <span class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.3</span> -->
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Con alarma</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="fa fa-2x fa-exclamation-triangle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">864</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Projects</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- *************************************************************** -->
                <!-- Fin Tarjetas de Arriba-->
                <!-- *************************************************************** -->                
                <!-- *************************************************************** -->
                <!-- Tabla de dispositivos -->
                <!-- *************************************************************** -->
                <div class="row " >
                    <div class="col-12 ">
                        <div class="card " style="border-radius:30px">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Dispositivos</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <!-- <button class="btn btn-outline-success btn-rounded" type="button"  id="dd1" data-toggle="modal" data-target="#add-modal" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="text-success fa fa-2x fa-plus"></i>
                                            </button> -->
                                            <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item"href="#add-dev-modal" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus-circle"></i> Agregar</a>
                                                <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-edit "></i>  Editar</a>
                                                <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-trash "></i>  Eliminar</a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-light table-hover no-wrap " style="border-radius:20px;">
                                        <thead>
                                            <tr class="" style=";border-radius:20px">
                                                <th class="border-0 font-14 font-weight-medium text-dark"><i class="fa fa-microchip"></i>  Dispositivo
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-dark px-2"><i class="fa fa-bars"></i>  Descripción
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-dark"><i class="fa fa-location-arrow"></i>  Ubicación</th>
                                                <th class="border-0 font-14 font-weight-medium text-dark text-center"><i class="fa fa-wifi"></i> 
                                                    Estado
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-dark text-center"> 
                                                    
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-dark">  </th>
                                                <th class="border-0 font-14 font-weight-medium text-dark" style="width:30px"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="devicelist-modaldata2" >

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- *************************************************************** -->
                <!-- Dispositivo Individual Inferior -->
                <!-- *************************************************************** -->          
                <div class="row" >
                    <div class="col-12">
                        <div class="">
                            <div class="" style="border-radius:0px;">
                            <div class=""  id="mainpage">  
                                <div class="d-block" style="margin-top:20px"  >
                                    <a class = "" style="margin-left:20px;cursor:pointer;color:white;font-size:x-large" id="devicestate"  data-toggle="modal" data-target="#modify-dev-modal" aria-expanded="false" class="">...</a>  
                                    <!-- <i data-feather="chevron-down" class="svg-icon pull-right text-white" style="cursor:pointer; margin-left:-15px;margin-top:7px" data-target="#devicelist-modal" data-toggle="modal"  ></i> -->
                                    <!-- <a class="text-white" style="font-size:15px;margin-top:40px;margin-left:15px" id="MainDescriptiontxt"></a> -->
                             
                                </div>                                        
                                <div class="row " id="maindiv" style="margin-top:20px;margin-bottom:0px" >
                                <div class="col-md-12" id="tableGauge">
                                     <table style="width: 100%;" >
                                                <tr style="width: 100%;">
                                                    <td style="width: 50%;" id="tableTemp">
                                                        <div class=" text-center ">
                                                            <div class="GaugeMeter" id="GaugeTemp" style="color:white;margin-left: auto;margin-right:auto;" aria-valuemin="10" aria-valuemax="50" data-bind="gaugeValue: Percent" data-animate_gauge_colors="1" data-animate_text_colors="1" data-append="°C" data-size=170 data-theme="White" data-width=10 data-style="Arch" data-label="Temperatura" data-animationstep="1" data-label_color="white"  data-stripe="2"></div>                                          
                                                            <i class="fas fa-thermometer-half  text-center" style="font-size:30px;position:absolute;margin-top:-150px;margin-left:-10px;color:white" id="icongaugetemp"></i>                                                                                                      
                                                        </div>                                              
                                                    </td>
                                                    <td style="width: 50%;" id="tableHR" >
                                                        <div class=" text-center" >
                                                            <div class="GaugeMeter" id="GaugeHR" style="color:grey;margin-left: auto;margin-right:auto" aria-valuemin="10" aria-valuemax="50" data-bind="gaugeValue: Percent" data-animate_gauge_colors="1" data-animate_text_colors="1" data-append="%" data-size=170 data-theme="White" data-width=10 data-style="Arch" data-label="Humedad" data-animationstep="1" data-label_color="White"  data-stripe="2"></div>  
                                                            <i class="fas fa-tint text-center " style="font-size:30px;position:absolute;margin-top:-150px;margin-left:-10px;height:300px;color:white" id="icongaugeHR" ></i>                                                                                                                                              
                                                        </div>
                                                    </td>                                                  
                                                </tr>
                                    </table>  
                                </div>
                                <div id="tablePPM" class="col-md-12">
                                    <table style="width: 100%;" >
                                                <tr style="width: 33%;">
                                                <td style="width: 33%" ></td>
                                                    <td style="width: 20%"  >
                                                        <div class="card text-center" style="background-color: rgb(0,0,0,0); border:solid 1px;border-color:white" >
                                                            <p class="text-light" style="font-size:40px">
                                                                <i class="fa fa-fire"></i>
                                                                <a id="valorppm"></a>
                                                                <span style="font-size:small">ppm</span>
                                                            </p>
                                                            
                                                        </div>
                                                    </td>   
                                                    <td style="width: 33%"  ></td>                                                 
                                                </tr>
                                    </table>   
                                </div>
                                                  
                                </div>  
                                <div class="text-center">
                                    <label class="text-light " style="margin-left:20px;margin-right:20px;font-size:medium" id="sensorstatetxt"> ...  </label>                                                                                                       
                                </div>                                

                                <div class="card border-right" style="border-radius:30px">
                                    <div class="card-body">
                                        <div class="">
                                            <div class="chart-area text-light" style="height: 400px;margin-top:40px;margin-bottom:40px;color:white" id="DivGraphicDay">                
                                                <canvas id="canvas" style="margin-left: 0px;margin-top:-40px; margin-right: -50px; width: auto;color:white;color:white"></canvas>
                                            </div>   
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-4" style="margin-left:auto;margin-right:auto" >                                            
                                                <div class="input-group-append">
                                                <h4 class="card-title text-dark" style="margin-right:20px">Desde</h4>
                                                    <input type="date" class="form-control" id="graphicDate1" >
                                                    <!-- <button type="button" class="btn btn-outline-light" style="margin-left:20px" onclick ="graphicSelectDate(0)"> <i class="fa fa-eye"></i> </button>  -->

                                                    <!-- <button type="button" class="btn btn-outline-light" style="margin-left:20px" onclick ="graphicSelectDate(1)"> <i class="fa fa-calendar"></i> </button>  -->
                                                </div>

                                                
                                                <div class="input-group-append" style="margin-top:20px">
                                                <h4 class="card-title text-dark" style="margin-right:20px">Hasta</h4>
                                                    <input type="date" class="form-control" id="graphicDate2" >
                                                    <!-- <button type="button" class="btn btn-outline-light" style="margin-left:20px" onclick ="graphicSelectDate(0)"> <i class="fa fa-eye"></i> </button>  -->

                                                    <!-- <button type="button" class="btn btn-outline-light" style="margin-left:20px" onclick ="graphicSelectDate(1)"> <i class="fa fa-calendar"></i> </button>  -->
                                                </div>        
                                                
                                                <div class="input-group-append text-center"  style="margin-top:20px">
                                                <button type="button" class="btn btn-outline-secondary" style="margin-left:auto" onclick ="graphicSelectDate(0)"> <i class="fa fa-eye"></i> Mostrar resultados</button> 
                                                    <button type="button" class="btn btn-outline-secondary" style="margin-right:auto" onclick ="graphicSelectDate(1)"> <i class="fa fa-calendar"></i> Ver hoy</button>                                                     
                                                </div>                                                
                                        </div>
                                    </div>
                                </div>                                
                               
                                <div class="col-sm-12 col-md-8 col-lg-4" style="margin-left:auto;margin-right:auto;margin-bottom:60px">

                                </div>                             
                                <label class="text-light" style="margin-left:20px;font-size:small" id="lastreadtxt"> Última lectura </label>                                                                                       
                            </div>                            
                            </div>
                        </div>                            
                    </div>
                </div>                                                                                     
            
            </div>
        
    </div>
 
    <?php include("modify-dev-modal.php") ?>      
    <?php include("profile-modal.php") ?>  
    <?php include("devicelist-modal.php") ?>          
    <?php include("add-device-modal.php") ?>      
    <?php include("alert-center-modal.php") ?>  
    <?php include("modify-alerts-modal.php") ?>
    <?php include("asistente.php") ?>

    <!-- All Jquery -->
    <!-- ============================================================== -->  
    <?php include "scripts.php" ?>                          
    <script src="dist/js/WiseeV3.js"></script>   
</body>

</html>