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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="dist/js/js-fluid-meter.js"> </script>
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
                    <div class="card border-right" style="border-radius:30px;margin:20px">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="mb-1 font-weight-medium text-dark" id="onlinetxt"></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate" >Online</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="fa fa-2x fa-wifi"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-right" style="border-radius:30px;margin:20px">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium" id="fueravalortxt"></h2>
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
                </div>
                <!-- *************************************************************** -->
                <!-- Fin Tarjetas de Arriba-->
                <!-- *************************************************************** -->   

                <!-- *************************************************************** -->
                <!-- Tabla de dispositivos -->
                <!-- *************************************************************** -->

                    
                    <hr>
                    <h3 class="card-title text-light"><i data-feather="box" class="feather-icon"></i> Mis wisee's</h3>
                    <div class="row" >  
                        <?php include "DeviceCardList.php"?>                                           
                        <div class="col-md-3 col-6" class="text-light" > 
                            <div class="card3" style="margin-top:20px;height:auto;backgroundColor:rgb(255,255,255,0.1)" href="#add-modal" data-toggle="modal" data-target="#add-modal" >
                                <div class="container text-center " style="margin-top:30px;margin-bottom:30px">
                                    <p>Agregar</p>
                                    <p><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                        

                <!-- *************************************************************** -->
                <!-- Dispositivo Individual Inferior -->
                <!-- *************************************************************** -->          
                    <section id="dispositivo" class="section">
                            <div class=""  id="mainpage">  
                                <div class="row" style="margin-top:20px"  >
                                    <a class = "" style="margin-left:20px;margin-bottom:20px;cursor:pointer;color:white;font-size:x-large" id="devicestate"  data-toggle="modal" data-target="#modify-dev-modal" aria-expanded="false" class="">...</a>                               
                                </div> 
                                <div class="row" style="margin-top:20px">
                                    <div class="col-sm-12 col-md-4" id="tableTemp"> 
                                        <div class="card card-body"  style="color:#000">
                                            <h4 class="card-title"><i class="fa fa-thermometer-half"></i> Temperatura</h4>
                                            <h4 class="card-text" id="temptxt">...</h4>
                                            <div class="GaugeMeter" id="GaugeTemp" style="color:black;margin-left: auto;margin-right:auto;" aria-valuemin="10" aria-valuemax="50" data-bind="gaugeValue: Percent" data-animate_gauge_colors="1" data-animate_text_colors="1" data-append=" °C" data-size=200 data-theme="Dark" data-width=10 data-style="Arch" data-label="Temperatura" data-animationstep="1" data-label_color="Black"  data-stripe="2"></div>                                                                                      
                                            <!-- <p class="text-left text-muted">Temperaturas registradas </p> -->
                                        </div>
                                    </div>           
                                    <div class="col-sm-12 col-md-4"  id="tableHR" > 
                                        <div class="card card-body" style="color:#000">
                                            <h4 class="card-title"><i class="fa fa-tint"></i> % Humedad</h4>
                                            <h4 class="card-text" id="HRtxt">...</h4>
                                            <div class="GaugeMeter" id="GaugeHR" style="color:black;margin-left: auto;margin-right:auto" aria-valuemin="10" aria-valuemax="50" data-bind="gaugeValue: Percent" data-animate_gauge_colors="1" data-animate_text_colors="1" data-append=" %" data-size=200 data-theme="Dark" data-width=10 data-style="Arch" data-label="Humedad" data-animationstep="1" data-label_color="Black"  data-stripe="2"></div>                                                                                                          


                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4"  id="tableResumen" style="display:block" > 
                                        <div class="card card-body" style="color:#000">
                                            <h4 class="card-title "><i class="fa fa-list"></i> Resumen</h4>
                                            <p class="text-left"> <i class="fa fa-thermometer-half"></i> Temperatura</p>
                                            <small class="text-left text-muted"> <i class="fa fa-circle" aria-hidden="true"></i> Pico Máximo: <a id="picoTemp"></a> </small> 
                                            <small class="text-left text-muted"> <i class="fa fa-circle" aria-hidden="true"></i> Promedio: <a id="promedioTemp"></a> </small> 
                                            <small class="text-left text-muted"> <i class="fa fa-arrow-alt-circle-up" aria-hidden="true"></i> Límite máximo: <a id="templimmax"></a> </small> 
                                            <small class="text-left text-muted"> <i class="fa fa-arrow-alt-circle-down" aria-hidden="true"></i> Límite mínimo: <a id="templimmin"></a> </small>                                             
                                            <br>
                                            <p class="text-left"><i class="fa fa-tint"></i> Humedad</p>
                                            <small class="text-left text-muted"> <i class="fa fa-circle" aria-hidden="true"></i> Pico Máximo: <a id="picoHR"></a> </small> 
                                            <small class="text-left text-muted"> <i class="fa fa-circle" aria-hidden="true"></i> Promedio: <a id="promedioHR"></a> </small> 
                                            <small class="text-left text-muted"> <i class="fa fa-arrow-alt-circle-up" aria-hidden="true"></i> Límite máximo: <a id="hrlimmax"></a> </small>                                             
                                            <small class="text-left text-muted"> <i class="fa fa-arrow-alt-circle-down" aria-hidden="true"></i> Límite mínimo: <a id="hrlimmin"></a> </small>                                             
                                        </div>
                                    </div>                                    
                                    <div class="col-sm-12 col-md-4"  id="tablePPM" style="display:none" > 
                                        <div class="card card-body" style="color:#000">
                                            <h4 class="card-title"><i class="bi bi-wind"></i> PPM</h4>
                                            <h4 class="card-text" id="PPMtxt">...</h4>
                                            <div class="GaugeMeter" id="GaugePPM" style="color:black;margin-left: auto;margin-right:auto;"  data-text_size="0.12" data-showvalue="true" data-total="3000"  data-animate_gauge_colors="1" data-animate_text_colors="1" data-append=" / 3000" data-size=200 data-theme="Black" data-width=10 data-style="Arch" data-label="PPM" data-animationstep="1" data-label_color="Black"  data-stripe="2"></div>                                          
                                        </div>
                                    </div>      
                                    <div class="col-sm-12 col-md-4"  id="tableSoil" style="display:none"  > 
                                        <div class="card card-body" style="color:#000">
                                            <h4 class="card-title"><i class="fa fa-seedling"></i> % Humedad de Tierra</h4>
                                            <h4 class="card-text" id="soiltxt">...</h4>
                                            <div id="fluid-meter-3" class="text-primary"></div>
                                        </div>
                                    </div>                                                                                                                 
                                </div>
                                              

                                <div class="text-center">
                                    <div class="text-light " style="margin-left:20px;margin-right:20px;margin-bottom:20px;font-size:medium" id="sensorstatetxt"> ...  </div>   
                                                                                                                                        
                                </div>     
                                                       

                                <div class="card border-right" style="border-radius:10px">
                                    <div class="card-header">
                                        <p><i class="fa fa-chart-line"></i> Registros históricos</p>
                                        
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="" id="grafico">
                                            <div class="row" style="height: 500px;margin-top:40px;margin-bottom:40px;margin-left:0px;margin-right:0pxcolor:white" id="DivGraphicDay">                
                                                <canvas id="canvas" style="margin-left: 0px;margin-top:-20px; margin-right: auto; width: auto;color:white;color:white"></canvas>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="card-footer">
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
                                                
                                                <div class= " input-group-append text-center"  style="margin-top:20px">
                                                    <button type="button" class="btn btn-outline-secondary" style="margin-left:auto" onclick ="graphicSelectDate(0)"> <i class="fa fa-eye"></i> Mostrar resultados</button> 
                                                    <button type="button" class="btn btn-outline-secondary" style="margin-right:auto" onclick ="graphicSelectDate(1)"> <i class="fa fa-calendar"></i> Ver hoy</button>          
                                                    <button type="button" class="btn btn-outline-secondary" style="margin-right:auto" onclick ="ExportDataPHP()"> <i class="fa fa-download"></i> Descargar (CSV)</button>                                                   
                                                </div>                                                                                         
                                        </div>
                                    </div>
                                </div>                                                                                     
                                <label class="text-light" style="margin-left:20px;font-size:small" id="lastreadtxt"> Última lectura </label>                                                                                       
                            </div>                                                 
                    </section>                                                                                                                     
            </div>
                <hr>
        </div>
        
    </div>
 
    <?php include("modify-dev-modal.php") ?>      
    <?php include("profile-modal.php") ?>  
    <?php include("devicelist-modal.php") ?>   
    <?php include("alert-center-modal.php") ?>     
    <?php include("telegram_modal.php") ?>          
    <?php include("add-device-modal.php") ?>      
    
    
    <?php include("modify-alerts-modal.php") ?>
    <?php include("asistente.php") ?>

    <!-- All Jquery -->
    <!-- ============================================================== -->  
    <?php include "scripts.php" ?>                          
    <script src="dist/js/WiseeV7.js"></script>   
</body>

</html>