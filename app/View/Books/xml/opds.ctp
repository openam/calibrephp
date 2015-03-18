<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => __('Calibre Home'),
		'id'      => array('calibre:home'),
		'updated' => $info['books']['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds.xml'), false),
		'rel'   => 'start',
		'title' => __('Home'),
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'books', 'action'=>'opds.xml'), false),
		'rel'  => 'self'
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'authors', 'action'=>'index.xml'), false),
		'title'   => __('By Author'),
		'updated' => $info['authors']['summary']['updated'],
		'id'      => 'calbire:authors',
		'content' => __('books sorted by %s authors', $this->Txt->numberToWords($info['authors']['summary']['count'], true)),
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'publishers', 'action'=>'index.xml'), false),
		'title'   => __('By Publisher'),
		'updated' => $info['publishers']['summary']['updated'],
		'id'      => 'calbire:publishers',
		'content' => __('books grouped by %s publishers', $this->Txt->numberToWords($info['publishers']['summary']['count'], true)),
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'ratings', 'action'=>'index.xml'), false),
		'title'   => __('By Rating'),
		'updated' => $info['ratings']['summary']['updated'],
		'id'      => 'calbire:ratings',
		'content' => __('books grouped by %s ratings', $this->Txt->numberToWords($info['ratings']['summary']['count'], true)),
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'series', 'action'=>'index.xml'), false),
		'title'   => __('By series'),
		'updated' => $info['series']['summary']['updated'],
		'id'      => 'calbire:series',
		'content' => __('books group by %s series', $this->Txt->numberToWords($info['series']['summary']['count'], true)),
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'tags', 'action'=>'index.xml'), false),
		'title'   => __('By tags'),
		'updated' => $info['tags']['summary']['updated'],
		'id'      => 'calbire:tags',
		'content' => __('books group by %s tags', $this->Txt->numberToWords($info['tags']['summary']['count'], true)),
	));

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>
