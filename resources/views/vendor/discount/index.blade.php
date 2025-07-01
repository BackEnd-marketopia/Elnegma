@extends('vendor.layouts.app')
@section('title', 'Vendors')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Discounts') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto"
                                    href="{{ route('vendor.discounts.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Discount') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Title') }}</th>
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.Start Date') }}</th>
                                            <th>{{ __('message.End Date') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Title') }}</th>
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.Start Date') }}</th>
                                            <th>{{ __('message.End Date') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($discounts as $discount)

                                            <tr>
                                                <td>{{ Str::limit($discount->title, 100) }}</td>
                                                <td>{{ Str::limit($discount->description, 100) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($discount->start_date)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($discount->end_date)->format('d/m/Y')  }}</td>
                                                <td><img src="{{ asset($discount->image) }}" alt="title" width="70px"
                                                        height="70px" style="border-radius: 5px;"></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('vendor.discounts.edit', $discount->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('vendor.discounts.destroy', $discount->id) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger delete-btn"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $discounts->links() }}
                                <p>{{ __('message.Page') }}: {{ $discounts->currentPage() }} {{ __('message.of') }}
                                    {{ $discounts->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection