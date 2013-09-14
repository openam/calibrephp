<?php
	echo $this->Form->create(Inflector::camelize(Inflector::singularize($this->request->controller)), array(
		'url' => array_merge(array('action' => 'search'), $this->params['pass']),
		'inputDefaults' => array(
			'div'       => 'form-group',
			'wrapInput' => false,
			'class'     => 'form-control'
		),
	));
	echo $this->Form->input('search', array('type' => 'text'));
	echo $this->Form->submit(__('Search'), array('div' => false, 'class' => 'btn btn-primary'));
	echo $this->Form->end();

	echo $this->Txt->searchByModels();
?>
