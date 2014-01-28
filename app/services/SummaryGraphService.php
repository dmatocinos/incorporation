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
			$chart = $worksheet->getChartByName($chartName);
			$chart = $worksheet->getChartByName($chartName);
			
			// get unique file name
			$caption = sprintf("%s_%s", uniqid(), $i);
			
			$asset_path = "/cache/{$caption}.jpg";
			$jpegFile = public_path() . $asset_path;
			$chart->render($jpegFile);
			$this->data[$caption] = $asset_path;
		}
	}

}
