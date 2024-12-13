<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class AboutCotroller extends Controller
{
    //

    public function CreateAbout()
    {
        $about=About::first();

        return view('backend.about.create_about',compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required','image','max:2000']
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        ImageManager::imagick()->read($image)->save('upload/about/'.$name_gen);

        $save_url = 'upload/about/'.$name_gen;

        About::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,

                'description' => $request->description,

                'image' => $save_url,

            ]
        );

        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
