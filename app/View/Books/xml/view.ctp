<?php
	$key = $book['Book']['sort'];
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => $book['Book']['sort'],
		'id'      => array('calibre:book:' . $book['Book']['id']),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => 'Home',
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'books', 'action'=>'view', $book['Book']['id'] . '.xml'), false),
		'rel'  => 'self',
	));

	$entry = array(
		'link'      => $this->Html->url(array('controller'=>'books', 'action'=>'view', $book['Book']['id']. '.xml'), false),
			'title'     => $book['Book']['sort'],
			'updated'   => date(DATE_ATOM, strtotime($book['Book']['last_modified'])),
			'id'        => 'urn:uuid:' . $book['Book']['uuid'],
			'content'   => '',
			'author'    => $book['Author'],
			'published' => date(DATE_ATOM, strtotime($book['Book']['pubdate'])),
			'download'  => array('downloads' => $book['Datum'], 'bookpath' => $book['Book']['path']),
			'tag'       => $book['Tag'],
		);

		if (!empty($book['Series'])) {
			$entry['content'] = 'Book ' . $book['Book']['series_index'] . ' in the ' . $book['Series'][0]['sort'] . ' series';
		}
		if ($book['Book']['has_cover']) {
			$entry['thumbnail'] = $this->Image->resizeUrl($book['Book']['path'], $this->Image->resizeSettings['view']);
			$entry['image']     = $this->Image->resizeUrl($book['Book']['path'], $this->Image->resizeSettings['opds']);
		}
		$feed = $this->Opds->addEntry($feed, $entry);

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>