<?php

class ReportController extends AuthorizedController {

	public function incorporation()
	{
		$report = new IncorporationReport($this->business, $this->user);
		$report->toPdf();

		// update download_count		
		$user = Auth::user()->practice_pro_user;
		$user->admitDownload();
	}

}
