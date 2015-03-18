<?php
	$key = $author['Author']['sort'];
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => $author['Author']['sort'],
		'id'      => array('calibre:publisher:' . $author['Author']['id']),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => __('Home'),
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'authors', 'action'=>'view', $author['Author']['id'] . '.xml'), false),
		'rel'  => 'self',
	));

	foreach ($author['Book'] as $book) {
		$entry = array(
			'link'      => $this->Html->url(array('controller'=>'authors', 'action'=>'view', $author['Author']['id']. '.xml'), false),
			'title'     => $book['sort'],
			'updated'   => date(DATE_ATOM, strtotime($book['last_modified'])),
			'id'        => 'urn:uuid:' . $book['uuid'],
			'content'   => '',
			'author'    => array($author['Author']),
			'published' => date(DATE_ATOM, strtotime($book['pubdate'])),
			'download'  => array('downloads' => $book['Datum'], 'bookpath' => $book['path']),
			'tag'       => $book['Tag'],
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