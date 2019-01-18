<?php
/**
 * This is a simple PHP class for scoring MPesa transactions.
 * 
 * @package Mpesa Transactions Sorting
 * @license http://mit.com/licence MIT LICENCE
 * @author Maurice Wagura <wagura465@gmail.com>
 */

class Mpesa {

	/**
	 * The common part of scoring MPesa transactions.
	 * @var string $BASELINE
	 */
	private $BASELINE;

	/**
	 * The common part of scoring MPesa transactions.
	 * @var string $DEPOSIT
	 */
	private $DEPOSIT;

	/**
	 * The common part of scoring MPesa transactions.
	 * @var string $WITHDRAWAL
	 */
	private $WITHDRAWAL;

	/**
	 * The common part of scoring MPesa transactions.
	 * @var string $PAYBILL_TILL
	 */
	private $PAYBILL_TILL;

	/**
	 * The common part of scoring MPesa transactions.
	 * @var string $AIRTIME
	 */
	private $AIRTIME;

	public function __construct(){
		$this->BASELINE = 0;
		$this->DEPOSIT = +10;
		$this->WITHDRAWAL = -5;
		$this->PAYBILL_TILL = +2;
		$this->AIRTIME = -1;
	}

	/**
	 * 
	 * Handles filreting data in arry
	 * 
	 * @param array $haystack
	 * @param array $needle
	 * @param int $offset
	 * @return boolean of true or false.
	 * @throws exception if the params are invalid.
	 */

	private function filter_data($haystack, $needle, $offset=0) {
	    if (!is_array($needle)) $needle = array($needle);
	    foreach ($needle as $query) {
	        if (strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	    }
	    return false;
	}

	public function test($value) {
		return strtoupper($value);
	}

	public function getScore($ARRAY_DATA) {
		foreach ($ARRAY_DATA as $key => $value) {

			$ARRAY_DATA[$key]['score'] = $BASELINE; // set baseline before looping through the data.

			if ($value['transaction'] >= 0) { // checnking for positive transactions i.e deposites
				$ARRAY_DATA[$key]['score'] = $DEPOSIT;
			}

			if ($this->filter_data($value['description'], array('Customer Withdrawal'))) { // checking for customer withdrawals
				$ARRAY_DATA[$key]['score'] = $WITHDRAWAL;
			}

			if ($this->filter_data($value['description'], array('Merchant Payment', 'Pay Bill to'))) { // checking for customer payments to paybills an marchant tills
				$ARRAY_DATA[$key]['score'] = $PAYBILL_TILL;
			}

			if ($this->filter_data($value['description'], array('Airtime Purchase'))) { // checking for customer airtime purchases
				$ARRAY_DATA[$key]['score'] = $AIRTIME;
			}
		}

		return json_encode($ARRAY_DATA);
	}

}