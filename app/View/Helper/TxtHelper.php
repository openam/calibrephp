<?php
if (!class_exists('TextHelper')) {
	App::import('Helper', 'Text');
}
/**
 * Txt Helper
 */
class TxtHelper extends TextHelper {

/**
 * activeIndex method
 *
 * @param string $value the controller that you want to check
 * @return string class="active" or '' depending on if it's active
 */
	public function activeIndex($value = null) {
		$controller = $this->request->params['controller'];
		$action     = (isset($this->request->params['action']) ? $this->request->params['action'] : '');
		$firstPass  = (isset($this->request->params['pass']['0']) ? $this->request->params['pass']['0'] : '');

		if ($controller == $value && ($action == 'index' || $action == '')) {
			return ' class="active"';
		} else {
			return '';
		}
	}

/**
 * Generates the overview information
 *
 * @param  array $options label, text, alternateText, before, after
 * @return string
 */
	public function definition($options = array()) {
		$defaultOptions = array(
			'label'          => '',
			'text'           => '',
			'alternateText'  => '',
			'before'         => '',
			'after'          => '',
			'htmlAttributes' => array()
		);

		if (count($options) == 1) {
			$temp    = $options;
			$options = array();
			foreach ($temp as $key => $value) {
				$options['label'] = $key;
				$options['text']  = $value;
			}
		}

		$options = array_merge($defaultOptions, $options);

		$htmlAttributes = '';
		foreach ($options['htmlAttributes'] as $key => $value) {
			$htmlAttributes .= ' ' . $key . '="' . $value . '"' ;
		}

		if (!empty($options['text']) && !empty($options['label'])) {
			if (!empty($options['alternateText'])) {
				$options['text'] = $options['alternateText'];
			}

			$text = "<div><span class='definition'$htmlAttributes>" . $options['label'] . "</span><span$htmlAttributes>";
			$text .= $options['before'] . $options['text'] . $options['after'] . '</span></div>';

			return $text;
		} else {
			return false;
		}
	}

/**
 * habtmLinks
 *
 * @param array $values the controller that you want to check
 * @param string $model the model to link to
 * @return string with the links to all the HABTM items
 */
	public function habtmLinks($values = array(), $model = "") {
		$links     = '';
		$separator = '';
		foreach ($values as $key => $value) {
			if (isset($value['sort'])) {
				$displayName = $value['sort'];
			} else {
				$displayName = $value['name'];
			}
			$links .= $separator . $this->Html->link($displayName, array('controller' => $model, 'action' => 'view', $value['id']));
			$separator = ', ';
		}
		return $links;
	}

/**
 * rating
 *
 * @param mixed $values or a single value
 * @return string a string with the links to all the HABTM items
 */
	public function rating($values = array(), $zero = false) {
		$links     = '';
		if (is_array($values)) {
			foreach ($values as $key => $value) {
				if ($value['rating'] != 0 || $zero) {
					$displayName = $this->stars($value['rating'] / 2);
					$links .= $this->Html->link($displayName, array('controller' => 'ratings', 'action' => 'view', $value['id']), array('escape' => false));
				}
			}
		} else {
			$links = $this->Html->link($this->stars($values / 2), array('controller' => 'ratings', 'action' => 'view', $value['id']), array('escape' => false));
		}
		return $links;
	}

/**
 * stars
 *
 * @param integer $value
 * @param integer $possible stars available
 * @return string
 */
	public function stars($value, $possible = 5) {
		if ($value > $possible) {
			throw new CakeException("Invalid use of TxtHelper::stars()");
		}
		$stars = str_repeat('&#9733;', $value);
		$stars .= str_repeat('&#9734;', $possible - $value);
		return $stars;
	}


/**
 * numberToWords method
 *
 * @link http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/
 * @param integer $number
 * @param boolean $includeNumber, eg twenty-two (22)
 * @return string
 */
	public function numberToWords($number, $includeNumber = false) {

		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'one',
			2                   => 'two',
			3                   => 'three',
			4                   => 'four',
			5                   => 'five',
			6                   => 'six',
			7                   => 'seven',
			8                   => 'eight',
			9                   => 'nine',
			10                  => 'ten',
			11                  => 'eleven',
			12                  => 'twelve',
			13                  => 'thirteen',
			14                  => 'fourteen',
			15                  => 'fifteen',
			16                  => 'sixteen',
			17                  => 'seventeen',
			18                  => 'eighteen',
			19                  => 'nineteen',
			20                  => 'twenty',
			30                  => 'thirty',
			40                  => 'fourty',
			50                  => 'fifty',
			60                  => 'sixty',
			70                  => 'seventy',
			80                  => 'eighty',
			90                  => 'ninety',
			100                 => 'hundred',
			1000                => 'thousand',
			1000000             => 'million',
			1000000000          => 'billion',
			1000000000000       => 'trillion',
			1000000000000000    => 'quadrillion',
			1000000000000000000 => 'quintillion'
		);

		if (!is_numeric($number)) {
			return false;
		}

		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'numberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . $this->numberToWords(abs($number));
		}

		$string = $fraction = null;

		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}

		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . $this->numberToWords($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = $this->numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= $this->numberToWords($remainder);
				}
				break;
		}

		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}

		if ($includeNumber) {
			return $string . " ($number)";
		} else {
			return $string;
		}
	}

}