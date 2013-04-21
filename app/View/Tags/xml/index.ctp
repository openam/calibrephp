<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => 'Calibre Tags',
		'id'      => array('calibre:tags'),
		'updated' => $info['tags']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'   => 'start',
		'title' => 'Home',
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'tags', 'action'=>'index.xml'), false),
		'rel'  => 'self',
	));

	foreach ($info['tags']['count'] as $tag) {
		$feed = $this->Opds->addEntry($feed, array(
			'link'    => $this->Html->url(array('controller'=>'tags', 'action'=>'view', $tag['id']. '.xml'), false),
			'title'   => $tag['name'],
			'updated' => $tag['updated'],
			'id'      => 'calbire:tag:' . $tag['id'],
			'content' => $this->Txt->numberToWords($tag['count'], true) . ' books sorted by title',
		));
	}

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>