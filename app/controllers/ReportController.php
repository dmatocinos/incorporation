<?php

class ReportController extends AuthorizedController {

	public function incorporation()
	{
		$report = new IncorporationReport($this->business, $this->user);
		$report->toPdf();
	}

}
