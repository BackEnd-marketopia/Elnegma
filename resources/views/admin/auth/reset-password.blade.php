<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Reset Password</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />

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
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function () {
                document.getElementById('errorAlert').remove();
            }, 5000);
        </script>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function () {
                document.getElementById('successAlert').remove();
            }, 5000);
        </script>
    @endif
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
                            <span style="font-weight: bold; font-size: 2em;">4P</span>
                        </div>
                        <form method="POST" action="{{ route('resetPasswordCode') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <input class="form-control" placeholder="{{ __('message.Phone') }}" type="phone"
                                        name="phone" value="{{ $phone ?? old('phone') }}" required autofocus>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn my-4"
                                    style="background-color: #BD3628; color: white;">{{ __('message.Send') }}</button>
                            </div>
                        </form>
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