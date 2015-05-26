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


Route::get('/staffs/add', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
	
		return View::make('admin.new_staffs');
	}
})->before('admin');
Route::post('/staffs/add', array('uses' => 'StaffController@newStaff'))->before('admin');
Route::get('/staffs', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$staffs = DB::table('users')->where('user_type', 1)
	            ->paginate(10);
	
		return View::make('admin.staffs')->with('staffs', $staffs);
	}
})->before('admin');
Route::get('/staffs/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = User::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit staff.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$staff = User::find($id);
		return View::make('admin.edit_staffs')->with('staff', $staff);
	}
})->before('admin');
Route::post('/staffs/edit/{id}', array('uses' => 'StaffController@edit'))->before('admin');
Route::get('/staffs/activate/{id}', array('uses' => 'StaffController@activate'))->before('admin');
Route::get('/staffs/deactivate/{id}', array('uses' => 'StaffController@deactivate'))->before('admin');


});
