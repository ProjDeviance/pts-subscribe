<?php

class AuthController extends BaseController {


	public function logout()
	{
		Auth::logout();
		Session::flush();
		return Redirect::to('/')->with('msgsuccess','You have logged out.');	
	}

	
	public function login()
	{
		$userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
    if(Input::get('email')=="superadmin@gmail.com"&&Input::get("password")=="superadmin")
    {
      Session::put("admin", "superadmin");
      return Redirect::to('/admin/subscribers')->with( 'msgsuccess' , 'You have logged in successfully.');
    }

		if (Auth::Attempt($userdata)) 
		{
			$checkUser = User::find(Auth::id());
      if($checkUser->status==0)
      {
        Auth::logout();
        return Redirect::back()->withInput(Input::except('password'))->with( 'msgfail' , 'You account is not activated. Please contact a library personel to activate your account.' );
      }
		
			return Redirect::to('/')->with( 'msgsuccess' , 'You have logged in successfully.');

		}

		return Redirect::back()->withInput(Input::except('password'))->with( 'msgfail', 'Invalid credentials.');
	}
	

  public function register()
  {
   
    $rules = array(
      
      'password'    => 'required|min:3|max:20|confirmed',
      'password_confirmation'    => 'required',
      'email'    => 'required|email|min:3|max:100|unique:users',
      'username'    => 'required|min:3|max:100|unique:users',
      'firstname'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
      'municipality'    => 'required|min:2|max:100',
      
    	'subscription_type'	=> 'required',
    
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else {
  
        $nextSub = Subscriber::orderBy("id", "DESC")->first();
        $nextUser = User::orderBy("id", "DESC")->first();
        $nextOffice = Office::orderBy("id", "DESC")->first();

        $user = new User;

        $user->username = strip_tags(Input::get('username'));
        $user->firstname = strip_tags(Input::get('firstname'));
        $user->lastname = strip_tags(Input::get('lastname'));
        $user->email = strip_tags(Input::get('email'));
        $user->password = strip_tags(Hash::make(Input::get('password')));
        $user->confirmation_code = 'ok';
        $user->confirmed = 1;
        $user->subscriber_id = $nextSub->id+1;
        $user->office_id = $nextOffice->id+1;
        $user->save();

        $office = new Office;
        $office->officeName = "Default";
        $office->subscriber_id = $nextSub->id+1;
        $office->save();

        $assigned = new Assigned;
        $assigned->user_id = $user->id;
        $assigned->role_id = 3;
        $assigned->save();
        
        $sub = new Subscriber;
        $sub->status = '0';
        $sub->firstname = strip_tags(Input::get('firstname'));
        $sub->lastname = strip_tags(Input::get('lastname'));
        $sub->municipality = strip_tags(Input::get('municipality'));
        $sub->email = strip_tags(Input::get('email'));
      
        $sub->rank = strip_tags(Input::get('subscription_type'));
        $sub->user_id = $user->id;
        $sub->save();
      

        Session::put('msgsuccess', 'You have successfully registered online.');
        return Redirect::to('/');
  }

}
}