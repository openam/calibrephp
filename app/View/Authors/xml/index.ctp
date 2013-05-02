<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => 'Calibre Authors',
		'id'      => array('calibre:authors'),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds.xml'), false),
		'rel'   => 'start',
		'title' => 'Home',
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'authors', 'action'=>'index.xml'), false),
		'rel'  => 'self',
	));

	foreach ($info['Author'] as $author) {
		$feed = $this->Opds->addEntry($feed, array(
			'link'    => $this->Html->url(array('controller'=>'authors', 'action'=>'view', $author['id']. '.xml'), false),
			'title'   => $author['name'],
			'updated' => $author['updated'],
			'id'      => 'calbire:author:' . $author['id'],
			'content' => $this->Txt->numberToWords($author['count'], true) . ' books sorted by title',
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>