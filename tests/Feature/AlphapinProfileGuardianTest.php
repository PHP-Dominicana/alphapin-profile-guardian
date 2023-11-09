<?php

use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian;

test('testing generate pin (feature)', function () {

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	print_r("This is your pin: " . $pin . "\n");
	expect(strlen($pin))->toBe(6);
});