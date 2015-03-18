<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => __('Calibre Ratings'),
		'id'      => array('calibre:ratings'),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => __('Home'),
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'ratings', 'action'=>'index.xml'), false),
		'rel'  => 'self',
	));

	foreach ($info['Rating'] as $rating) {
		$feed = $this->Opds->addEntry($feed, array(
			'link'    => $this->Html->url(array('controller'=>'ratings', 'action'=>'view', $rating['id']. '.xml'), false),
			'title'   => $this->Txt->stars($rating['name'] / 2, 5, false),
			'updated' => $rating['updated'],
			'id'      => 'calbire:rating:' . $rating['id'],
			'content' => __('%s books sorted by title', $this->Txt->numberToWords($rating['count'], true)),
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>