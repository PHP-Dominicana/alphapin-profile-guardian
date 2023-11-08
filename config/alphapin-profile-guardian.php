<?php

// config for PHPDominicana/AlphapinProfileGuardian
return [

	'pin_type' => 'numeric', // numeric, alpha, alphanumeric
	'pin_length' => 6,
	'pin_case' => 'lower', // lower, upper, mixed
	'pin_special_chars' => false,
	'pin_special_chars_list' => '!@#$%^&*()_-=+{}[]',
	'pin_special_chars_list_length' => 10,
	'pin_special_chars_list_case' => 'lower', // lower, upper, mixed
	'pin_special_chars_list_repeat' => false,
	'pin_special_chars_list_repeat_min' => 1,
	'pin_special_chars_list_repeat_max' => 2,

];
