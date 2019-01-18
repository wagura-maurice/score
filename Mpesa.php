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
	 * Submit Request
	 * 
	 * Handles filreting data in arry
	 * 
	 * @param array $haystack The 
	 * @param json $data The data to POST to the endpoint $url
	 * @param json $data The data to POST to the endpoint $url
	 * @return boolean of true or false.
	 * @throws exception if the params are invalid.
	 */

	private function getScore($haystack, $needle, $offset=0) {
	    if (!is_array($needle)) $needle = array($needle);
	    foreach ($needle as $query) {
	        if (strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	    }
	    return false;
	}

}