<?php

class SummaryGraphService extends IncorporationEngine {

	protected function init()
	{
		$rendererName = PHPExcel_Settings::CHART_RENDERER_JPGRAPH;
		$rendererLibraryPath = app_path() . '/../libraries/jpgraph/';

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
        
        $service2 = new SummaryComparisonService2($this->business);
		$comparison_data2 = $service2->getData();
        
        $total_tax_as_incorporated = $this->business->isPartnership() ? $comparison_data2['total_to_hmrc']['partnership_calculated'] : $comparison_data2['total_to_hmrc']['sole_trade_calculated'];
        $total_annual_tax_savings = ($this->business->isPartnership() ? $this->getCalculatedValue("H48") : $this->getCalculatedValue("H47")) - $total_tax_as_incorporated;
        $bpk_fee_first_year_only = $total_annual_tax_savings * ($this->business->fee_based_on_tax_saved / 100);
        
        // set value for total savings
        $this->setValue('H53', $total_annual_tax_savings);
        $this->setValue('H55', $bpk_fee_first_year_only);
        
        if ($this->business->isPartnership()) {
            $this->setValue('G37', $comparison_data2['net_in_pocket_total']['partnership_calculated']);
            
            $chartNames= array('chart8', 'chart9');
        }
        else {
            $this->setValue('E37', $comparison_data2['net_in_pocket']['sole_trade_calculated']);
            
            $chartNames= array('chart8', 'chart10');
        }
		
		$worksheet = $this->getActiveSheet();
		//$chartNames = $worksheet->getChartNames();
        //var_dump($chartNames);
        //die;
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
