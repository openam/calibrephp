<?php
	$key = $series['Series']['id'];
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => $series['Series']['sort'],
		'id'      => array('calibre:series:' . $series['Series']['id']),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => __('Home'),
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'series', 'action'=>'view', $series['Series']['id'] . '.xml'), false),
		'rel'  => 'self',
	));

	foreach ($series['Book'] as $book) {
		$entry = array(
			'link'      => $this->Html->url(array('controller'=>'series', 'action'=>'view', $series['Series']['id']. '.xml'), false),
			'title'     => $book['sort'],
			'updated'   => date(DATE_ATOM, strtotime($book['last_modified'])),
			'id'        => 'urn:uuid:' . $book['uuid'],
			'content'   => __('Book %d in the %d series', $book['series_index'], $series['Series']['sort']),
			'author'    => $book['Author'],
			'published' => date(DATE_ATOM, strtotime($book['pubdate'])),
			'download'  => array('downloads' => $book['Datum'], 'bookpath' => $book['path']),
			'tag'       => $book['Tag'],
		);

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