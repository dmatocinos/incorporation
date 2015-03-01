<?php

use \Omnipay\Common\GatewayFactory;
use \Carbon\Carbon;

class UpgradeMembershipController extends BaseController {

	protected $user;
	protected $business_id;
	protected $layout = 'layouts.subscribe';

	public function __construct()
	{
		parent::__construct();

		$this->user = Auth::user();
		$this->business_id = Session::get('download_business_id');
	}

	public function upgrade()
	{
		$msg = sprintf("As a %s Member of PracticePro, ", $this->user->practice_pro_user->membership_level_display);
		$msg .= "you can only download up to {$this->user->practice_pro_user->getLimit()} reports for Incorporation and Biz Valuation.";
		
		if (($level = $this->user->practice_pro_user->getMembershipLevelDisplayAttribute()) != 'Professional') {
			$msg .= '<br><br> Upgrade to higher membership level to download more reports.';
		}

		$data = array(
			'msg'   => $msg,
			'level' => $level,
			'upgrade_to' => [
				'proactive' => MembershipLevel::getMembershipLevelId('second'),
				'professional' => MembershipLevel::getMembershipLevelId('third')
			],
			'upgrade_url' => Config::get('app.upgrade_app_site') . "user_id={$this->user->practice_pro_user->mh2_id}&app_name=incorporationpro&level="       
		);
		
		$this->layout->content = View::make("user.upgrade", $data);
	}
	
	public function cancelPayment()
	{
		return Redirect::to("summary/{$this->business_id}/")->withInput();
	}

	public function completePayment()
	{
		$user = $this->user->practice_pro_user;
		// Send email to the user
		Mail::send('emails.upgrade_success', ['user' => $user], function($message) use ($user)
		{
			$from = Config::get('mail.from');
			$message->to(
				$user->mh2_email, 
				sprintf("%s %s", $user->mh2_fname, $user->mh2_lname)
			)->subject('Practice Pro Membership Upgrade');
			
			$message->from($from['address'], $from['name']);
		});

		// send email to practicepro admin
		Mail::send('emails.upgrade_member_reminder', ['user' => $user], function($message)  use ($user)
		{ 
			$from = Config::get('mail.from');
			$to   = Config::get('mail.admin_email');

			$message->to($to['address'], $to['name'])->subject('Membership Upgrade!');
			$message->from($from['address'], $from['name']);
		});
		return Redirect::to("report/incorporation/{$this->business_id}");
	}

}
