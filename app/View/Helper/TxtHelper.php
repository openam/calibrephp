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
		'Form',
		'Html',
		'Text'
	);

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

}