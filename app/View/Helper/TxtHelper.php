<?php
if (!class_exists('TextHelper')) {
	App::import('Helper', 'Text');
}
/**
 * Txt Helper
 */
class TxtHelper extends TextHelper {

/**
 * Helpers used by this helper
 *
 * @var array
 */
	public $helpers = array(
		'Html',
		'Number',
		'Paginator',
	);

/**
 * activeIndex method
 *
 * @param string $value the controller that you want to check
 * @param boolean $sub the all action that you want to check
 * @return string class="active" or '' depending on if it's active
 */
	public function activeIndex($value = null, $sub = false) {
		$controller = $this->request->params['controller'];
		$action     = (isset($this->request->params['action']) ? $this->request->params['action'] : '');
		$firstPass  = (isset($this->request->params['pass']['0']) ? $this->request->params['pass']['0'] : '');

		if ($controller == $value && ($action == 'index' || $action == '' || $action == 'search' || $sub === true)) {
			return ' class="active"';
		} else {
			return null;
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

			$text = "<dt>" . $options['label'] . '</dt>';
			$text .= "<dd>" . $options['before'] . $options['text'] . $options['after'] . '</dd>';

			return $text;
		} else {
			return false;
		}
	}


/**
 * Generates the overview information
 *
 * @return string
 */
	public function definitionStart($class = 'dl-horizontal') {
		return "<dl class='$class'>";
	}

/**
 * Generates the overview information
 *
 * @return string
 */
	public function definitionEnd() {
		return "</dl>";
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
 * @param boolean $html use html tags
 * @return string
 */
	public function stars($value, $possible = 5, $html = true) {
		if ($value > $possible) {
			throw new CakeException("Invalid use of TxtHelper::stars()");
		}

		$whole    = floor($value);
		$fraction = ceil($value - $whole);

        if ($html) {
            $stars = str_repeat('<i class="icon-star"></i> ', $whole);
            $stars .= str_repeat('<i class="icon-star-half-empty"></i> ', $fraction);
            $stars .= str_repeat('<i class="icon-star-empty"></i> ', $possible - $whole - $fraction);
        } else {
            $stars = __('%d Stars', $whole);
        }

		return $stars;
	}

/**
 * paginateSort
 *
 * @param integer $field
 * @param integer $title optional display title
 * @return string
 */
	public function paginateSort($field, $title = null) {
		$active = '';
		$icon   = '';

		if (empty($title)) {
			$title = Inflector::humanize($field);
		}

		if (!empty($this->params['named'])) {
			if (!empty($this->params['named']['sort']) && $this->params['named']['sort'] == $field) {
				$active = ' class="active"';

				if (strtolower($this->params['named']['direction']) == 'asc') {
					$icon = '<i class="icon-chevron-sign-up"></i> ';
				} else {
					$icon = '<i class="icon-chevron-sign-down"></i> ';
				}
			}
		}

		return "<li$active>" . $this->Paginator->sort($field, $icon . $title, array('escape' => false)) . "</li>";
	}

/**
 * identifiers
 * currently this only shows identifiers for Google, and ISBN
 *
 * @param array $identifiers
 * @return string
 */
	public function identifiers($identifiers = array()) {
		$data = '';
		foreach ($identifiers as $identifier) {
			$type  = strtolower($identifier['type']);
			$value = $identifier['val'];
			switch ($type) {
				case 'google':
					$type = Inflector::humanize($type);
					break;

				case 'goodreads':
					$type  = Inflector::humanize($type);
					$value = $this->Html->link($value, 'http://www.goodreads.com/book/show/' . $value);
					break;

				case 'isbn':
					$type = strtoupper($type);
					break;

				default:
					$value = '';
					break;
			}
			$data .= $this->definition(array(__($type) => $value));
		}
		return $data;
	}

/**
 * fileTypes
 *
 * @param array $files to provide links for
 * @return string a string with the links to all the book formats items
 */
	public function fileTypes($files = array()) {
		$links     = '';
		$separator = '';

		foreach ($files as $key => $file) {
			$links .= $separator . $this->Html->link($file['format'], array('controller' => 'formats', 'action' => 'view', $file['format']));
			$separator = ', ';
		}

		return $links;
	}

/**
 * searchByModels
 *
 * @param array $models to provide links for
 * @return string a string with the links for the different search options
 */
	public function searchByModels($models = array('Book', 'Author', 'Publisher', 'Series', 'Tag')) {
		sort($models);
		$links = '<ul class="nav nav-pills">';
		$links .= '	<li class="disabled"><a href="#">' . __('Search') . ':</a></li>';

		foreach ($models as $model) {
			$links .= '<li' . $this->activeIndex(Inflector::tableize($model)) . '>' . $this->Html->link($model,
				array_merge(
					array('controller' => Inflector::tableize($model), 'action' => 'search'),
					$this->request->params['named']
				)
			) . '</li>';
		}

		$links .= '</ul>';

		return $links;
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
