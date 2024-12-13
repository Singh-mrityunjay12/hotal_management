@extends('frontend.main_master')
@section('main')

<!-- use content of room-details.html file of frontend framework  -->

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg10">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>Room Details </li>
                </ul>
                <h3>{{ @$roomdetails->type->name }}</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Room Details Area End -->
    <div class="room-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-4"> --}}
                    {{-- <div class="room-details-side"> --}}
                        {{-- <div class="side-bar-form">
                            <h3>Booking Sheet </h3>
                            <form>
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check in</label>
                                            <div class="input-group">
                                                <input id="datetimepicker" type="text" class="form-control"
                                                    placeholder="09/29/2020">
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class='bx bxs-calendar'></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check Out</label>
                                            <div class="input-group">
                                                <input id="datetimepicker-check" type="text" class="form-control"
                                                    placeholder="09/29/2020">
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class='bx bxs-calendar'></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Numbers of Persons</label>
                                            <select class="form-control">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Numbers of Rooms</label>
                                            <select class="form-control">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}


                    {{-- </div> --}}
                {{-- </div> --}}

                <div class="col-lg-12">
                    <div class="room-details-article">

                        <div class="room-details-slider owl-carousel owl-theme">
                            @foreach ($multiImage as $image)
                                <div class="room-details-item">
                                    <img src="{{ asset('upload/roomimg/multi_img/' . $image->multi_img) }}" alt="Images">
                                </div>
                            @endforeach

                        </div>





                        <div class="room-details-title">
                            <h2>{{ $roomdetails->type->name}}</h2>
                            <ul>

                                <li>
                                    <b> Basic : {{getCurrencyIcon()}}{{ $roomdetails->price }}/Night/Room</b>
                                </li>

                            </ul>
                        </div>

                        <div class="room-details-content">
                            <p>
                                {!! $roomdetails->description !!}
                            </p>




                            <div class="side-bar-plan">
                                <h3>Basic Plan Facilities</h3>
                                <ul>
                                    @foreach ($facility as $fac)
                                        <li><a href="#">{{ $fac->facility_name }}</a></li>
                                    @endforeach
                                </ul>


                            </div>







                            <div class="row">
                                <div class="col-lg-6">



                                    <div class="services-bar-widget">
                                        <h3 class="title">Room Details </h3>
                                        <div class="side-bar-list">
                                            <ul>
                                                <li>
                                                    <a href="#"> <b>Capacity : </b> {{ $roomdetails->room_capacity }}
                                                        Person <i class='bx bxs-cloud-download'></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"> <b>Size : </b> {{ $roomdetails->size }}ft2 <i
                                                            class='bx bxs-cloud-download'></i></a>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>




                                </div>



                                <div class="col-lg-6">
                                    <div class="services-bar-widget">
                                        <h3 class="title">Room Details </h3>
                                        <div class="side-bar-list">
                                            <ul>
                                                <li>
                                                    <a href="#"> <b>View : </b> {{ $roomdetails->view }} <i
                                                            class='bx bxs-cloud-download'></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"> <b>Bad Style : </b> {{ $roomdetails->bed_style }} <i
                                                            class='bx bxs-cloud-download'></i></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>

                    <div class="room-details-review">
                         @auth
                            
                           @php
                            $isBooked=false;
                               $rooms=\App\Models\Booking::where([
                                'user_id' => auth()->user()->id,
                                'status' => '1',
                               ])->get();

                               foreach ($rooms as $key => $room) {
                                

                                $bookingRoom=$room->assign_rooms()->
                                where('room_id',$roomdetails->id)->first();
                                if($bookingRoom)
                                {
                                    $isBooked=true;
                                }
                               }
                           @endphp


                        @if($isBooked===true) 
                            <h2>Clients Review and Retting's</h2>
                            <form action="{{route('review.create')}}" method="POST">
                                 @csrf
                                <div class="review-ratting">
                                    <h3>Your retting: </h3>
                                </div>
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <div class="wsus__single_com">
                                            <select name="rating" id=""
                                                >
                                                <option value="">Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="review" class="form-control" cols="3" rows="8"
                                                placeholder="Write your review here.... "></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" name="room_id" id=""
                                    value="{{ $roomdetails->id }}">

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three">
                                            Submit Review
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endif
                           @endauth  
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Room Details Area End -->

    <!-- Room Details Other -->
    <div class="room-details-other pb-70">
        <div class="container">
            <div class="room-details-text">
                <h2>Other Rooms </h2>
            </div>

            <div class="row ">

                @foreach ($otherRooms as $item)
                    <div class="col-lg-6">
                        <div class="room-card-two">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4 p-0">
                                    <div class="room-card-img">
                                        <a href="{{ url('room/details/' . $item->id) }}">
                                            <img src="{{ asset('upload/roomimg/' . $item->image) }}" alt="Images">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-8 p-0">
                                    <div class="room-card-content">
                                        <h3>
                                            <a href="{{ url('room/details/' . $item->id) }}">{{ $item['type']['name'] }}</a>
                                        </h3>
                                        <span>{{getCurrencyIcon()}}{{ $item->price }} / Per Night </span>
                                        <div class="rating">
                                            @php
                                            $avgRating = $item->reviews()->avg('rating');
                                            $fullRating = round($avgRating);
                                        @endphp

                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullRating)
                                                <i class="bx bxs-star"></i>
                                            @else
                                                <i class="bx bx-star"></i>
                                            @endif
                                        @endfor
                                        </div>
                                        <p>{{ $item->short_desc }}</p>
                                        <ul>
                                            <li><i class='bx bx-user'></i> {{ $item->room_capacity }} Person</li>
                                            <li><i class='bx bx-expand'></i> {{ $item->size }}ft2</li>
                                        </ul>

                                        <ul>
                                            <li><i class='bx bx-show-alt'></i>{{ $item->view }}</li>
                                            <li><i class='bx bxs-hotel'></i> {{ $item->bed_style }}</li>
                                        </ul>

                                        <a href="{{route('user.checking')}}" class="book-more-btn">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
    <!-- Room Details Other End -->
@endsection
