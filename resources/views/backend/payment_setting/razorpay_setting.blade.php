@extends('admin.admin_dashboard')
@section('admin')
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('razorpay-setting.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row mb-3">

                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> RazorPay Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="status" id="" class="form-control" >
                                            <option {{ @$razorpaySetting->status === 1 ? 'selected' : '' }} value="1">
                                                Enable</option>
                                            <option {{ @$razorpaySetting->status === 0 ? 'selected' : '' }} value="0">
                                                Disable</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">

                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> Country Name</h6>
                                    </div>

                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-select form-select-sm" name="country_name" id="small-bootstrap-class-single-field" data-placeholder="Select Country" id="inputState">
                                            <option value="">Select</option>
                                            @foreach (config('settings.country_list') as $country)
                                                <option {{ $country === @$razorpaySetting->country_name ? 'selected' : '' }}
                                                    value="{{ $country }}">{{ $country }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> Currency Name</h6>
                                    </div>

                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-control" id="single-select-field"
                                            data-placeholder="Select Country currency" name="currency_name" id="inputState">
                                            <option value="">Select</option>
                                            @foreach (config('settings.currency_list') as $currency)
                                                <option
                                                    {{ @$razorpaySetting->currency_name == $currency ? 'selected' : '' }}
                                                    value="{{ $currency }}">{{ $currency }}</option>
                                            @endforeach


                                        </select>
                                    </div>

                                </div>


                                <div class="row mb-3">

                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Currency rate ( Per {{ @$settings->currency_name }} )</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="currency_rate"
                                            value="{{ @$razorpaySetting->currency_rate }}">
                                    </div>

                                </div>



                                <div class="row mb-3">

                                    <div class="col-sm-3">
                                        <h6 class="mb-0">RazorPay Key</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="razorpay_key"
                                            value="{{ @$razorpaySetting->razorpay_key }}">
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Razorpay Secret Key</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="razorpay_secret_key"
                                            value="{{ @$razorpaySetting->razorpay_secret_key }}">
                                    </div>


                                </div>
                           

                            <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- @push('scripts')
        <script>
            $('.select2').select2()
        </script>
    @endpush --}}
@endsection
