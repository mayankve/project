<?php

return array(
/** set your paypal credential **/
'client_id' =>'AXTKU27p9FSNxrl7SEVbDD17OFEbNcT-S6rQe3P5RuFrTTcWybnKhADzA_eHxXdFTi38E_knFA68Pp9Y',
'secret' =>'EIJKlr0pEwyLZFbCmkEB5jQ2hcE63VoH26MiOBPG6Z2bpl5iH85nR9xdFUrqPGw1SZJpBEC3FqxgPFYS',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
	)
);