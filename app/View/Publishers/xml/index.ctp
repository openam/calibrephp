<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => 'Calibre Publishers',
		'id'      => array('calibre:publishers'),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => 'Home',
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
			'content' => $this->Txt->numberToWords($publisher['count'], true) . ' books sorted by title',
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>