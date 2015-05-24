<?php
class RocketWeb_CustomOptionValidator_Model_Validator_Type {
	const GROUP_OTHER = 'Other';
	const GROUP_COMMON = 'Common';
	const GROUP_NUMBERS = 'Numbers';
	const GROUP_LOCATION = 'Location/phone';
	const GROUP_TEXT = 'Text';
	const GROUP_CC_SSN = 'Credit Card Validation/SSN';
	
	const TYPE_TEXT = 'field';
	const TYPE_TEXT_AREA = 'area';
	const TYPE_FILE = 'file';
	const TYPE_DROP_DOWN = 'drop_down';
	const TYPE_CHECKBOX = 'checkbox';
	const TYPE_RADIO = 'radio';
	const TYPE_MULTI = 'multiple';
	const TYPE_DATE = 'date';
	const TYPE_DATE_TIME = 'date_time';
	const TYPE_TIME = 'time';
	
	
	public function getGroups() {
		return array(
			self::GROUP_COMMON,
			self::GROUP_TEXT,
			self::GROUP_NUMBERS,
			self::GROUP_LOCATION,
			self::GROUP_CC_SSN,
			self::GROUP_OTHER,
		);
	}
	
	
	public function getTypes() {
		return array(
			'validate-no-html-tags' =>		array(
												'group' => self::GROUP_OTHER,
												'title' => 'No html tags',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-number' => 			array(
												'group' => self::GROUP_NUMBERS,
												'title' => 'Number',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-number-range' =>		array(
												'group' => self::GROUP_NUMBERS,
												'title' => 'Number in range',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
												'extra' => array(
													'combined_prefix' => 1,
													'prefix' => 'number-range',
													'elements' => array(
														'n1' => array(
															'prefix' => 'number-range',
															'style' => 'width:30px',
															'label' => 'Min:',
															'required' => true
														),
														'n2' => array(
															'prefix' => 'number-range',
															'style' => 'width:30px',
															'label' => 'Max:',
															'required' => true
														)
													)
												)
											),
			'validate-digits' => 			array(
												'group' => self::GROUP_NUMBERS,
												'title' => 'Digits',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-digits-range' => 		array(
												'group' => self::GROUP_NUMBERS,
												'title' => 'Digits range',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
												'extra' => array(
													'combined_prefix' => 1,
													'prefix' => 'digits-range',
													'elements' => array(
														'n1' => array(
															'prefix' => 'digits-range',
															'style' => 'width:30px',
															'label' => 'Min:',
															'required' => true
														),
														'n2' => array(
															'prefix' => 'digits-range',
															'style' => 'width:30px',
															'label' => 'Max:',
															'required' => true
														)
													)
												)
											),
			'validate-alpha' => 			array(
												'group' => self::GROUP_TEXT,
												'title' => 'Letters only',
												'description' => 'Use letters only (a-z or A-Z) in this field',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-code' => 				array(
												'group' => self::GROUP_TEXT,
												'title' => 'Code',
												'description' => 'Use only letters (a-z), numbers (0-9) or underscore(_) in this field, first character should be a letter.',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-alphanum' => 			array(
												'group' => self::GROUP_TEXT,
												'title' => 'Alphanumeric',
												'description' => 'Use only letters (a-z or A-Z) or numbers (0-9) only in this field. No spaces or other characters are allowed.',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-alphanum-with-spaces'=> array(
												'group' => self::GROUP_TEXT,
												'title' => 'Alphanumeric with spaces',
												'description' => 'Use only letters (a-z or A-Z), numbers (0-9) or spaces only in this field.',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-street' => 			array(
												'group' => self::GROUP_LOCATION,
												'title' => 'Street address',
												'description' => 'Use only letters (a-z or A-Z) or numbers (0-9) or spaces and # only in this field.',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-phoneStrict' => 		array(
												'group' => self::GROUP_LOCATION,
												'title' => 'Strict phone validation',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-phoneLax' => 			array(
												'group' => self::GROUP_LOCATION,
												'title' => 'Lax phone validation',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-fax' => 				array(
												'group' => self::GROUP_LOCATION,
												'title' => 'Fax',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-date' => 				array(
												'group' => self::GROUP_COMMON,
												'title' => 'Date',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-email' => 			array(
												'group' => self::GROUP_COMMON,
												'title' => 'E-mail',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-emailSender' => 		array(
												'group' => self::GROUP_OTHER,
												'title' => 'E-mail sender',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-password' => 			array(
												'group' => self::GROUP_OTHER,
												'title' => 'Password',
												'description' => '6 or more characters, leading or trailing spaces will be ignored',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-url' => 				array(
												'group' => self::GROUP_OTHER,
												'title' => 'Url',
												'description' => 'valid URL, protocol is required (http://, https:// or ftp://)',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-clean-url' => 		array(
												'group' => self::GROUP_OTHER,
												'title' => 'Clean url',
												'description' => 'Valid URL, for example http://www.example.com or www.example.com',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-ssn' => 				array(
												'group' => self::GROUP_CC_SSN,
												'title' => 'Social Security Number',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-zip' => 				array(
												'group' => self::GROUP_LOCATION,
												'title' => 'US zip code',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-zip-international' => array(
												'group' => self::GROUP_LOCATION,
												'title' => 'International zip code',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-not-negative-number' => array(
												'group' => self::GROUP_NUMBERS,
												'title' => 'Non-negative number',
												'description' => 'zero or grater',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-greater-than-zero' => array(
												'group' => self::GROUP_NUMBERS,
												'title' => 'Positive number',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-cc-number' => 		array(
												'group' => self::GROUP_CC_SSN,
												'title' => 'Credit Card number',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-cc-exp' => 			array(
												'group' => self::GROUP_CC_SSN,
												'title' => 'Credit Card expiration date',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-cc-cvn' => 			array(
												'group' => self::GROUP_CC_SSN,
												'title' => 'Credit Card verification number',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
			'validate-length' => 			array(
												'group' => self::GROUP_COMMON,
												'title' => 'Required Length',
												'description' => 'You can leave the min or max fields empty if you do not require a minimum/maximum',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
												'extra' => array(
													'combined_prefix' => 0,
													'elements' => array(
														'n1' => array(
															'style' => 'width:30px',
															'label' => 'Min:',
															'prefix' => 'minimum-length'
														),
														'n2' => array(
															'style' => 'width:30px',
															'label' => 'Max:',
															'prefix' => 'maximum-length'
														)
													)
												)
											),
			'validate-percents' => 			array(
												'group' => self::GROUP_NUMBERS,
												'title' => 'Percent value',
												'description' => '',
												'for_types' => array(self::TYPE_TEXT,self::TYPE_TEXT_AREA),
											),
		);
	}
}
