<!--
=========================================================
* Argon Design System - v1.2.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('web') }}/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('web') }}/assets/img/favicon.png">
  <title>
    Argon Design System by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{ asset('web') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{ asset('web') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="{{ asset('web') }}/assets/css/font-awesome.css" rel="stylesheet" />
  <link href="{{ asset('web') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset('web') }}/assets/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />
</head>

<body class="register-page bg-primary">

  <div class="wrapper">
    <section class="section section-shaped section-lg">
     
      <div class="container pt-lg-7">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="card bg-secondary shadow border-0">
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                  <small>Sign up with credentials</small>
                </div>
                <form role="form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input class="form-control" placeholder="Name" type="text" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control" placeholder="Email" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group focused">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" placeholder="Password" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group focused">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-12">
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id="customCheckRegister" type="checkbox" name="agree" required>
                                <label class="custom-control-label" for="customCheckRegister"><span>I agree with the <a href="#">Privacy Policy</a></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Create account</button>
                    </div>
                </form>
                
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
  </div>

  @include('sweetalert::alert')

  <!--   Core JS Files   -->
  <script src="{{ asset('web') }}/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="{{ asset('web') }}/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="{{ asset('web') }}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="{{ asset('web') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('web') }}/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <script src="{{ asset('web') }}/assets/js/plugins/moment.min.js"></script>
  <script src="{{ asset('web') }}/assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
  <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-datepicker.min.js"></script>
  <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script src="{{ asset('web') }}/assets/js/argon-design-system.min.js?v=1.2.2" type="text/javascript"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-design-system-pro"
      });
  </script>
</body>

</html>