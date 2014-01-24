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
			if (!is_null($chart->getTitle())) {
				$caption = '"' . implode(' ',$chart->getTitle()->getCaption()) . '"';
			} else {
				$caption = "Untitled{$i}";
			}
			
			$asset_path = "/cache/{$caption}.jpg";
			$jpegFile = public_path() . $asset_path;
			$chart->render($jpegFile);
			$this->data[$caption] = $asset_path;
		}
	}

}
