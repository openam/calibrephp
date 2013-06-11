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
		'Number',
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
			'w'     => 115,
			'h'     => 165,
			'scale' => true
		),
		'opds' => array(
			'w'     => 210,
			'h'     => 300,
			'scale' => true
		),
		'fancybox' => array(
			'w'     => 500,
			'h'     => 500,
			'scale' => true
		)
	);

/**
 * getCalibrePath method
 * @return string with path to calibre location
 */
	public function getCalibrePath() {
		return Configure::read('Settings.Default.CalibrePath') . "/";
	}

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

		if (is_string($resizeSettings)) {
			$resizeSettings = $this->resizeSettings[$resizeSettings];
		}

        $imagePath = $this->getCalibrePath() . $bookPath . '/cover.jpg';
        $resizePath = resize($imagePath, $resizeSettings);

        if($resizePath && $resizePath != "image not found")
        {
            return $this->Html->url('/' . resize($imagePath, $resizeSettings), $fullUrl);
        }
        else
        {
            return null;
        }
	}

/**
 * thumbnail
 *
 * @param string $bookPath the controller that you want to check
 * @param mixed $resizeSettings array settings for the resizer, or string for preset settings
 * @return string $resizedUrl the url of the cached and resized image
 */
	public function thumbnail($bookPath, $resizeSettings = array()) {
		if (empty($bookPath)) {
			throw new NotFoundException(__('Invalid path'));
		}

		return '<img class="img-rounded pull-left cover" src="'. $this->resizeUrl($bookPath, $resizeSettings) . '">';
	}

/**
 * ebookLinks
 *
 * @param array $files to provide links for
 * @return string a string with the links to all the book formats items
 */
	public function ebookLinks($files = array(), $divClass = 'btn-toolbar') {
		$links = '';

        // Downloads links
        $downloadLinks = array();
        foreach($files as $key => $file) {
            $downloadLinks[] = '<li>' . $this->Html->link($file['format'], array(
                'controller' => 'books',
                'action' => 'download',
                $file['book'],
                strtolower($file['format']),
            ), array(
                'title' => $this->Number->toReadableSize($file['uncompressed_size']),
            )) . '</li>';
        }
        if(count($downloadLinks) > 0)
        {
            $links .= '<div class="btn-group">';
            $links .= '<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-download"></i> ' . __("Download") . ' <span class="caret"></span></button>';
            $links .= '<ul class="dropdown-menu">' . implode("", $downloadLinks) . '</ul>';
            $links .= '</div> ';
        }

        // E-Mail / Share
        $formats = array();
        foreach($files as $file)
        {
            $formats[$file['format']] = $file['format'];
        }
        $emailTargets = array();
        foreach($this->getShareConfig() as $email => $emailFormats)
        {
            $emailFormats = (array)explode(",", strtoupper($emailFormats));
            foreach($emailFormats as $format)
            {
                if(isset($formats[$format]))
                {
                    $emailTargets[$email] = $format;
                    continue 2;
                }
            }
        }
        $shareLinks = array();
        foreach($emailTargets as $email => $format)
        {
            $url = $this->Html->url(array(
                'controller' => 'books',
                'action' => 'share',
                $files[0]['book'],
                $email,
                $format));
            $shareLinks[] = '<li><a href="#" class="calibre-share" data-share-url="' . $url . '">' . $email . '</a></li>';
        }
        if($shareLinks > 0)
        {
            $links .= '<div class="btn-group">';
            $links .= '<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope icon-white"></i> ' . __("Share") . ' <span class="caret"></span></button>';
            $links .= '<ul class="dropdown-menu">' . implode("", $shareLinks) . '</ul>';
            $links .= '</div>';
        }

        if($links)
        {
            return '<div class="' . $divClass . '">' . $links . '</div>';
        }
        else
        {
            return '';
        }
	}

/**
 * Reads all e-mail targets from share-config.
 *
 * @return array
 */
    public function getShareConfig() {
        return (array)Configure::read('Settings.share');
    }

/**
 * fancybox
 *
 * @param array $book an array with the book information in it, specifically 'path' and 'has_cover' are required
 * @param array $options array('thumbnail' => 'index', 'large' => 'fancybox', 'class' => 'fancybox', 'group' => 'gallery')
 * @return string with the thumbnail and the link to the large image.
 */
	public function fancybox($book = array(), $options = array()) {
		$defaultOptions = array(
			'thumbnail' => 'index',
			'large'     => 'fancybox',
			'class'     => 'fancybox',
			'group'     => 'gallery'
		);
		$options = array_merge($defaultOptions, $options);

		$string = '';

		if ($book['has_cover']) {
            $resizeUrl = $this->resizeUrl($book['path'], $options['large']);

            if($resizeUrl) {
                $string .= '<a class="' . $options['class'] . '" href="' . $resizeUrl . '" data-fancybox-group="' . $options['group'] . '" title="' . $book['sort'] . '">';
                $string .= $this->thumbnail($book['path'], $options['thumbnail']);
                $string .= '</a>';
            } else {
                $string .= '<span class="img-rounded pull-left cover">No Cover</span>';
            }
		} else {
			$string .= '<span class="img-rounded pull-left cover">No Cover</span>';
		}

		return $string;
	}

/**
 * fancyboxJs
 *
 * @param array $class the name of the class to apply fancybox to
 * @param array $helpers array('title' => null) an array of helpers
 * @return string with javastript
 */
	public function fancyboxJs($class = 'fancybox', $helpers = array('title' => null)) {

		$string = '<script type="text/javascript">' . "\r\n";
		$string .= '	$(document).ready(function() {' . "\r\n";
		$string .= '		$(".' . $class .'").fancybox({' . "\r\n";
		$string .= '			helpers:' . json_encode($helpers) . "\r\n";
		$string .= '		});' . "\r\n";
		$string .= '	});' . "\r\n";
		$string .= '</script>' . "\r\n";

		return $string;
	}
}
