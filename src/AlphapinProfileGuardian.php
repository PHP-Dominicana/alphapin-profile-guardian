<?php

namespace PHPDominicana\AlphapinProfileGuardian;

class AlphapinProfileGuardian
{

	/**
	 * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
	 */
	private $pinType;
	private $pinLength;

	private $pinChars = [
		'numeric_chars' => '0123456789',
		'alpha_chars' => 'abcdefghijklmnopqrstuvwxyz',
		'alpha_numeric_chars' => 'abcdefghijklmnopqrstuvwxyz0123456789',
		'pin_special_chars' => '!@#$%^&*()_-=+{}[]'
	];
	/**
	 * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
	 */
	protected $enableSpecialCharsRepeat;
	/**
	 * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
	 */
	protected $useSpecialChars;
	/**
	 * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
	 */
	protected $pinCase;

	public function __construct()
	{
		$this->pinType = config('alphapin-profile-guardian.pin_type');
		$this->pinLength = config('alphapin-profile-guardian.pin_length');
		$this->pinCase = config('alphapin-profile-guardian.pinLength');
		$this->useSpecialChars = config('alphapin-profile-guardian.use_special_chars');
		$this->enableSpecialCharsRepeat = config('alphapin-profile-guardian.enable_special_chars_repeat');

	}

	public function generatePIN()
	{

		// read from config and generate the PIN
		// return the PIN

	}

}
