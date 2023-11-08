<?php

use Illuminate\Support\Facades\Config;
use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian;


test('testing generate pin len is 6', function ()
{

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	expect(strlen($pin))->toBe(6);

});

test('testing generate pin len is 10', function ()
{

	Config::set('alphapin-profile-guardian.pin_length', 10);
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	expect(strlen($pin))->toBe(10);

});

test('testing generate pin_case is lowercase', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	expect($pin)->toBe(strtolower($pin));
	$pin = str_replace(range(0, 9), '', $pin);
	expect($pin)->toBe(strtolower($pin));

});

test('testing generate pin_case is numeric verifyMinimumChar', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'numeric');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = "1234";
	$result = $alphapinProfileGuardian->verifyMinimumChar($pin);
	expect($result)->toBe($pin);

});

test('testing generate pin_case is numeric mixed verifyMinimumChar', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = "UEPH";
	$result = $alphapinProfileGuardian->verifyMinimumChar($pin);

	expect(preg_match('/[A-Z]/', $result))->toBe(1);
	expect(preg_match('/[0-9]/', $result))->toBe(1);

});



test('testing generate pin_case is lowercase verifyMinimumChar', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = "2333";
	$result = $alphapinProfileGuardian->verifyMinimumChar($pin);
	print_r($result);
	expect(preg_match('/[0-9]/', $result))->toBe(1);

	Config::set('alphapin-profile-guardian.pin_type', 'alpha');
	$pin = "abcd";
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$result = $alphapinProfileGuardian->verifyMinimumChar($pin);

	expect(preg_match('/[a-z]/', $result))->toBe(1);
	expect(preg_match('/[0-9]/', $result))->toBe(0);

});

test('testing generate pin_case is lowercase verifyMinimumChar alpha', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();

	$pin = "2333";
	$result = $alphapinProfileGuardian->verifyMinimumChar($pin);
	expect(preg_match('/[0-9]/', $result))->toBe(1);

	$pin = "abcd";
	$result = $alphapinProfileGuardian->verifyMinimumChar($pin);
	expect(preg_match('/[0-9]/', $result))->toBe(0);


});

test('testing generate pin_case is alpha numeric lowercase', function () {

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();

	// pin should have at least one number and one letter
	expect(preg_match('/[a-z]/', $pin))->toBe(1);
	expect(preg_match('/[0-9]/', $pin))->toBe(1);

});

// @todo testig this
test('testing generate pin_case is alpha numeric uppercase', function () {

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'upper');
	Config::set('alphapin-profile-guardian.pin_length', 2);

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	print_r($pin);
	// pin should have at least one number and one letter
	expect(preg_match('/[A-Z]/', $pin))->toBe(1);
	expect(preg_match('/[0-9]/', $pin))->toBe(1);

});

test('testing generate pin_case is special chars', function () {

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'mixed');
	Config::set('alphapin-profile-guardian.use_special_chars', true);
	Config::set('alphapin-profile-guardian.pin_length', 4);

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	// pin should have at least one number and one letter
	expect(preg_match('/[a-z]/', $pin))->toBe(1);
	expect(preg_match('/[A-Z]/', $pin))->toBe(1);
	expect(preg_match('/[0-9]/', $pin))->toBe(1);
	expect(preg_match('/[!@#$%^&*()_\-+=\[\]{};:,.<>?]/', $pin))->toBe(1);

});

//	'pin_type' => 'numeric', // numeric, alpha, alpha_numeric
// 	'pin_length' => 6,
// 	'pin_case' => 'lower', // lower, upper, mixed
// 	'use_special_chars' => false,
// 	'use_additional_chars' => false,
// 	'additional_chars_list' => '.,;:!?', // you can add more special chars here
// 	'enable_special_chars_repeat' => false,