<?php

namespace PHPDominicana\AlphapinProfileGuardian;

class AlphapinProfileGuardian
{

	private $pinChars = [
		'numeric_chars' => '0123456789',
		'alpha_chars' => 'abcdefghijklmnopqrstuvwxyz',
		'alpha_numeric_chars' => 'abcdefghijklmnopqrstuvwxyz0123456789',
		'pin_special_chars' => '!@#$%^&*()_-=+{}[]'
	];
	protected $pinType;
	protected $pinLength;
	protected $enableSpecialCharsRepeat;
	protected $useSpecialChars;
	protected $pinCase;

	/**
	 *
	 */
	public function __construct()
	{
		$this->pinType = config('alphapin-profile-guardian.pin_type');
		$this->pinLength = config('alphapin-profile-guardian.pin_length');
		$this->pinCase = config('alphapin-profile-guardian.pinLength');
		$this->useSpecialChars = config('alphapin-profile-guardian.use_special_chars');
		$this->enableSpecialCharsRepeat = config('alphapin-profile-guardian.enable_special_chars_repeat');

	}

	/**
	 * Generate a PIN
	 *
	 * @return void
	 */
	public function generatePIN()
	{

		// read from config and generate the PIN
		// return the PIN

	}

}
