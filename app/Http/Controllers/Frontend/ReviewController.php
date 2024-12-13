<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RoomReview;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //


    public function create(Request $request)
    {

        $request->validate([
            'rating' => ['required'],
            'review' => ['required', 'max:200'],
            
        ]);
    
        $checkReviewExist = RoomReview::where(['room_id' => $request->room_id, 'user_id' => Auth::user()->id])->first();
        if($checkReviewExist){
            // toastr('You already added a review for this product!', 'error', );
            // flash()->error('You already added a review for this product!');
            $notification = array(
                'message' => 'You already added a review for this product!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
            // return redirect()->back();
        }

        

        $productReview = new RoomReview();
        $productReview->room_id = $request->room_id;
        
        
        $productReview->user_id = Auth::user()->id;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->status = 0;

        $productReview->save();

       

        // toastr('Review added successfully!', 'success', );
        // flash()->success('Review added successfully!');
        $notification = array(
            'message' => 'Review added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}

