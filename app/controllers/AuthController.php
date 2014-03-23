<?php

use Illuminate\Support\MessageBag;			

class AuthController extends Controller {
	
	public function __construct() 
	{
		//parent::__construct();
		$this->layout = 'layouts.login'; 
		$this->layout = View::make($this->layout);
	}
	
	public function login()
	{
		$errors = new MessageBag();

		if ($old = Input::old("errors")) {
			$errors = $old;
		}

		$data = [
			"errors" => $errors
			];

		if (Input::server("REQUEST_METHOD") == "POST") {
			$validator = Validator::make(Input::all(), [
					"username" => "required",
					"password" => "required"
			]);

			if ($validator->passes()) {
				$practicepro_user = PracticeProUser::findByEmail(Input::get("username"), Input::get("password"));
				
				if ($practicepro_user) {
					$bizval_user = User::findPracticeProUser($practicepro_user[0]->mh2_id);
					
					if (!$bizval_user) {
						// add the user
						User::create([
							// username is still here for compatibility purposes
							"username"		=> $practicepro_user[0]->mh2_id,
							"practicepro_user_id"	=> $practicepro_user[0]->mh2_id,
							"password"		=> Hash::make(PracticeProUser::BIZVAL_PASSWORD),
							"email"			=> $practicepro_user[0]->mh2_email
						]);
					}
					else {
						// we need to update email address if in case practicepro user updated theirs
						$bizval_user->email = $practicepro_user[0]->mh2_email;
						$bizval_user->save();
					}
					
					
					$credentials = [
						"username" => $practicepro_user[0]->mh2_id,
						"password" => PracticeProUser::BIZVAL_PASSWORD
					];

					if (Auth::attempt($credentials)) {
						// save user info to the current session
						Session::put('practicepro_user', $practicepro_user[0]);
						
						Auth::user()->firstname     = $practicepro_user[0]->mh2_fname;
						Auth::user()->lastname      = $practicepro_user[0]->mh2_lname;
						
						// todo: redirect this to the list of business
						return Redirect::to("");
					}
				}
			}
			
			$data["errors"] = new MessageBag([
					"password" => [
						"Username and/or password invalid."
					]
			]);

			$data["username"] = Input::get("username");
			return Redirect::route("login")
				->withInput($data);
		}
		
		$this->layout->content = View::make("user.login", $data);
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route("login");
	}
}
