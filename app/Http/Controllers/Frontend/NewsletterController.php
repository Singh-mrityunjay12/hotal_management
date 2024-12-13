<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    //

    public function newsLetterRequest(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'email' => ['required', 'email']
        ]);
    
        $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();
         
        if(!empty($existSubscriber)){
            if($existSubscriber->is_verified == 0){
                $existSubscriber->verified_token = \Str::random(25);
                $existSubscriber->save();
                 
        //         // set mail config
            
        //         MailHelper::setMailConfig();
               
                // send mail
                Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));
                   
                //yha se response ko send karenge to jaha se ajax ki request ayi thi 
                return response(['status' => 'success', 'message' => 'A verification link has been sent to your email please check']);

            }elseif($existSubscriber->is_verified == 1){
                //yha se response ko send karenge to jaha se ajax ki request ayi thi 
                return response(['status' => 'error', 'message' => 'You already subscribed with this email!']);
            }
        }else {
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = \Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();

            // set mail config
            // MailHelper::setMailConfig();

            // send mail

            //yaha mail send karenge us user ke mail ko jo subscribe karana chaha 

            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));
            
            //yha se response ko send karenge to jaha se ajax ki request ayi thi 
            return response(['status' => 'success', 'message' => 'A verification link has been sent to your email please check']);
        }


    }


    public function newsLetterEmailVerify($token)
    {
       $verify = NewsletterSubscriber::where('verified_token', $token)->first();
       if($verify){
            $verify->verified_token = 'verified';
            $verify->is_verified = 1;
            $verify->save();
            $notification = array(
                'message' => 'Email verification successfully',
                'alert-type' => 'success'
            );
            // toastr('Email verification successfully', 'success', );
            // flash()->success('Email verification successfully');
            return redirect()->back()->with($notification);
       }else {
            // toastr('Invalid token', 'error', );
            // flash()->error('Invalid token.');
            $notification = array(
                'message' => 'Invalid token',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
       }
    }
}
