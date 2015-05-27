<?php




Route::get('/', function()
{

	return View::make('index');
});


Route::get('/login', function()
{
	 if(Auth::check())
    	return Redirect::to("/");

	return View::make('login');
});

Route::post('login', array('uses' => 'AuthController@login', 'as'=>'login'));

Route::get('logout', array('uses' => 'AuthController@logout', 'as'=>'logout'));
Route::post('/edit/account', array('uses' => 'MemberController@editProfile', 'as'=>'/edit/account'));

Route::get('/edit/account', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('account', 1);
		 $exist = User::where('id', Auth::user()->id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit member.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$user = User::find(Auth::user()->id);
		return View::make('members.edit_profile')->with('user', $user);
	}


});

Route::get('/register', function()
{

	return View::make('register');

});
Route::post('register', array('uses' => 'AuthController@register', 'as'=>'register'));

Route::post('/resetpassword', array('uses' => 'MemberController@resetPassword', 'as'=>'/resetpassword'));





Route::group(['prefix' => 'admin'],  function() 
{


Route::get('/subscribers', function()
{
    
		Session::put('management', 1);
		$subscribers = DB::table('subscribers')
	            ->paginate(10);
	
		return View::make('admin.subscribers')->with('subscribers', $subscribers);
	
})->before('admin');
Route::get('/subscribers/edit/{id}', function($id)
{
   
		Session::put('management', 1);
		 $exist = Subscriber::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit staff.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$subscriber = Subscriber::find($id);
		return View::make('admin.edit_subscribers')->with('subscriber', $subscriber);
	
})->before('admin');
Route::post('/subscribers/edit/{id}', array('uses' => 'SubscriberController@edit'))->before('admin');
Route::get('/subscribers/activate/{id}', array('uses' => 'SubscriberController@activate'))->before('admin');
Route::get('/subscribers/deactivate/{id}', array('uses' => 'SubscriberController@deactivate'))->before('admin');


});
