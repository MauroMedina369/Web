<?php
error_reporting(0);
    session_start();
    $_SESSION = array(); 
    $_SESSION['auth'] = false;
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html dir="ltr">

<?php include "header.php"?>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<body>
    <?php include_once("analyticstracking.php") ?>    
    <div class="main-wrapper">
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
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <!-- <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/big/3.jpg);"> -->
                    
            </div>
           
                <div class="col-lg-5 col-md-7 " style="background-color:rgb(255,255,255,0.8)">
                    <div class="p-3">
                    <p class=" text-center text-dark quicksand " style="font-size:26px;font-family:Quicksand semibold">Bienvenido a </p>
                    <p class=" text-center text-dark quicksand " style="font-size:32px;font-family:Quicksand semibold"><strong> <i class="bi bi-activity" style="font-size:46px;" > </i> THERMOCLOUD</strong></p>
                    
                    <p class=" text-center text-dark quicksand " style="margin-top:-30px;margin-left:220px" >by Wisee </p>
                    <hr style="margin-top:0px">
<!--                     
                        <div class="text-center">
                                <img src="assets/images/LogoSM.png" alt="homepage" class="dark-logo" />
                        </div> -->
                        
                        <!-- <p class="text-left text-muted quicksand" style="font-family:Quicksand;margin-top:40px">Ingres?? tu email y contrase??a para acceder</p> -->
                        <form class="mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <p class="text-dark quicksand" for="uname" >Email</p>
                                        <input class="form-control" id="uname" type="text"  placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <p class="text-dark quicksandd" for="pwd" >Contrase??a</p>
                                        <input class="form-control" id="pwd" style="font-family:Quicksand" type="password" placeholder="Contrase??a" >
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <a style="cursor:pointer;color:white;border-radius:20px;width:60%;margin-left:auto;margin-right:auto" class="btn btn-block btn-dark"  onclick="LoginClick()">Ingresar</a>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    ??Primera vez? <a href="register.html" class="text-primary"> Registrate</a>
                                </div>
                                <div class="col-lg-12 text-center mt-5" style="margin-top:-20px">
                                    ??Olvidaste tu contrase??a? <a href="ForgetPass.php" class="text-primary">Hac?? click ac??</a>
                                </div>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <?php include "scripts.php" ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EX292H6B3K"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-EX292H6B3K');
        </script>
 
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();

        function LoginClick(){   
            var uname = document.getElementById("uname").value;
            var pwd = document.getElementById("pwd").value;
            var getdetails = function () {
                var p = md5(pwd);
                var retorno = $.getJSON("check-login.php", {                         
                    Email: uname,
                    Password: p,
                });
                return retorno ;
            };

            getdetails()
                .done(function (response) {
                    //  ahoraOBJ = parseJSON(response.datos);
                    $datos = response;
                    if ($datos === "OK") {                     
                        location.href = "dashboard.php";                        
                    } else {
                        //alert("Error de usuario o contrase??a");
                        swal("Ups!", "Parece que hubo un error con la contrase??a. Intent?? de nuevo.");
                        //document.getElementById('errorlbl').innerText = "Usuario o contrase??a incorrectos.";
                    }
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    swal("Error " +textStatus);
        //            document.getElementById('errorlbl').innerText = "??Ups! Parece que algo no anduvo bien. Intent?? una vez mas.";
                });                    
        }        
    </script>
</body>

</html>