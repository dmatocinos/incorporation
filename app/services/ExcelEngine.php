<?php 

/**
 * Calcuation engine for the Incorporation.
 *
 */
class ExcelEngine {

	/**
	 *
	 * @var PHPExcel
	 */
	protected $objPHPExcel;

	/**
	 * Create a new excel calculation engine
	 * for the business object
	 *
	 * @param  string $worksheet
	 * @param  string $excel_file
	 */
	public function __construct($worksheet, $excel_file = '/files/calc1.xlsx')
	{
		$this->objPHPExcel = $this->initEngine($excel_file, $worksheet);
		//PHPExcel_Calculation::getInstance($this->objPHPExcel)->setCalculationCacheEnabled(FALSE);
	}

	public function __destruct()
	{
		$this->objPHPExcel->disconnectWorksheets();
		PHPExcel_Calculation::getInstance($this->objPHPExcel)->clearCalculationCache();
		unset($this->objPHPExcel);
	}

	/**
	 * Initialize the PHPExcel object.
	 *
	 * @return PHPExcel
	 */
	protected function initEngine($excel_file, $worksheet)
	{
		$excel_file = storage_path() . $excel_file;
		$excel_format = 'Excel2007';
		$worksheet = $worksheet;

		$objReader = PHPExcel_IOFactory::createReader($excel_format); 
		$objReader->setIncludeCharts(TRUE);

        if ($worksheet) {
    		$objReader->setLoadSheetsOnly($worksheet);
        }
        else {
            $objReader->setLoadAllSheets();
        }

		//PHPExcel_Calculation::getInstance()->writeDebugLog = true;

		return $objReader->load($excel_file); 
	}

	/**
	 *
	 * @return  PHPExcel
	 */
	public function getEngine()
	{
		return $this->objPHPExcel;
	}

	public function getActiveSheet()
	{
		return $this->objPHPExcel->getActiveSheet();
	}

	/**
	 *
	 * @parma  string $cell
	 * @param  mixed  $value
	 * @return self
	 */
	public function setValue($cell, $value)
	{
		$this->objPHPExcel->getActiveSheet()->getCell($cell)->setValue($value); 

		return $this;
	}

	/**
	 *
	 * @return  mixed
	 */
	public function getFormattedValue($cell)
	{
		return $this->objPHPExcel->getActiveSheet()->getCell($cell)->getFormattedValue(); 
	}

	/**
	 *
	 * @return  mixed
	 */
	public function getCalculatedValue($cell)
	{
		return $this->objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue(); 
	}
    
    protected function formatNumberToDecimalPlaces($val, $places)
    {
        if (trim($val) == '0') {
            return $val;
        }
        
        $neg = substr($val, 0, 1) == '-' ? true : false;
        $val = $neg == true ? substr($val, 1) : $val;
        $val = str_replace(',', '', $val);
        $val = trim($val);
        $val = floatval($val);
        $val = number_format ($val, $places, ".", ",");
        
        return $neg ? ('- ' . $val) : $val;
    }
    
    protected function getFloatValFromString($val)
    {
        $neg = substr($val, 0, 1) == '-' ? true : false;
        $val = $neg == true ? substr($val, 1) : $val;
        $val = str_replace(',', '', $val);
        $val = trim($val);
        $val = floatval($val);
        
        return $neg ? ($val * -1) : $val;
    }

}
