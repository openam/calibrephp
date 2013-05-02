<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => 'Calibre Series',
		'id'      => array('calibre:series'),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => 'Home',
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'series', 'action'=>'feed'), false),
		'rel'  => 'self',
	));

	foreach ($info['Series'] as $series) {
		$feed = $this->Opds->addEntry($feed, array(
			'link'    => $this->Html->url(array('controller'=>'series', 'action'=>'view', $series['id']. '.xml'), false),
			'title'   => $series['name'],
			'updated' => $series['updated'],
			'id'      => 'calbire:series:' . $series['id'],
			'content' => $this->Txt->numberToWords($series['count'], true) . ' books sorted by title',
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>