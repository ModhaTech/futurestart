<?php

return array(
/** set your paypal credential **/
// 'client_id' =>'AX-6kQY_CKrDk3Bo6l-Qzs9MVNN4suscDF3jOrmEQUT3lWZBk6c8yoSWPBo_mMyNKfxHI3t_13_mrLb-',
// 'secret' => 'EPfnnETNH3eh0sjPM_v5z1-kKgp7hohxdcdLCk4LKCG-I-Dh-H2iSOQ_I6lDzesCsgxjl_Z3RJsV4R7U',


// 'client_id' =>'AWQq0_C6M8uhR58McacFuWszM0Kr0HMkqbSB1brMGt-CNCF24oUx1g73_P6KGB0rzeHbuysmvi37qqf6',
// 'secret' => 'EL9IN5ij3tnona7Vf6zJ-3IGaroVD2Wwyyrnsb3weOz0hvRit7cu4uoo7mnbsmqy4H0e66XNg8BfZdIC',
'client_id' =>'ARH6EpN27BwJUcd192y8FLNAwKw02eb4nhcId56FhzqRmT1SNlFFDQE-xM2NPwd58dZ_SfPQTb4d3h7b',
'secret' => 'EFR_APwGseQIz7vx2E8FILV75lGneY4jrj3TSIdKgqWGIdHDSoeD4ASvk-ZO1GDJSdI0MH90RqvQtuQb',
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
    ),
);