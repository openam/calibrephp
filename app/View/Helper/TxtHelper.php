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
 * @param integer $value
 * @param integer $possible stars available
 * @return string
 */
	public function stars($value, $possible = 5) {
		$stars = str_repeat('&#9733;', $value);
		$stars .= str_repeat('&#9734;', $possible - $value);
		return $stars;
	}

}