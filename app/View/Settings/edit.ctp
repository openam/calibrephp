<div role="tabpanel">
    <?php echo $this->element('settingTabs') ?>

    <!-- Tab panes -->
    <div class="tab-content form-control-static">
        <div role="tabpanel" class="tab-pane active">
            <?php
                echo $this->Form->create('Setting', array('inputDefaults' => array('div' => false)));

                $input = array();
                $name = $this->request->data['Setting']['key'];

                switch($name) {
                    case('language'):
                        $input = array(
                            'options' => array('en' => __('English'), 'ru' => __('Russian')),
                            'class' => 'form-control',
                            'div' => array('class' => 'form-group'),
                            'label' => __('Language')
                        );
                        break;
                    case('metadata'):
                        $input = array(
                            'type' => 'text',
                            'class' => 'form-control',
                            'div' => array('class' => 'form-group'),
                            'label' => __('Book path'),
                            'error' => array(
                                'checkSettingValue' => __('Database calibre not found or not readable')
                            )
                        );
                    case('auth'):
                        $input = array(
                            'options' => array('0' => __('Disabled'), '1' => __('Enabled')),
                            'class' => 'form-control',
                            'div' => array('class' => 'form-group'),
                            'label' => __('Authorization')
                        );
                    break;
                }

                echo $this->Form->inputs(array('value' => $input), null, array('legend' => __('Edit Setting')));
                echo $this->Form->end(array('label' => __('Save'), 'class' => 'btn btn btn-primary'));
            ?>
        </div>
    </div>
</div>