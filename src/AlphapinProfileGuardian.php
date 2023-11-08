<?php

namespace PHPDominicana\AlphapinProfileGuardian;

class AlphapinProfileGuardian
{

	const MIN_PIN_LENGTH = 4;

	/**
	 * @var array<string, string>
	 */
	private array $pinChars = [
		'numeric_chars' => '0123456789',
		'alpha_chars' => 'abcdefghijklmnopqrstuvwxyz',
		'alpha_numeric_chars' => 'abcdefghijklmnopqrstuvwxyz0123456789',
		'pin_special_chars' => '!@#$%^&*()_-=+{}[]'
	];
	protected string $pinType;
	protected string $pinLength;
	protected string $enableSpecialCharsRepeat;
	protected bool $useSpecialChars = false;
	protected bool $useAdditionalChars = false;
	protected string $additionalCharsList;
	protected string $pinCase;

	/**
	 *
	 */
	public function __construct()
	{

		$this->pinType = config('alphapin-profile-guardian.pin_type');
		$this->pinLength = config('alphapin-profile-guardian.pin_length');
		$this->pinCase = config('alphapin-profile-guardian.pin_case');
		$this->useSpecialChars = config('alphapin-profile-guardian.use_special_chars');
		$this->useAdditionalChars = config('alphapin-profile-guardian.use_additional_chars');
		$this->additionalCharsList = config('alphapin-profile-guardian.additional_chars_list');
		$this->enableSpecialCharsRepeat = config('alphapin-profile-guardian.enable_special_chars_repeat');

		$this->pinLength = ($this->pinLength < self::MIN_PIN_LENGTH) ? self::MIN_PIN_LENGTH : $this->pinLength;

	}

	/**
	 * Generate a PIN
	 *
	 * @return string
	 */
	public function generatePIN()
	: string
	{

		$chars = $this->pinChars[$this->pinType . '_chars'];

		if ($this->pinCase == 'upper') {
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
		print_r($chars);

		return $this->verifyMinimumChar($pin);

		// read from config and generate the PIN
		// return the PIN

	}

	/**
	 * Verify if the generated PIN has the minimum required chars
	 *
	 * @param string $pin
	 *
	 * @return string
	 */
	public function verifyMinimumChar(string $pin)
	: string {

		preg_match('/[a-z]/', $pin) ? $hasLowerLetter = true : $hasLowerLetter = false;
		preg_match('/[A-Z]/', $pin) ? $hasUpperLetter = true : $hasUpperLetter = false;
		preg_match('/[0-9]/', $pin) ? $hasNumber = true : $hasNumber = false;
		preg_match('/[!@#$%^&*()_\-+=\[\]{};:,.<>?]/', $pin) ? $hasSpecialChar = true : $hasSpecialChar = false;


		if ($this->pinType == 'numeric') {
			return $pin;
		}

		if ($this->pinType == 'alpha') {
			if ($hasLowerLetter && $this->pinCase == 'lower') {
				return $pin;
			}
			if ($hasUpperLetter && $this->pinCase == 'upper') {
				return $pin;
			}
		}

		if ($this->pinType == 'alpha_numeric' && $this->pinCase == 'lower') {
			if ($hasLowerLetter && $hasNumber) {
				return $pin;
			}
		}

		if ($this->pinType == 'alpha_numeric' && $this->pinCase == 'upper') {
			if ($hasUpperLetter && $hasNumber) {
				return $pin;
			}
		}

		if ($this->pinType == 'alpha_numeric' && $this->pinCase == 'mixed') {
			if ($hasUpperLetter && $hasLowerLetter && $hasNumber) {
				return $pin;
			}
		}

		if ($this->pinType == 'alpha_numeric' && !$hasNumber) {
			$chars = $this->pinChars['numeric_chars'];
			$newChar = $chars[rand(0, strlen($chars) - 1)];
			$pin[rand(0, strlen($pin) - 1)] = $newChar;
			echo "dont have number\n";
		}

		if ($this->pinCase == 'mixed') {
			$positionUpper = null;
			if (!$hasUpperLetter) {

				$chars = $this->pinChars['alpha_chars'];
				$positionLower = null;
				$chars = strtoupper($chars);
				$newChar = $chars[rand(0, strlen($chars) - 1)];
				$positionUpper = rand(0, strlen($pin) - 1);
				$pin[$positionUpper] = $newChar;

			}

			if (!$hasLowerLetter) {

				$chars = strtoupper($chars);
				$chars .= strtolower($chars);
				$newChar = $chars[rand(0, strlen($chars) - 1)];

				if ($positionUpper == null) {
					$positionLower = rand(0, strlen($pin) - 1);
				}

				$max = strlen($pin) - 1;
				while ($positionLower == $positionUpper) {
					$positionLower = rand(0, $max);
				}

				$pin[$positionLower] = $newChar;
			}
		}

		if ($this->useAdditionalChars && !$hasSpecialChar) {

			$chars = $this->pinChars['pin_special_chars'];
			$newChar = $chars[rand(0, strlen($chars) - 1)];
			$pin[rand(0, strlen($pin) - 1)] = $newChar;

		}

		return $pin;
		// @todo need clean up
		// private array $pinChars = [
		// 		'numeric_chars' => '0123456789',
		// 		'alpha_chars' => 'abcdefghijklmnopqrstuvwxyz',
		// 		'alpha_numeric_chars' => 'abcdefghijklmnopqrstuvwxyz0123456789',
		// 		'pin_special_chars' => '!@#$%^&*()_-=+{}[]'
		// 	];

		if ($this->pinCase == 'mixed') {

			if (!$hasUpperLetter) {

				$chars = $this->pinChars['alpha_chars'];
				$chars = strtoupper($chars);
				$newChar = $chars[rand(0, strlen($chars) - 1)];
				$positionUpper = rand(0, strlen($pin) - 1);
				$pin[$positionUpper] = $newChar;

			}

			if (!$hasLowerLetter) {

				$chars = $this->pinChars['alpha_chars'];
				$chars = strtolower($chars);
				$newChar = $chars[rand(0, strlen($chars) - 1)];
				$positionLower = rand(0, strlen($pin) - 1);
				$pin[$positionLower] = $newChar;

			}

			if (!$hasNumber) {

				$chars = $this->pinChars['numeric_chars'];
				$newChar = $chars[rand(0, strlen($chars) - 1)];
				$pin[rand(0, strlen($pin) - 1)] = $newChar;

			}
		}

		if (!$hasLowerLetter || !$hasUpperLetter) {
			$chars = $this->pinChars['alpha_chars'];
			$positionUpper = null;
			$positionLower = null;
			if ($this->pinCase == 'upper') {
				$chars = strtoupper($chars);
				$newChar = $chars[rand(0, strlen($chars) - 1)];
				$positionUpper = rand(0, strlen($pin) - 1);
				$pin[$positionUpper] = $newChar;
			}

		}

		if (($this->pinType == 'alpha_numeric' || $this->pinType == 'numeric') && !$hasNumber) {

			$chars = $this->pinChars['numeric_chars'];
			$newChar = $chars[rand(0, strlen($chars) - 1)];
			$pin[rand(0, strlen($pin) - 1)] = $newChar;
			echo "dont have number\n";
		}


		if ($this->useAdditionalChars && !$hasSpecialChar) {

			$chars = $this->pinChars['pin_special_chars'];
			$newChar = $chars[rand(0, strlen($chars) - 1)];
			$pin[rand(0, strlen($pin) - 1)] = $newChar;

			return $pin;
		}

		return $pin;
	}

}
