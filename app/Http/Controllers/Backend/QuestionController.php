<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class QuestionController extends Controller
{
    //
    public function question()
    {
        $questions=Question::get();
        return view('backend.question.question',compact('questions'));
    }

    public function addQuestion()
    {
        return view('backend.question.add_question');
    }


    public function storeQuestion(Request $request)
    {

          $request->validate([
            
            
            'title'=>['string','max:200'],
            
           
            'description'=>['required',],
            'answer'=>['required'],



          ]);
       

          $question= new Question();


        //   $image = $request->file('image');
        //   $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        //   ImageManager::imagick()->read($image)->resize(550,670)->save('upload/question/'.$name_gen);
        //   $save_url = 'upload/question/'.$name_gen;

          $question->title=$request->title;
          $question->description=$request->description;
          $question->answer=$request->answer;
          
          $question->save();

          $notification = array(
            'message' => 'Add New Question Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('question.index')->with($notification);


    }


    public function editQuestion(string $id)
    {

        $question= Question::findOrFail($id);


        return view('backend.question.edit_question',compact('question'));
    }


    public function updateQuestion(Request $request,string $id)
    {
        $request->validate([
            
            
            'title'=>['string','max:200'],
            
           
            'description'=>['required',],
            'answer'=>['required'],



          ]);

          $question=Question::findOrFail($id);
          
          $question->title=$request->title;
          $question->description=$request->description;
          $question->answer=$request->answer;

          $question->save();


          $notification = array(
            'message' => 'Update Question Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('question.index')->with($notification);       
    }

    public function deleteQuestion(string $id)
    {

     $question=Question::find($id);

     $question->delete();

     $notification = array(
        'message' => 'Delete Question Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification); 
     
    }
}
