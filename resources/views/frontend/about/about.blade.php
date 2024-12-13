@extends('frontend.main_master')
@section('main')


 <!-- Inner Banner -->
 <div class="inner-banner inner-bg1">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>About Us</li>
            </ul>
            <h3>About Us</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- About Area -->
<div class="about-area pt-100 pb-70">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="{{asset($about->image)}}" alt="Images">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title">
                        <h2>{{$about->title}}</h2>
                        <p>
                            {!! $about->description !!}
                        </p>
                    </div>

                    <div class="about-form">
                        <form method="get" action="{{ route('booking.search') }}">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>CHECK IN TIME</label>
                                        <div class="input-group" >
                                            
                                            {{-- <input autocomplete="off"  type="text" required name="check_out" class="form-control dt_picker" placeholder="yyy-mm-dd"> --}}

                                            {{-- id="datetimepicker"   using this id show all date   --}}

                                            <input autocomplete="off"  type="text"  required class="form-control dt_picker" name="check_in" placeholder="yyy-mm-dd">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>GUESTS</label>
                                        <select name="persion" class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            
                                        </select>	
                                    </div>
                                </div>
    
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>CHECK OUT TIME</label>
                                        <div class="input-group">
                                            <input autocomplete="off"  type="text"  required class="form-control dt_picker" name="check_out" placeholder="yyy-mm-dd">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>
    
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Check Availability
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Area End -->


@endsection