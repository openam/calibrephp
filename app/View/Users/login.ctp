<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User');
    echo $this->Form->inputs(array(
        'legend' => __('Please enter your username and password'),
        'username' => array('type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group')),
        'password' => array('type' => 'password', 'class' => 'form-control', 'div' => array('class' => 'form-group'), 'label' => __('Password'))
    ));
    echo $this->Form->end(array('label' => __('Sign In'), 'class' => 'btn btn btn-primary'));
?>