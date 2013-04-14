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

}