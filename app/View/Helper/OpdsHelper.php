<?php
/**
 * Opds Helper
 */
class OpdsHelper extends AppHelper {

/**
 * Helpers used by this helper
 *
 * @var array
 */
	public $helpers = array(
		'Html',
		'Image',
	);

/**
 * Default Calibre path used
 *
 * @var array
 */
	private $__defaultXmlArray  = array(
			'feed' => array(
				'xmlns:'           => 'http://www.w3.org/2005/Atom',
				'xmlns:xhtml'      => 'http://www.w3.org/1999/xhtml',
				'xmlns:opds'       => 'http://opds-spec.org/2010/catalog',
				'xmlns:opensearch' => 'http://a9.com/-/spec/opensearch/1.1/',
				'xmlns:dcterms'    => 'http://purl.org/dc/terms/',

				'title'   => array(),
				'id'      => array(),
				'updated' => array(),
				'author'  => array(
					'name'  => array('Michael Tuttle'),
					'uri'   => array('github.com/openam'),
					'email' => array('openam@gmail.com'),
				),

				'link'  => array(),
				'entry' => array(),
			)
		);

/**
 * getMimeTypes method
 * @return array of ebook mimeTypes as defined in Settings.ebooks.mimeTypes
 */
	public function getMimeTypes() {
		return Configure::read('Settings.ebooks.mimeTypes');
	}

/**
 * getDefaultXmlArray method
 *
 * @param array $feedOptions default information to set in the feed
 * @return array $defaultXmlArray
 */
	public function getDefaultXmlArray($feedOptions = array()) {
		$xmlArray = $this->__defaultXmlArray;
		return $this->setFeedInfo($xmlArray, $feedOptions);
	}

/**
 * setFeedInfo method
 *
 * @param array $xmlArray the array that you want to add a link to
 * @param array $options array('id' => '', 'title' => '', 'updated' => '')
 * @return array $xmlArray with the info set
 */
	public function setFeedInfo($xmlArray = array(), $options = array()) {
		foreach ($options as $key => $value) {
			if (is_array($value)) {
				$xmlArray['feed'][$key] = $value;
			} else {
				$xmlArray['feed'][$key] = array($value);
			}
		}
		return $xmlArray;
	}

/**
 * addLink method
 *
 * @param array $xmlArray the array that you want to add a link to
 * @param array $options array('href' => '', 'rel' => '', 'title' => '')
 * @return array $xmlArray with the link added
 */
	public function addLink($xmlArray = array(), $options = array()) {
		$temp = array('@type'  => 'application/atom+xml;profile=opds-catalog;kind=navigation');
		foreach ($options as $key => $value) {
			$temp['@'.$key] = $value;
		}
		array_push($xmlArray['feed']['link'], $temp);
		return $xmlArray;
	}

/**
 * addEntry method
 *
 * @todo Need to fix the image, to use the correct image type based on the given file type.
 * @param array $xmlArray the array that you want to add a link to
 * @param array $options array(
 *      'title'     => '',
 *      'updated'   => '',
 *      'id'        => '',
 *      'content'   => '',
 *      'link'      => '',
 *      'thumbnail' => '',
 *      'image'     => '',
 *      'cover'     => '',
 *      'author'    => array(),
 *      'download'  => array())
 * @return array $xmlArray with the link added
 */
	public function addEntry($xmlArray = array(), $options = array()) {
		$entry = array(
			'title'   => '',
			'updated' => '',
			'id'      => '',
			'content' => '',
			'link'    => array(),
			'author'  => array(),
		);
		foreach ($options as $key => $value) {
			switch ($key) {
				case 'content':
					$entry[$key] = array(
						'@type' => 'text',
						'@' => $value,
					);
					break;

				case 'link':
					array_push($entry['link'], array(
						'@href' => $value,
						'@type' => 'application/atom+xml;profile=opds-catalog;kind=navigation',
					));
					break;

				case 'author':
					foreach ($value as $author) {
						array_push($entry['author'], array(
							'name' => $author['sort'],
							'uri'  => $this->Html->url(array('controller' => 'authors', 'action' => 'view', $author['id'] . '.xml'), false),
						));
					}
					break;

				case 'download':
					foreach ($value['downloads'] as $file) {
						$link = array(
							'@href'  => $this->Html->url(array('controller' => 'books', 'action' => 'download', $file['book'] , strtolower($file['format']))),
							'@type'  => '',
							'@rel'   => 'http://opds-spec.org/acquisition',
							'@title' => __('Download'),
						);

						$ebookMimeTypes = $this->getMimeTypes();
						if (array_key_exists(strtolower($file['format']), $ebookMimeTypes)) {
							$link['@type'] = $ebookMimeTypes[strtolower($file['format'])];
							array_push($entry['link'], $link);
						}
					}
					break;

				case 'cover':
					array_push($entry['link'], array(
						'@href' => $value,
						'@type'  => 'image/jpeg',
						'@rel'   => 'http://opds-spec.org/image/cover',
					));
					break;

				case 'thumbnail':
					array_push($entry['link'], array(
						'@href' => $value,
						'@type'  => 'image/jpeg',
						'@rel'   => 'http://opds-spec.org/image/thumbnail',
					));
					break;

				case 'image':
					array_push($entry['link'], array(
						'@href' => $value,
						'@type'  => 'image/jpeg',
						'@rel'   => 'http://opds-spec.org/image',
					));
					break;

				case 'tag':
					$tags = array();
					foreach ($value as $tag) {
						array_push($tags, array(
							'@term'  => $tag['name'],
							'@label' => $tag['name'],
						));
					}
					$entry['category'] = $tags;
					break;

				default:
					$entry[$key] = $value;
					break;
			}
		}

		/**
		 * Remove Empty Items
		 */
			foreach ($entry as $key => $value) {
				if (!$value) {
					unset($entry[$key]);
				}
			}

		array_push($xmlArray['feed']['entry'], $entry);
		return $xmlArray;
	}

}