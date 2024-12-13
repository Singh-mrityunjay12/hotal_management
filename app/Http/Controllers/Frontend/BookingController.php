<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BookConfirm;
use App\Models\Booking;
use App\Models\BookingRoomList;
use App\Models\RazorpaySetting;
use App\Models\Room;
use App\Models\RoomBookedDate;
use App\Models\RoomNumber;
use App\Models\User;
use App\Notifications\BookingComplete;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

use Razorpay\Api\Api;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Stripe;




class BookingController extends Controller
{
    //
    public function Checkout()
    {

        if (Session::has('book_date')) {
            $book_data = Session::get('book_date');
            $room = Room::find($book_data['room_id']);

            $toDate = Carbon::parse($book_data['check_in']);
            $fromDate = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);

            $razorpaySetting = \App\Models\RazorpaySetting::first();

            return view('frontend.checkout.checkout', compact('book_data', 'room', 'nights', 'razorpaySetting'));
        } else {

            $notification = array(
                'message' => 'Something want to wrong!',
                'alert-type' => 'error'
            );
            return redirect('/')->with($notification);
        }
    } // End Method 

    public function UserChecking()
    {
        return view('frontend.room.check_availabilty');
    }

    public function BookingStore(Request $request)
    {

        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'persion' => 'required',
            'number_of_rooms' => 'required',

        ]);

        if ($request->available_room < $request->number_of_rooms) {

            $notification = array(
                'message' => 'Something want to wrong!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        Session::forget('book_date');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['available_room'] = $request->available_room;
        $data['persion'] = $request->persion;
        $data['check_in'] = date('Y-m-d', strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d', strtotime($request->check_out));
        $data['room_id'] = $request->room_id;

        Session::put('book_date', $data);

        return redirect()->route('checkout');
    } // End Method 





    public function CheckoutStore(Request $request)
    {



        // dd($request->all());

        $user = User::where('role', 'admin')->get();

        // dd(env('STRIPE_SECRET'));

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

        $book_data = Session::get('book_date');
        $toDate = Carbon::parse($book_data['check_in']);
        $fromDate = Carbon::parse($book_data['check_out']);
        $total_nights = $toDate->diffInDays($fromDate);

        $room = Room::find($book_data['room_id']);

        $subtotal = $room->price * $total_nights * $book_data['number_of_rooms'];
        $discount = ($room->discount / 100) * $subtotal;
        $total_price = $subtotal - $discount;
        $code = rand(000000000, 999999999);

        //Use Stripe payment gateway 
        // if ($request->payment_method == 'Stripe') {
        //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        //     $s_pay = Stripe\Charge::create([
        //         "amount" => $total_price * 100,
        //         "currency" => "usd",
        //         "source" => $request->stripeToken,
        //         "description" => "Payment For Booking. Booking No " . $code,

        //     ]);

        //     if ($s_pay['status'] == 'succeeded') {
        //         $payment_status = 1;
        //         $transation_id = $s_pay->id;
        //     } else {

        //         $notification = array(
        //             'message' => 'Sorry Payment Field',
        //             'alert-type' => 'error'
        //         );
        //         return redirect('/')->with($notification);
        //     }
        // } else {
        //     $payment_status = 0;
        //     $transation_id = '';
        // }


        if ($request->payment_method == 'Stripe') {

            $data = new Booking();
            $data->rooms_id = $room->id;
            $data->user_id = Auth::user()->id;
            $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
            $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));
            $data->persion = $book_data['persion'];
            $data->number_of_rooms = $book_data['number_of_rooms'];
            $data->total_night = $total_nights;

            $data->actual_price = $room->price;
            $data->subtotal = $subtotal;
            $data->discount = $discount;
            $data->total_price = $total_price;
            $data->payment_method = 'Razorpay';
            $data->transation_id = '';
            $data->payment_status = 1;

            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->country = $request->country;
            $data->state = $request->state;
            $data->zip_code = $request->zip_code;
            $data->address = $request->address;

            $data->code = $code;
            $data->status = 0;
            $data->created_at = Carbon::now();
            $data->save();


            //    <!--save the data into room_booked_dates table of database -->  

            $sdate = date('Y-m-d', strtotime($book_data['check_in']));
            $edate = date('Y-m-d', strtotime($book_data['check_out']));
            $eldate = Carbon::create($edate)->subDay();
            $d_period = CarbonPeriod::create($sdate, $eldate);
            foreach ($d_period as $period) {
                $booked_dates = new RoomBookedDate();
                $booked_dates->booking_id = $data->id;
                $booked_dates->room_id = $room->id;
                $booked_dates->book_date = date('Y-m-d', strtotime($period));
                $booked_dates->save();
            }
            return redirect()->route('razorpay.payment')->with(['id' => $data->id, 'total' => $total_price]);
           


        } else {
            //Save data into bookings table of database 

            $data = new Booking();
            $data->rooms_id = $room->id;
            $data->user_id = Auth::user()->id;
            $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
            $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));
            $data->persion = $book_data['persion'];
            $data->number_of_rooms = $book_data['number_of_rooms'];
            $data->total_night = $total_nights;

            $data->actual_price = $room->price;
            $data->subtotal = $subtotal;
            $data->discount = $discount;
            $data->total_price = $total_price;
            $data->payment_method = $request->payment_method;
            $data->transation_id = '';
            $data->payment_status = 0;

            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->country = $request->country;
            $data->state = $request->state;
            $data->zip_code = $request->zip_code;
            $data->address = $request->address;

            $data->code = $code;
            $data->status = 0;
            $data->created_at = Carbon::now();
            $data->save();

            //    <!--save the data into room_booked_dates table of database -->  

            $sdate = date('Y-m-d', strtotime($book_data['check_in']));
            $edate = date('Y-m-d', strtotime($book_data['check_out']));
            $eldate = Carbon::create($edate)->subDay();
            $d_period = CarbonPeriod::create($sdate, $eldate);
            foreach ($d_period as $period) {
                $booked_dates = new RoomBookedDate();
                $booked_dates->booking_id = $data->id;
                $booked_dates->room_id = $room->id;
                $booked_dates->book_date = date('Y-m-d', strtotime($period));
                $booked_dates->save();
            }

            Session::forget('book_date');


            $notification = array(
                'message' => 'Booking Added Successfully',
                'alert-type' => 'success'
            );

            Notification::send($user, new BookingComplete($request->name)); //$request->name is user name
            return redirect('/')->with($notification);
        }
    } // End Method 


    public function payment()
    {
        return view('frontend.payment_gatway.razorpay');
    }



    public function payWithRazorPay(Request $request)
    {

        //   dd($request->all());
        $razorPaySetting = RazorpaySetting::first();
        $api = new Api($razorPaySetting->razorpay_key, $razorPaySetting->razorpay_secret_key);

        
        $total_price = $request->total;
        $payableAmount = round($total_price * $razorPaySetting->currency_rate, 2);
        $payableAmountInPaisa = $payableAmount * 100;


        if ($request->has('razorpay_payment_id') && $request->filled('razorpay_payment_id')) {
            try {
                $response = $api->payment->fetch($request->razorpay_payment_id)
                    ->capture(['amount' => $payableAmountInPaisa]);
            } catch (\Exception $e) {
                $notification = array(
                    'message' => 'Sorry Payment Field',
                    'alert-type' => 'error'
                );
                return redirect('/')->with($notification);
            }


            if ($response['status'] == 'captured') {
                // $this->CheckoutStore('razorpay', 1, $response['id'], $payableAmount, $razorPaySetting->currency_name);
                // clear session


                $id = $request->user_id;
                $data =  Booking::findOrFail($id);

                $data->transation_id = $response['id'];

                $data->save();



                Session::forget('book_date');


                $notification = array(
                    'message' => 'Booking Added Successfully',
                    'alert-type' => 'success'
                );
                $user = User::where('role', 'admin')->get();

                Notification::send($user, new BookingComplete($request->name)); //$request->name is user name
                return redirect('/')->with($notification);
            }
        }
    }



    public function MarkAsRead(Request $request, $notificationId)
    {

        $user = Auth::user();
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['count' => $user->unreadNotifications()->count()]);
    } // End Method 



    public function BookingList()
    {

        $allData = Booking::orderBy('id', 'desc')->get();
        return view('backend.booking.booking_list', compact('allData'));
    } // End Method 

    public function EditBooking($id)
    {

        $editData = Booking::with('room')->find($id);
        return view('backend.booking.edit_booking', compact('editData'));
    } // End Method 


    public function UpdateBookingStatus(Request $request, $id)
    {

        $booking = Booking::find($id);
        $booking->payment_status = $request->payment_status;
        $booking->status = $request->status;
        $booking->save();

        /// Start Sent Email 

        $sendmail = Booking::find($id);

        $data = [
            'check_in' => $sendmail->check_in,
            'check_out' => $sendmail->check_out,
            'name' => $sendmail->name,
            'email' => $sendmail->email,
            'phone' => $sendmail->phone,
        ];

        Mail::to($sendmail->email)->send(new BookConfirm($data));

        /// End Sent Email 

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function UpdateBooking(Request $request, $id)
    {

        if ($request->available_room < $request->number_of_rooms) {

            $notification = array(
                'message' => 'Something Want To Wrong!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $data = Booking::find($id);
        $data->number_of_rooms = $request->number_of_rooms;
        $data->check_in = date('Y-m-d', strtotime($request->check_in));
        $data->check_out = date('Y-m-d', strtotime($request->check_out));
        $data->save();

        BookingRoomList::where('booking_id', $id)->delete();
        RoomBookedDate::where('booking_id', $id)->delete();

        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $data->rooms_id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }



        $notification = array(
            'message' => 'Booking Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }  // End Method 



    public function AssignRoom($booking_id)
    {

        $booking = Booking::find($booking_id);

        $booking_date_array = RoomBookedDate::where('booking_id', $booking_id)->pluck('book_date')->toArray(); //fetch book_date array from  room_book_dates table by using pluck method

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $booking_date_array)->where('room_id', $booking->rooms_id)->distinct()->pluck('booking_id')->toArray(); //fetch booking_id array from  room_book_dates table by using pluck method

        $booking_ids = Booking::whereIn('id', $check_date_booking_ids)->pluck('id')->toArray(); //fetch id array from  bookings table by using pluck method

        $assign_room_ids = BookingRoomList::whereIn('booking_id', $booking_ids)->pluck('room_number_id')->toArray(); //fetch room_number_id array from  booking_room_list table by using pluck method

        $room_numbers = RoomNumber::where('rooms_id', $booking->rooms_id)->whereNotIn('id', $assign_room_ids)->where('status', 'Active')->get(); //vo room number do jo assign nahi aur active ho

        return view('backend.booking.assign_room', compact('booking', 'room_numbers'));
    } // End Method 


    public function AssignRoomStore($booking_id, $room_number_id)
    {

        $booking = Booking::find($booking_id);
        $check_data = BookingRoomList::where('booking_id', $booking_id)->count();

        if ($check_data < $booking->number_of_rooms) {
            $assign_data = new BookingRoomList();
            $assign_data->booking_id = $booking_id;
            $assign_data->room_id = $booking->rooms_id;
            $assign_data->room_number_id = $room_number_id;
            $assign_data->save();

            $notification = array(
                'message' => 'Room Assign Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Room Already Assign',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    } // End Method 


    public function AssignRoomDelete($id)
    {

        $assign_room = BookingRoomList::find($id);
        $assign_room->delete();

        $notification = array(
            'message' => 'Assign Room Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    //    Download invoice method 
    public function DownloadInvoice($id)
    {

        $editData = Booking::with('room')->find($id);
        $pdf = Pdf::loadView('backend.booking.booking_invoice', compact('editData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
        //downloaded with this name 

    } // End Method 

    // user booking details 
    public function UserBooking()
    {
        $id = Auth::user()->id;
        $allData = Booking::where('user_id', $id)->orderBy('id', 'desc')->get();
        return view('frontend.dashboard.user_booking', compact('allData'));
    } // End Method 


    //User invoice details 
    public function UserInvoice($id)
    {

        $editData = Booking::with('room')->find($id);
        $pdf = Pdf::loadView('backend.booking.booking_invoice', compact('editData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // End Method 


}
