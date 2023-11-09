<?php

// config for PHPDominicana/AlphapinProfileGuardian
return [

	'pin_type' => 'numeric', // numeric, alpha, alpha_numeric
	'pin_length' => 6,
	'pin_case' => 'lower', // lower, upper, mixed. this will be ignore if pin_type is numeric
	'use_special_chars' => false,
	'use_additional_chars' => false,
	'additional_chars_list' => '.,;:!?', // you can add more special chars here

];
