<?php

// config for PHPDominicana/AlphapinProfileGuardian
return [

	// General configuration
	'pin_type' => 'numeric', // numeric, alpha, alpha_numeric
	'pin_length' => 6,
	'pin_case' => 'lower', // lower, upper, mixed. this will be ignore if pin_type is numeric
	'use_special_chars' => false,
	'use_additional_chars' => false,
	'additional_chars_list' => '.,;:!?', // you can add more special chars here
	// Email configuration
	'mailer' => 'mailtrap', // mailtrap, smtp
	'logo' => 'logo.png',
	'email_title' => 'AlphaPIN Profile Guardian',
	'email_subtitle' => 'Email Subtitle',
	'email_preheader' => 'A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.',
	'email_body' => 'Tap the button below to confirm your email address. If you didn\'t create an account with Paste, you can safely delete this email.',
	'email_footer' => '',
	'email_permission' => 'You received this email because we received a request for [type_of_action] for your account. If you didn\'t request [type_of_action] you can safely delete this email',
	// SMS configuration
	'sms_text' => 'This is your PIN: %s',
	// PIN configuration
	'pin_expiration' => 5, // in minutes
	// Error messages
	'pin_expiration_text' => 'Your PIN has expired. Please request a new one.',
	'pin_expiration_error_code' => 100,
	'pin_not_found_text' => 'PIN not found. Please request a new one.',
	'pin_not_found_error_code' => 101,

];
