<div role="tabpanel">
    <?php echo $this->element('settingTabs') ?>

    <!-- Tab panes -->
    <div class="tab-content form-control-static">
        <div role="tabpanel" class="tab-pane active">
            <?php
                echo $this->Form->create('User');
                echo $this->Form->inputs(array(
                    'username' => array('type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group')),
                    'password' => array('type' => 'password', 'class' => 'form-control', 'div' => array('class' => 'form-group')),
                    'role' => array('options' => array('user' => __('User'), 'admin' => __('Admin')), 'class' => 'form-control', 'div' => array('class' => 'form-group')),
                    'deny' => array('class' => 'form-control', 'div' => array('class' => 'form-group'), 'label' => __('Deny Tags')),
                    'language' => array('options' => array('en' => __('English'), 'ru' => __('Russian')), 'class' => 'form-control', 'div' => array('class' => 'form-group'))
                ), null, array('legend' => __('Edit User')));
                echo $this->Form->end(array('label' => __('Save'), 'class' => 'btn btn btn-primary'));
            ?>
        </div>
    </div>
</div>