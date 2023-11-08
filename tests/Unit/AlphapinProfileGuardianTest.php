<?php

use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian;

test('testing generate pin len 6', function () {

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	expect(strlen($pin))->toBe(6);
});