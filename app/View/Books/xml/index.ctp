<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => 'Calibre Books',
		'id'      => array('calibre:books'),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds.xml'), false),
		'rel'   => 'start',
		'title' => 'Home',
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'books', 'action'=>'index.xml'), false),
		'rel'  => 'self',
	));

	foreach ($info['Book'] as $book) {
		$feed = $this->Opds->addEntry($feed, array(
			'link'    => $this->Html->url(array('controller'=>'books', 'action'=>'view', $book['id']. '.xml'), false),
			'title'   => $book['name'],
			'updated' => $book['updated'],
			'id'      => 'calbire:books:' . $book['id']
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>