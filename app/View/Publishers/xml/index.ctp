<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => __('Calibre Publishers'),
		'id'      => array('calibre:publishers'),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => __('Home'),
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'publishers', 'action'=>'index.xml'), false),
		'rel'  => 'self',
	));

	foreach ($info['Publisher'] as $publisher) {
		$feed = $this->Opds->addEntry($feed, array(
			'link'    => $this->Html->url(array('controller'=>'publishers', 'action'=>'view', $publisher['id']. '.xml'), false),
			'title'   => $publisher['name'],
			'updated' => $publisher['updated'],
			'id'      => 'calbire:publisher:' . $publisher['id'],
			'content' => __('%s books sorted by title', $this->Txt->numberToWords($publisher['count'], true)),
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>