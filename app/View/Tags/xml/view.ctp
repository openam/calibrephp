<?php
	$key = $tag['Tag']['name'];
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => $tag['Tag']['name'],
		'id'      => array('calibre:tag:' . $tag['Tag']['id']),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => __('Home'),
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'tags', 'action'=>'feed', $tag['Tag']['id'] . '.xml'), false),
		'rel'  => 'self',
	));

	foreach ($tag['Book'] as $book) {
		$entry = array(
			'link'      => $this->Html->url(array('controller'=>'tags', 'action'=>'view', $tag['Tag']['id']. '.xml'), false),
			'title'     => $book['sort'],
			'updated'   => date(DATE_ATOM, strtotime($book['last_modified'])),
			'id'        => 'urn:uuid:' . $book['uuid'],
			'content'   => '',
			'author'    => $book['Author'],
			'published' => date(DATE_ATOM, strtotime($book['pubdate'])),
			'download'  => array('downloads' => $book['Datum'], 'bookpath' => $book['path']),
			'tag'       => array($tag['Tag']),
		);

		if (!empty($book['Series'])) {
			$entry['content'] = __('Book %d in the %d series', $book['series_index'], $book['Series'][0]['sort']);
		}
		if ($book['has_cover']) {
			$entry['thumbnail'] = $this->Image->resizeUrl($book['path'], $this->Image->resizeSettings['view']);
			$entry['image']     = $this->Image->resizeUrl($book['path'], $this->Image->resizeSettings['opds']);
		}
		$feed = $this->Opds->addEntry($feed, $entry);
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>