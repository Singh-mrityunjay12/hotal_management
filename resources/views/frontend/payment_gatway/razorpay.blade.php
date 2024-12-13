@extends('frontend.main_master')
@section('main')


{{-- <div class="col d-flex">
    <div class="card bg-danger w-100">
        <img src="assets/images/gallery/35.png" class="card-img-top" alt="...">
        <div class="card-body text-white">
            <h5 class="card-title text-white">Card Sample Title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small>Last updated 3 mins ago</small></p>
        </div>
    </div>
</div> --}}

<div class="container mb-5 mt-3 mr-2"  >
    <div class="row ml-3">
        <div class="col d-flex">
            <div class="card bg-danger w-auto">
                @php
                // dd($total_price);
                    $razorpaySetting = \App\Models\RazorpaySetting::first();
                    $total = session()->get('total');

                    // $total=100;
                    $payableAmount = round($total* $razorpaySetting->currency_rate, 2);

                @endphp
                
                <form action="{{route('razorpay.payment1')}}" method="POST">
                    @csrf
                    <input type="hidden"  value="{{session()->get('id') }}" name="user_id">
                    <input type="text" hidden value="{{session()->get('total') }}" name="total">
                    
                    <script src="https://checkout.razorpay.com/v1/checkout.js"

                        data-key="{{$razorpaySetting->razorpay_key}}"
                        data-amount="{{$payableAmount * 100}}"
                        data-buttontext="Pay With Razorpay"
                        data-name="payment"
                        data-description="Payment for product"
                        data-prefill.name="{{Auth::user()->name}}"
                        data-prefill.email="{{Auth::user()->email}}"
                        data-theme.color="#ff7529"
                    >

                    </script>

{{-- <button type="submit" class="order-btn" id="myButton">Place to Order</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>

@endsection