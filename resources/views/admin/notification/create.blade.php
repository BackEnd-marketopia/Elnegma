@extends('admin.layouts.app')

@section('title', 'Add Notification')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Add Notification') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('admin.notifications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            {{-- Title --}}
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label for="title">{{ __('message.Title') }}</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        required>
                                                </div>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" style="display: block;">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            {{-- To (Users or Cities) --}}
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('to') ? ' has-danger' : '' }}">
                                                    <label for="to">{{ __('message.To') }}</label>
                                                    <select class="form-control" id="to" name="to" required>
                                                        <option value="users">{{ __('message.Users') }}</option>
                                                        <option value="cities">{{ __('message.Cities') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- Body --}}
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('body') ? ' has-danger' : '' }}">
                                                    <label for="body">{{ __('message.Body') }}</label>
                                                    <textarea class="form-control" id="body" name="body" rows="4"
                                                        required></textarea>
                                                </div>
                                                @if ($errors->has('body'))
                                                    <span class="invalid-feedback" style="display: block;">
                                                        <strong>{{ $errors->first('body') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- Hidden Type (Always "topic") --}}
                                            <input type="hidden" name="type" value="topic">

                                            {{-- Cities Dropdown (Hidden Initially) --}}
                                            <div class="col-md-12" id="city-select" style="display: none;">
                                                <div class="form-group {{ $errors->has('city_id') ? ' has-danger' : '' }}">
                                                    <label for="city_id">{{ __('message.Select City') }}</label>
                                                    <select class="form-control" id="city_id" name="city_id">
                                                        <option value="">{{ __('message.Choose City') }}</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->id }}">
                                                                @if (app()->getLocale() == 'ar')
                                                                    {{ $city->name_arabic }}
                                                                @else
                                                                    {{ $city->name_english }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Image Upload (Optional) --}}
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('image') ? ' has-danger' : '' }}">
                                                    <label for="image">{{ __('message.Image') }}</label>
                                                    <input type="file" class="form-control" id="image" name="image">
                                                </div>
                                            </div>

                                            {{-- Submit Button --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary"
                                                        type="submit">{{ __('message.Add') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    {{-- Show/Hide Cities Dropdown Based on Selection --}}
    <script>
        document.getElementById('to').addEventListener('change', function () {
            let citySelect = document.getElementById('city-select');
            citySelect.style.display = (this.value === 'cities') ? 'block' : 'none';
        });
    </script>
@endsection