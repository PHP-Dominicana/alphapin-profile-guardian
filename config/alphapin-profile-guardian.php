<?php

// config for PHPDominicana/AlphapinProfileGuardian
return [

	'pin_type' => 'numeric', // numeric, alpha, alpha_numeric
	'pin_length' => 6,
	'pin_case' => 'lower', // lower, upper, mixed
	'use_special_chars' => false,
	'pin_additional_special_chars_list' => '.,;:!?', // you can add more special chars here
	'enable_special_chars_repeat' => false,

];
