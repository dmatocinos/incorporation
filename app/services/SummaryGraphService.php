<?php

class SummaryGraphService extends IncorporationEngine {

	protected function init()
	{
		$rendererName = PHPExcel_Settings::CHART_RENDERER_JPGRAPH;
		$rendererLibraryPath = app_path() . '/../vendor/jpgraph';

		if ( ! PHPExcel_Settings::setChartRenderer(
			$rendererName,
			$rendererLibraryPath
		)) {
			die(
				'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
				'<br>' .
				'at the top of this script as appropriate for your directory structure'
			);
		}
		
		$worksheet = $this->getActiveSheet();
		$chartNames = $worksheet->getChartNames();
		foreach ($chartNames as $i => $chartName) {
			$asset_path = sprintf("/cache/%s_%s_%s.jpg", Auth::user()->id, $this->business->id, $i);
			$jpegFile = public_path() . $asset_path;
			
			if (file_exists($jpegFile))  {
				// delete graph image
				unlink($jpegFile);
			}

			$chart = $worksheet->getChartByName($chartName);
			$chart = $worksheet->getChartByName($chartName);
			$chart->render($jpegFile);
			$this->data[] = $asset_path;
		}
	}

}
