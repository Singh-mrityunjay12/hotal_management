@php
    $setting = App\Models\SiteSetting::find(1);
@endphp


<!-- Footer Area -->
<footer class="footer-area footer-bg">
    <div class="container">
        <div class="footer-top pt-100 pb-70">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="{{ asset($setting->logo) }}" alt="Images">
                            </a>
                        </div>
                        <p>
                            Aenean finibus convallis nisl sit amet hendrerit. Etiam blandit velit non lorem mattis,
                            non ultrices eros bibendum .
                        </p>
                        <ul class="footer-list-contact">
                            <li>
                                <i class='bx bx-home-alt'></i>
                                <a href="#">{{ $setting->address }}</a>
                            </li>
                            <li>
                                <i class='bx bx-phone-call'></i>
                                <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                            </li>
                            <li>
                                <i class='bx bx-envelope'></i>
                                <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget pl-5">
                        <h3>Links</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="{{route('about.page')}}" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="services-1.html" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Services
                                </a>
                            </li>
                            <li>
                                <a href="team.html" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Team
                                </a>
                            </li>
                            <li>
                                <a href="{{route('show.gallery') }}" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Gallery
                                </a>
                            </li>
                            <li>
                                <a href="terms-condition.html" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Terms
                                </a>
                            </li>
                            <li>
                                <a href="privacy-policy.html" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3>Useful Links</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="{{url('/')}}" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{'blog.list'}}" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Blog
                                </a>
                            </li>
                           
                            
                            <li>
                                <a href="{{route('show.gallery') }}" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Gallery
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact.us') }}" class="nav-link">
                                    <i class='bx bx-caret-right'></i>
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3>Newsletter</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Nullam tempor eget ante fringilla rutrum aenean sed venenatis .
                        </p>
                        <div class="footer-form">
                            {{-- class="newsletter-form" data-toggle="validator"  --}}
                            {{-- {{route('newsletter-request')}}  --}}

                            {{-- <form action="text/javascript" method="POST"  id="news"> --}}
                                {{-- Or  --}}
                            <form action="text/javascript"   id="news">
                                @csrf
                                <div class="row">
                                    
                                       
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control newsletter_email" placeholder="Your Email*"
                                                name="email" >
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-one subscribe_btn">
                                            Subscribe Now
                                        </button>
                                        {{-- <div id="validator-newsletter" class="form-result"></div> --}}
                                    </div>

                               
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copy-right-area">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="copy-right-text text-align1">
                        <p>
                            {{ $setting->copyright }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="social-icon text-align2">
                        <ul class="social-link">
                            <li>
                                <a href="{{ $setting->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a>
                            </li>

                            <li>
                                <a href="{{ $setting->instagram }}" target="_blank"><i class='bx bxl-instagram'></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting->twitter }}" target="_blank"><i class='bx bxl-twitter'></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting->youtube }}" target="_blank"><i class='bx bxl-youtube'></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<!-- Footer Area End -->

@push('scripts')
<script>

$(document).ready(function(){
    //iska use karake CSRF-TOKEN ka error remove karate h 
    $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },

       });



         // newsletter
   $('#news').on('submit', function(e){
       e.preventDefault();
       let data = $(this).serialize();   //serialize is used to access all of the data from the form
       
       // alert('hello');
       $.ajax({
           method: 'POST',
           url: "{{route('newsletter-request')}}",
           data: data,
           beforeSend: function(){
               $('.subscribe_btn').text('Loading...');
           },
           success: function(data){
               if(data.status === 'success'){
                   $('.subscribe_btn').text('Subscribe');
                   $('.newsletter_email').val('');
                   toastr.success(data.message);

               }else if(data.status === 'error'){

                   $('.subscribe_btn').text('Subscribe');
                   toastr.error(data.message);

               
               }
           },
           error: function(data){
               let errors = data.responseJSON.errors;  //responseJSON... json data ko object me convert kar dega 
               if(errors){
                   $.each(errors, function(key, value){
                       toastr.error(value);
                   })
               }
               $('.subscribe_btn').text('Subscribe');
            //    console.log(data);
           }
       })
       


   })



});
</script>    
@endpush