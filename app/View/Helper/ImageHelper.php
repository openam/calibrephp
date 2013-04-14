<?php
/**
 * Image Helper
 */
class ImageHelper extends AppHelper {

/**
 * Helpers used by this helper
 *
 * @var array
 */
	public $helpers = array(
		'Html',
	);

/**
 * resizeSettings
 *
 * @var array
 */
	public $resizeSettings = array(
		'index' => array(
			'w'     => 70,
			'h'     => 100,
			'scale' => true
		),
		'view' => array(
			'w'     => 100,
			'h'     => 150,
			'scale' => true
		),
		'fancybox' => array(
			'w'     => 500,
			'h'     => 500,
			'scale' => true
		)
	);

/**
 * Default Calibre path used
 *
 * @todo I need to change this somehow so that the calibre-library doesn't need to be symlinked into the webroot/ directory
 * @var array
 */
	public $calibrePath = 'calibre-library/';

/**
 * resizeUrl method
 *
 * @param string $bookPath the controller that you want to check
 * @param array $resizeSettings settings for the resizer
 * @return string $resizedUrl the url of the cached and resized image
 */
	public function resizeUrl($bookPath, $resizeSettings = array(), $fullUrl = false) {
		if (empty($bookPath)) {
			throw new NotFoundException(__('Invalid path'));
		}

		return $this->Html->url('/' . resize($this->calibrePath . $bookPath . '/cover.jpg', $resizeSettings), $fullUrl);
	}

/**
 * thumbnail
 *
 * @param string $bookPath the controller that you want to check
 * @param mixed $resizeInfo array settings for the resizer, or string for preset settings
 * @return string $resizedUrl the url of the cached and resized image
 */
	public function thumbnail($bookPath, $resizeInfo = array()) {
		if (empty($bookPath)) {
			throw new NotFoundException(__('Invalid path'));
		}
		if (is_string($resizeInfo)) {
			$resizeSettings = $this->resizeSettings[$resizeInfo];
		} else {
			$resizeSettings = $resizeInfo;
		}

		return '<img class="img-rounded pull-left cover" src="'. $this->resizeUrl($bookPath, $resizeSettings) . '">';
	}

}