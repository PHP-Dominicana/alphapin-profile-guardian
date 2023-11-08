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
	protected $useAdditionalChars;
	protected $additionalCharsList;
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
		$this->useAdditionalChars = config('alphapin-profile-guardian.use_additional_chars');
		$this->additionalCharsList = config('alphapin-profile-guardian.additional_chars_list');
		$this->enableSpecialCharsRepeat = config('alphapin-profile-guardian.enable_special_chars_repeat');

	}

	/**
	 * Generate a PIN
	 *
	 * @return string
	 */
	public function generatePIN()
	{

		$chars = $this->pinChars[$this->pinType . '_chars'];

		if ($this->pinCase == 'upper' && $this->pinType == 'alpha') {
			$chars = strtoupper($chars);
		}

		if ($this->pinCase == 'mixed' && $this->pinType == 'alpha') {
			$chars = strtoupper($chars);
			$chars .= strtolower($chars);
		}

		if ($this->useSpecialChars) {
			$chars .= $this->pinChars['pin_special_chars'];
		}

		if ($this->useAdditionalChars) {
			$chars .= $this->additionalCharsList;
		}

		$pin = '';

		for ($i = 0; $i < $this->pinLength; $i++) {
			$pin .= $chars[rand(0, strlen($chars) - 1)];
		}

		return $pin;

		// read from config and generate the PIN
		// return the PIN

	}

}
