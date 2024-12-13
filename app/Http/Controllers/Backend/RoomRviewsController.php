<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomReview;
use Illuminate\Http\Request;

class RoomRviewsController extends Controller
{
    //

    public function index()
    {
        $reviews=RoomReview::get();

        return view('backend.reviews.all_reviews',compact('reviews'));


    }

    public function changeStatus(Request $request)
    {

        // dd($request->all());

        $review = RoomReview::findOrFail($request->id);
        $review->status = $request->status == 'true' ? 1 : 0;
        $review->save();

        return response(['message' => 'Status has been updated!']);

    }
}
