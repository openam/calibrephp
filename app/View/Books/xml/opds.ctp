<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => 'Calibre Home',
		'id'      => array('calibre:home'),
		'updated' => $info['books']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'books', 'action'=>'opds'), false),
		'rel'  => 'self'
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'authors', 'action'=>'index.xml'), false),
		'title'   => 'By Author',
		'updated' => $info['authors']['updated'],
		'id'      => 'calbire:authors',
		'content' => 'books sorted by ' . $this->Txt->numberToWords(count($info['authors']['count']), true) . ' authors',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'publishers', 'action'=>'index.xml'), false),
		'title'   => 'By Publisher',
		'updated' => $info['publishers']['updated'],
		'id'      => 'calbire:publishers',
		'content' => 'books grouped by ' . $this->Txt->numberToWords(count($info['publishers']['count']), true) . ' publishers',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'ratings', 'action'=>'index.xml'), false),
		'title'   => 'By Rating',
		'updated' => $info['ratings']['updated'],
		'id'      => 'calbire:ratings',
		'content' => 'books grouped by ' . $this->Txt->numberToWords(count($info['ratings']['count']), true) . ' ratings',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'series', 'action'=>'index.xml'), false),
		'title'   => 'By series',
		'updated' => $info['series']['updated'],
		'id'      => 'calbire:series',
		'content' => 'books group by ' . $this->Txt->numberToWords(count($info['series']['count']), true) . ' series',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'tags', 'action'=>'index.xml'), false),
		'title'   => 'By tags',
		'updated' => $info['tags']['updated'],
		'id'      => 'calbire:tags',
		'content' => 'books group by ' . $this->Txt->numberToWords(count($info['tags']['count']), true) . ' tags',
	));

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>