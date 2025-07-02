<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
</head>

<body class="{{ $class ?? '' }}" style="background:#f7f7f7">
    <!-- Modern notifications with SweetAlert2 -->
    @if(session('error') || session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: "{{ __('message.Error') }}",
                        text: "{{ session('error') }}",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 4000,
                        timerProgressBar: true,
                        background: '#ffffff',
                        iconColor: '#E53935',
                        customClass: {
                            popup: 'animated fadeInRight'
                        },
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                @endif

                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: "{{ __('message.Success') }}",
                        text: "{{ session('success') }}",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 4000,
                        timerProgressBar: true,
                        background: '#ffffff',
                        iconColor: '#6000C1',
                        customClass: {
                            popup: 'animated fadeInRight'
                        },
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                @endif
            });
        </script>
    @endif
    
    <style>
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translate3d(100%, 0, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        
        .animated {
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }
        
        .fadeInRight {
            animation-name: fadeInRight;
        }
        
        /* Custom SweetAlert2 Styling */
        .swal2-popup {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 1rem;
        }
        
        .swal2-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-top: 0;
            padding-top: 0;
        }
        
        .swal2-html-container {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
        }
        
        .swal2-timer-progress-bar {
            background: #6000C1;
            height: 3px;
        }
        
        .swal2-icon {
            margin: 0.5rem auto;
        }
        
        .swal2-close {
            color: #888;
            font-size: 1.5rem;
            top: 10px;
            right: 10px;
        }
        
        .swal2-close:hover {
            color: #6000C1;
            transform: scale(1.1);
        }
    </style>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-white shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <li class="nav-item dropdown hidden-caret" style="list-style: none;">
                            <a class="dropdown-toggle" href="#" id="languageDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('message.Language') }}
                            </a>
                            <ul class="dropdown-menu animated fadeIn" aria-labelledby="languageDropdown">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('setLocale', 'en') }}">{{ __('message.English') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('setLocale', 'ar') }}">{{ __('message.Arabic') }}</a>
                                </li>
                            </ul>
                        </li>

                        <div class="text-center text-muted mb-4">
                            <img src="{{ asset('assets/img/kaiadmin/app_logo.png') }}" alt="Logo" class="logo"
                                width="100">
                            </br>
                        </div>
                        <form method="POST" action="{{ route('loginStore') }}">
                            @csrf
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('message.Email') }}" type="email" name="email"
                                        value="{{ old('email') }}" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group position-relative">
                                <div class="input-group input-group-alternative">
                                    <input id="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" placeholder="{{ __('message.Password') }}" type="password"
                                        required>
                                    <i id="eye-icon" class="fa fa-eye position-absolute" onclick="togglePassword()"
                                        style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="d-flex justify-content-end mt-6">
                                <a href="{{ route('resetPassword') }}" class="btn btn-link"
                                    style="color: #BD3628;">{{ __('message.Forget Password') }}</a>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn my-4"
                                    style="background-color: #BD3628; color: white;">{{ __('message.Sign in') }}</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="{{ route('register.vendor') }}" class="btn btn-link"
                                style="color: #BD3628;">{{ __('message.Register as Vendor') }}</a>
                            <a href="{{ route('register.provider') }}" class="btn btn-link"
                                style="color: #BD3628;">{{ __('message.Register in The Educational Section') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function togglePassword() {
        let passwordInput = document.getElementById("password");
        let eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

</html>