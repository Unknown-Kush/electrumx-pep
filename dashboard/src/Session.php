<?php

namespace App;

class Session{	
	public $id; // int
	public $ip; // string
	public $ipv6; // bool
	public $flag; // string
	public $ssl = FALSE; // bool
	public $trafficOut; // int (KB)
	public $trafficIn; // int (KB)
	public $trafficTotal; // int (KB)
	public $messagesRec; // int
	public $messagesSen; // int
	public $ageHours; // int (hours)
	public $age; // int (seconds)
	public $client; // int
	public $protocol; // bool
	public $requestsC; // bool
	public $txsC; // bool
	public $subscriptionsC; // bool
	public $country; // string
	public $countryCode; // string
	public $isp; // string
	public $hosted; // bool
	public $traffic;
	public $city;
	
	function __construct($session) {
		$this->id = checkInt($session[0]);
		$this->flag = htmlspecialchars($session[1]);
		if(substr($this->flag, 0, 1) == "S"){
			$this->ssl = TRUE;
		}
		$this->ip = getCleanIP($session[2]);
		$this->ipv6 = checkIfIpv6($this->ip);
		$this->client = str_replace("electrum/", "Electrum ", htmlspecialchars($session[3]));
		$this->protocol = htmlspecialchars($session[4]);
		$this->txsC = checkInt($session[8]);
		$this->subscriptionsC = checkInt($session[9]);
		$this->messagesRec = checkInt($session[10]);
		$this->trafficIn = bytesToMb($session[11]);
		$this->messagesSen = checkInt($session[12]);
		$this->trafficOut = bytesToMb($session[13]);
		$this->traffic = $this->trafficOut + $this->trafficIn;
		$this->age = round(checkInt($session[14]));
		$this->ageHours = round($this->age/3600,1);
	}			
}
?>
