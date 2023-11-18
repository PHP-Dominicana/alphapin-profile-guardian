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

test('testing generate pin_case is numeric mixed verifyMinimumChar', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$result = $alphapinProfileGuardian->generatePIN();
	expect(preg_match('/[A-Z]/', $result))->toBe(0);
	expect(preg_match('/[a-z]/', $result))->toBe(1);
	expect(preg_match('/[0-9]/', $result))->toBe(1);

});


test('testing generate pin_case is lowercase verifyMinimumChar', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$result = $alphapinProfileGuardian->generatePIN();
	expect(preg_match('/[a-z]/', $result))->toBe(0);

	Config::set('alphapin-profile-guardian.pin_type', 'alpha');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$result = $alphapinProfileGuardian->generatePIN();
	expect(preg_match('/[a-z]/', $result))->toBe(1);
	expect(preg_match('/[0-9]/', $result))->toBe(0);

});

test('testing generate pin_case is lowercase verifyMinimumChar alpha', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$result = $alphapinProfileGuardian->generatePIN();
	expect(preg_match('/[0-9]/', $result))->toBe(0);

});
test('testing generate pin_case is alpha numeric lowercase', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'lower');
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();

	// pin should have at least one number and one letter
	expect(preg_match('/[a-z]/', $pin))->toBe(1);
	expect(preg_match('/[0-9]/', $pin))->toBe(1);

});


test('testing generate pin_case is alpha numeric uppercase', function ($range)
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'upper');
	Config::set('alphapin-profile-guardian.pin_length', 4);

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	expect(preg_match('/[A-Z]/', $pin))->toBe(1);
	expect(preg_match('/[0-9]/', $pin))->toBe(1);

})->with('range');

// @todo testig this
test('testing generate pin_case have use_special_chars and numeric ', function ($range)
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.use_special_chars', true);
	Config::set('alphapin-profile-guardian.pin_case', 'upper');
	Config::set('alphapin-profile-guardian.pin_length', 4);

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	expect(preg_match('/[A-Z]/', $pin))->toBe(1);
	expect(preg_match('/[0-9]/', $pin))->toBe(1);

})->with('range');

dataset('range', range(0, 200));

test('testing generate pin_case is special chars', function ()
{

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


test('testing generate pin_case is use_additional_chars', function ()
{

	Config::set('alphapin-profile-guardian.pin_type', 'alpha_numeric');
	Config::set('alphapin-profile-guardian.pin_case', 'mixed');
	Config::set('alphapin-profile-guardian.use_additional_chars', true);
	Config::set('alphapin-profile-guardian.additional_chars', "=");
	Config::set('alphapin-profile-guardian.pin_length', 4);

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	// pin should have at least one number and one letter
	expect(preg_match('/[a-z]/', $pin))->toBe(1);
	expect(preg_match('/[A-Z]/', $pin))->toBe(1);
	expect(preg_match('/[0-9]/', $pin))->toBe(1);
	expect(preg_match('/[!@#$%^&*()_\-+=\[\]{};:,.<>?]/', $pin))->toBe(1);

})->with('range');
