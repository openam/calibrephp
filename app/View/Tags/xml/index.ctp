<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => __('Calibre Tags'),
		'id'      => array('calibre:tags'),
		'updated' => $info['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => __('Home'),
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'tags', 'action'=>'index.xml'), false),
		'rel'  => 'self',
	));

	foreach ($info['Tag'] as $tag) {
		$feed = $this->Opds->addEntry($feed, array(
			'link'    => $this->Html->url(array('controller'=>'tags', 'action'=>'view', $tag['id']. '.xml'), false),
			'title'   => $tag['name'],
			'updated' => $tag['updated'],
			'id'      => 'calbire:tag:' . $tag['id'],
			'content' => __('%s books sorted by title', $this->Txt->numberToWords($tag['count'], true)),
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>