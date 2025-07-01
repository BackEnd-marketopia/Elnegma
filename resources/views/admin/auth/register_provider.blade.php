<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Register</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body class="{{ $class ?? '' }}" style="background:#f7f7f7">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-lg-8 col-md-9">
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
                        <form method="POST" action="{{ route('register.providerStore') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Name') }}" type="text" name="name"
                                            value="{{ old('name') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3 col-md-6">
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
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Phone') }}" type="text" name="phone"
                                            value="{{ old('phone') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Image') }}" type="file" name="image"
                                            value="{{ old('image') }}" autofocus>
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group position-relative col-md-6">
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
                                    @endif                                  </div>
                                <div
                                    class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input
                                            class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Confirm Password') }}" type="password"
                                            name="password_confirmation" value="{{ old('password_confirmation') }}"
                                            required autofocus>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="form-group{{ $errors->has('name_of_school_arabic') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input
                                            class="form-control{{ $errors->has('name_of_school_arabic') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Name Of School in Arabic') }}" type="text"
                                            name="name_of_school_arabic" value="{{ old('name_of_school_arabic') }}"
                                            required>
                                    </div>
                                    @if ($errors->has('name_of_school_arabic'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name_of_school_arabic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="form-group{{ $errors->has('name_of_school_english') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input
                                            class="form-control{{ $errors->has('name_of_school_english') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Name Of School in English') }}" type="text"
                                            name="name_of_school_english" value="{{ old('name_of_school_english') }}"
                                            required>
                                    </div>
                                    @if ($errors->has('name_of_school_english'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name_of_school_english') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('logo') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <label for="image" class="input-group">{{ __('message.Logo') }}</label>
                                        <input class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Logo') }}" type="file" name="logo"
                                            value="{{ old('logo') }}" required>
                                    </div>
                                    @if ($errors->has('logo'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="form-group{{ $errors->has('educational_department_id') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <label for="educational_department_id" class="form-label">
                                        {{ __('message.Educational Department') }}
                                    </label>
                                    <select
                                        class="form-control{{ $errors->has('educational_department_id') ? ' is-invalid' : '' }}"
                                        name="educational_department_id[]" id="educational_department_id" multiple
                                        required>
                                        @foreach($educationDepartments as $educationDepartment)
                                            <option value="{{ $educationDepartment->id }}" {{ in_array($educationDepartment->id, old('educational_department_id', [])) ? 'selected' : '' }}>
                                                @if(app()->getLocale() == 'ar')
                                                    {{ $educationDepartment->name_arabic }}
                                                @else
                                                    {{ $educationDepartment->name_english }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('educational_department_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('educational_department_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Address') }}" type="text" name="address"
                                            value="{{ old('address') }}">
                                    </div>
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="form-group{{ $errors->has('whatsapp') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control{{ $errors->has('whatsapp') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Whatsapp') }}" type="text" name="whatsapp"
                                            value="{{ old('whatsapp') }}">
                                    </div>
                                    @if ($errors->has('whatsapp'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('whatsapp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="form-group{{ $errors->has('facebook') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Facebook') }}" type="text" name="facebook"
                                            value="{{ old('facebook') }}">
                                    </div>
                                    @if ($errors->has('facebook'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="form-group{{ $errors->has('instagram') ? ' has-danger' : '' }} mb-3 col-md-6">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('message.Instagram') }}" type="text" name="instagram"
                                            value="{{ old('instagram') }}">
                                    </div>
                                    @if ($errors->has('instagram'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('instagram') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn my-4"
                                        style="background-color: #BD3628; color: white;">{{ __('message.Register') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#educational_department_id').select2({
            placeholder: "{{ __('message.Educational Department') }}",
            allowClear: true,
            multiple: true,
            minimumResultsForSearch: Infinity,
            closeOnSelect: false
        });
    });
</script>
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