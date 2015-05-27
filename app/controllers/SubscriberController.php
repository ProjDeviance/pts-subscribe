<?php
 

 
class SubscriberController extends BaseController {


  public function edit($subscriber_id)
  {

      $exist = Subscriber::where('id', $subscriber_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find member.');
         return Redirect::back();
      }

    $rules = array(
      'firstname'    => 'required|min:2|max:100',
      'municipality'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
   
      'subscription_type'    => 'required|numeric',

    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

        $sub = Subscriber::find($subscriber_id);

        
        $sub->firstname = strip_tags(Input::get('firstname'));

        $sub->municipality = strip_tags(Input::get('municipality'));
        
        $sub->lastname = strip_tags(Input::get('lastname'));


        $sub->rank = strip_tags(Input::get('subscription_type'));

        $sub->save();

        
        Session::put('msgsuccess', 'Successfully edited user.');
       

        return Redirect::to('/admin/subscribers');

    }
  }
 



  public function deactivate($staff_id)
  {

       $exist = Subscriber::where('id', $staff_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = Subscriber::find($staff_id);
      
        $member->status = 0;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully deactivated user.');
       
        return Redirect::to("/admin/subscribers");

    
  }


  public function activate($staff_id)
  {

       $exist = Subscriber::where('id', $staff_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = Subscriber::find($staff_id);
      
        $member->status = 1;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully activated user.');
       
        return Redirect::to("/admin/subscribers");

    
  }
  public function resetPassword()
  {

       $exist = User::where('email', Input::get('email'))->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find email.');
         return Redirect::back()->withInput();
      }

        $user =User::where('email', Input::get('email'))->first();
        $member = User::find($user->id);
        $pass = substr(md5(uniqid(rand(), true)), 16, 16);
        $member->password = Hash::make($pass);

        $member->save();

        Session::put('userPassword', $pass);
        
        Mail::send('emails.password_reset', array('key' => 'value'), function($message)
               {
                   $message->from('lsapi@gmail.com', 'PTS');
                   $message->to(Input::get('email'), 'PTS')->subject('Your password has been reset.');
               });
      
        Session::put('msgsuccess', 'Your new password has been sent to your email.');
       
        
      
        return Redirect::to("/");

    
  }


  
  }








 
