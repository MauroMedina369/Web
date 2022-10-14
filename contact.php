<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Wisee IOT Sensors - Contactenos</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">
    <link href="assets/img/favicon.ico" rel="apple-touch-icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: SoftLand - v4.7.0
  * Template URL: https://bootstrapmade.com/softland-bootstrap-app-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?php 
      include 'topbar.php';
    ?>

    <!-- End Header -->

    <main id="main">

        <section class="hero-section inner-page">
            <div class="wave">
                <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
            </g>
          </g>
        </svg>

            </div>

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-7 text-center hero-text">
                                <h1 data-aos="fade-up" data-aos-delay="">Estemos en contacto</h1>
                                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Nos gustaría saber de vos. ¡Escribinos! </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="section">
            <div class="container">
                <div class="row mb-5 align-items-end">
                    <div class="col-md-6" data-aos="fade-up">

                        <h2>Formulario de contacto</h2>
                        <p class="mb-0">Completá el formulario y te responderemos a la brevedad.</p>
                        <p>
                            O escribinos a <strong> info@wisee.com.ar</strong>
                        </p>


                    </div>

                </div>

                <div class="row">
                    <!-- <div class="col-md-4 ms-auto order-2" data-aos="fade-up">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong class="d-block mb-1">Address</strong>
                                <span>203 Fake St. Mountain View, San Francisco, California, USA</span>
                            </li>
                            <li class="mb-3">
                                <strong class="d-block mb-1">Phone</strong>
                                <span>+1 232 3235 324</span>
                            </li>
                            <li class="mb-3">
                                <strong class="d-block mb-1">Email</strong>
                                <span>youremail@domain.com</span>
                            </li>
                        </ul>
                    </div> -->

                    <div class="col-md-6 mb-5 mb-md-0" data-aos="fade-up">
                        <form class="php-email-form" method="post" action="mailhandle.php">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="col-md-12 form-group mt-3">
                                    <label for="name">WhatsApp</label>
                                    <input type="text" class="form-control" name="celu" id="celu" required>
                                </div>
                                <div class="col-md-12 form-group mt-3">
                                    <label for="name">Mensaje</label>
                                    <textarea class="form-control" name="message" id="message" required></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="loading">Cargando...</div>
                                    <div class="error-message">Error al enviar el mensaje</div>
                                    <div class="sent-message">Tu mensaje fue enviado. ¡Gracias!</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <input id="sendbtn" type="submit" value="Enviar Mensaje" class="btn btn-primary d-block w-100" />
                                    <!-- <input type="submit" class="btn btn-primary d-block w-100" value="Enviar Mensaje"> -->
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <?php 
      include 'footer.php';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="assets/js/sendmails.js"></script>

</body>

</html>