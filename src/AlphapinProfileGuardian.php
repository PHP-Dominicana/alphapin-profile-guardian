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
		'lower_alpha_chars' => 'abcdefghijklmnopqrstuvwxyz',
		'upper_alpha_chars' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		'pin_special_chars' => '!@#$%^&*()_-=+{}[]',
		'additional_chars' => '',
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
		$this->pinChars['additional_chars'] = config('alphapin-profile-guardian.additional_chars_list');

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

		// Initialize an array to track which types are included
		$includedTypes = [];
		$types = [];

		if ($this->pinType == 'numeric') {
			$types[] = 'numeric';
		}

		if ($this->pinType == 'alpha_numeric') {
			$types[] = 'numeric';
			if ($this->pinCase == 'lower') {
				$types[] = 'lower_alpha';
			}
			if ($this->pinCase == 'upper') {
				$types[] = 'upper_alpha';
			}
		}

		if ($this->pinType == 'alpha') {
			if ($this->pinCase == 'lower') {
				$types[] = 'lower_alpha';
			}
			if ($this->pinCase == 'upper') {
				$types[] = 'upper_alpha';
			}
		}

		if ($this->pinCase == 'mixed') {
			$types[] = 'lower_alpha';
			$types[] = 'upper_alpha';
		}

		if ($this->useAdditionalChars) {
			$types[] = 'additional_chars';
		}

		if ($this->useSpecialChars) {
			$types[] = 'pin_special';
		}

		$pin = '';
		// Generate a random character from each type
		// min length for the pin will be equal to the size of types selected
		foreach ($types as $type) {
			print_r($type);
			$chars = $this->pinChars[$type . '_chars'];
			$char = $chars[rand(0, strlen($chars) - 1)];
			$pin .= $char;
			$includedTypes[$type] = true;
		}

		$minLength = max($this->pinLength, count($types));


		// Fill the PIN to reach the minimum length, ensuring all types are included
		while (strlen($pin) < $minLength) {
			$missingTypes = array_diff($types, array_keys($includedTypes));

			if (count($missingTypes) > 1) {
				$type = $missingTypes[array_rand($missingTypes)];
			}
			$chars = $this->pinChars[$type . '_chars'];
			$char = $chars[rand(0, strlen($chars) - 1)];
			$pin .= $char;

			if (count($types) > 1) {
				$includedTypes[$type] = true;
			}
		}

		// Shuffle the PIN to randomize the order of characters
		$pinArray = str_split($pin);
		shuffle($pinArray);

		return implode('', $pinArray);

	}

}
