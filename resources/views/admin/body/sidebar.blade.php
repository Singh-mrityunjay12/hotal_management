<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Easy</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
         
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        {{-- Manage  Team part  --}}
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Team</div>
            </a>
            <ul>
                <li> <a href="{{route('all.team')}}"><i class='bx bx-radio-circle'></i>All Team</a>
                </li>
                <li> <a href="{{route('add.team')}}"><i class='bx bx-radio-circle'></i>Add Team</a>
                </li>
                
            </ul>
        </li> --}}
        {{-- Manage Team part  --}}

         {{-- Book Area part  --}}

        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Book Area </div>
            </a>
            <ul>
                <li> <a href="{{ route('book.area') }}"><i class='bx bx-radio-circle'></i>Update BookArea </a>
                </li> 

            </ul>
        </li> --}}

         {{-- Book Area part  --}}

         @if(Auth::user()->can('team.menu'))
        <li  class="{{setActive(['all.team',
        'add.team'

        ])}}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Teams </div>
            </a>
            <ul>
                @if(Auth::user()->can('team.all'))
                <li class="{{setActive(['all.team'])}}"> <a href="{{ route('all.team') }}"><i class='bx bx-radio-circle'></i>All Team</a>
                </li>
                @endif 
                @if(Auth::user()->can('team.add'))
                <li class="{{setActive(['add.team'])}}"> <a href="{{ route('add.team') }}"><i class='bx bx-radio-circle'></i>Add Team</a>
                </li>
                @endif 
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('bookarea.menu'))
        <li class="{{setActive([
               'book.area',

        ])}}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Book Area </div>
            </a>
            <ul>
                @if(Auth::user()->can('update.bookarea'))
                <li class="{{setActive(['book.area'])}}"> <a href="{{ route('book.area') }}"><i class='bx bx-radio-circle'></i>Update BookArea </a>
                </li> 
                @endif
                 
            </ul>
        </li>
        @endif

         {{-- RoomType list  --}}

         <li class="{{setActive(['room.type.list'])}}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Room Type </div>
            </a>
            <ul>
                <li class="{{setActive(['room.type.list'])}}"> <a href="{{ route('room.type.list') }}"><i class='bx bx-radio-circle'></i>Room Type List </a>
                </li> 

            </ul>
        </li>

        {{-- RoomType list  --}}
        
        <li class="menu-label">UI Elements</li>
       
        <li class="{{setActive(['booking.list','edit_booking'])}}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Booking</div>
            </a>
            <ul>
                <li class="{{setActive(['booking.list','edit_booking'])}}"> <a href="{{ route('booking.list') }}"><i class='bx bx-radio-circle'></i>Booking List </a>
                </li>
               
                
            </ul>
        </li>
        <li class="{{setActive(['view.room.list'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage RoomList</div>
            </a>
            <ul>
                <li class="{{setActive(['view.room.list'])}}"> <a href="{{ route('view.room.list') }}"><i class='bx bx-radio-circle'></i>Room List</a>
               
            </ul>
        </li>
       
        
        <li class="{{setActive(['smtp.setting','site.setting'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
            <ul>
                <li class="{{setActive(['smtp.setting'])}}"> <a href="{{ route('smtp.setting') }}"><i class='bx bx-radio-circle'></i>SMTP Setting</a>
                </li>
                <li class="{{setActive(['site.setting'])}}"> <a href="{{ route('site.setting') }}"><i class='bx bx-radio-circle'></i>Site Setting</a>
                </li>


            </ul>
        </li>

        
        <li class="{{setActive(
        ['all.testimonial',
        'add.testimonial']
        )}}">

            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Testimonial</div>
            </a>
            <ul>
                <li class="{{setActive(['all.testimonial'])}}"> <a href="{{ route('all.testimonial') }}"><i class='bx bx-radio-circle'></i>All Testimonial</a>
                </li>

                <li class="{{setActive(['add.testimonial'])}}"> <a href="{{ route('add.testimonial') }}"><i class='bx bx-radio-circle'></i>Add Testimonial</a>
                </li>


            </ul>
        </li>

        <li class="{{setActive(['blog.category','all.blog.post'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
            <ul>
                <li class="{{setActive(['blog.category'])}}" > <a href="{{ route('blog.category') }}"><i class='bx bx-radio-circle'></i>Blog Category </a>
                </li>

                <li class="{{setActive(['all.blog.post'])}}"> <a href="{{ route('all.blog.post') }}"><i class='bx bx-radio-circle'></i>All Blog Post</a>
                </li>

            </ul>
        </li>
        
        <li class="{{setActive(['all.comment'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Comment</div>
            </a>
            <ul>
                <li class="{{setActive(['all.comment'])}}"> <a href="{{ route('all.comment') }}"><i class='bx bx-radio-circle'></i>All Comments </a>
                </li>
            </ul>
        </li>

        <li class="{{setActive(['question.index'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Question</div>
            </a>
            <ul>
                <li class="{{setActive(['question.index'])}}"> <a href="{{ route('question.index') }}"><i class='bx bx-radio-circle'></i>All Questions </a>
                </li>
            </ul>
        </li>

        <li class="{{setActive(['reviews.index'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Reviews</div>
            </a>
            <ul>
                <li class="{{setActive(['reviews.index'])}}"> <a href="{{ route('reviews.index') }}"><i class='bx bx-radio-circle'></i>All Reviews </a>
                </li>
            </ul>
        </li>

        <li class="{{setActive(['booking.report'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Booking Report </div>
            </a>
            <ul>
                <li class="{{setActive(['booking.report'])}}"> <a href="{{ route('booking.report') }}"><i class='bx bx-radio-circle'></i>Booking Report </a>
                </li> 
            </ul>

        </li>
        
        <li class="{{setActive(['all.gallery'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Hotel Gallery </div>
            </a>
            <ul>
                <li class="{{setActive(['all.gallery'])}}"> <a href="{{ route('all.gallery') }}"><i class='bx bx-radio-circle'></i>All Gallery </a>
                </li> 

            </ul>
        </li>

        <li class="{{setActive(['contact.message'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Contact Message </div>
            </a>
            <ul>
                <li class="{{setActive(['contact.message'])}}"> <a href="{{ route('contact.message') }}"><i class='bx bx-radio-circle'></i>Contact Message </a>
                </li> 

            </ul>
        </li>

        <li class="{{setActive(['create.about.page'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">About Us </div>
            </a>
            <ul>
                <li class="{{setActive(['create.about.page'])}}"> <a href="{{ route('create.about.page') }}"><i class='bx bx-radio-circle'></i>About Us</a>
                </li> 

            </ul>
        </li>

        <li class="menu-label">Role & Permission </li>

        <li class="{{setActive(['all.permission','all.roles','add.roles.permission','all.roles.permission'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Role & Permission </div>
            </a>
            <ul>
                <li class="{{setActive(['all.permission'])}}"> <a href="{{ route('all.permission') }}"><i class='bx bx-radio-circle'></i>All Permission </a>
                </li> 
                <li class="{{setActive(['all.roles'])}}"> <a href="{{ route('all.roles') }}"><i class='bx bx-radio-circle'></i>All Roles </a>
                </li> 
                <li class="{{setActive(['add.roles.permission'])}}"> <a href="{{ route('add.roles.permission') }}"><i class='bx bx-radio-circle'></i>Role In Permission </a>
                </li>

                <li class="{{setActive(['all.roles.permission'])}}"> <a href="{{ route('all.roles.permission') }}"><i class='bx bx-radio-circle'></i>All Role In Permission </a>
                </li>

            </ul>
        </li>

        <li class="{{setActive(['all.admin','add.admin'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Admin User </div>
            </a>
            <ul>
                <li class="{{setActive(['all.admin'])}}"> <a href="{{ route('all.admin') }}"><i class='bx bx-radio-circle'></i>All Admin </a>
                </li> 
                <li class="{{setActive(['add.admin'])}}"> <a href="{{ route('add.admin') }}"><i class='bx bx-radio-circle'></i>Add Admin </a>
                </li> 

                
                 
            </ul>
        </li>

        <li class="{{setActive(['razorpay.index'])}}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Razorpay Setting</div>
            </a>
            <ul>
                <li class="{{setActive(['razorpay.index'])}}"> <a href="{{ route('razorpay.index') }}"><i class='bx bx-radio-circle'></i>Razorpay </a>
                </li> 
               
                
                 
            </ul>
        </li>


      
        <li class="menu-label">Other</li>
     
        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>