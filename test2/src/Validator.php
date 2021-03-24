<?php
namespace Brryfrmnn\Test2;

use PhpOffice\PhpSpreadsheet\IOFactory;

class Validator
{

	/**
	 * General Rules 
	 *
	 * @param array  $data   The data
	 *
	 * @return array
	 */
	public function rulesType(array $data)
	{
		$rules = [
			'A' => '*',
			'B' => '#',
			'C' => '',
			'D' => '*',
			'E' => '*',
		];
		$errors = [];
		
		if (count($data) > 0) {
			$data = reset($data);
			// $test = substr($data['A'], -1);
			
			// echo "<pre>" . var_dump($test) ."</pre>";
			if (count($data) > 5) {
				$errors[] = 'file should only contains 5 columns or less';
			}
			foreach ($rules as $key => $rule) {
				if (isset($data[$key])) {
					if ($rule == '*') {
						if (substr($data[$key], -1) != $rule) {
							$errors[] = 'Format Column ' . $data[$key] . ' not correct';
						}
					} else if ($rule == '#') {
						if (substr($data[$key], 0, 1) != $rule) {
							$errors[] = 'Format Column ' . $data[$key] . ' not correct';
						}
					} else {
						if (substr($data[$key], 0, 1) == '#' || substr($data[$key], -1) == '*') {
							$errors[] = 'Format Column ' . $data[$key] . ' not correct';
						}
					}
				}
			}
		} else {
			$error['errors'] = "No Data Available";
		}
		return $errors;
	}
	

	public static function test()
	{
		return "Success ";
	}


	/**
	 * Starts a read.
	 *
	 * @param      file  $file   The file
	 *
	 * @return     array
	 */
	public function make($data)
	{
		$extention = $this->extention($data);
		if (!$extention) return 'Just except xls and xlsx';

		$excel = IOFactory::load($data);
		$excel = $excel->getActiveSheet()->toArray(null, true, true, true);
		return $excel;
	}


	/**
	 * Validation Data
	 *
	 * @param      array  $data   The data
	 *
	 * @return     array
	 */
	public function validate(array $data)
	{
		$header = $this->rulesType($data);
		if (!empty($header)) return $header;
		$errors = [];
		$headers = reset($data);
		unset($data[1]); //remove header
		foreach ($data as $key => $items) {
			foreach ($items as $i => $item) {
				if (strpos($headers[$i], '*') !== false) {
					if (!$item) {
						$errors[$key][] = 'Missing value in ' . $headers[$i];
					}
				} else if (strpos($headers[$i], '#') !== false) {
					if ($this->noSpaces($item)) {
						$errors[$key][] = $headers[$i] . ' should not contain any space';
					}
				}
			}
		}

		return $errors;
	}

	/**
	 * 
	 *
	 * @param  string  $val 
	 *
	 * @return boolean
	 */
	public function noSpaces($val)
	{
		return preg_match("/\s/", $val);
	}

	/**
	 * Extention
	 *
	 * @param $data is file data
	 *
	 * @return boolean
	 */
	public function extention($data)
	{
		$extention = pathinfo($data);
		if ($extention['extension'] == 'xls' || $extention['extension'] == 'xlsx') {
			$status = true;
		} else {
			$status = false;
		}

		return $status;
	}
}
