<?php echo $this->element('settingTabs') ?>

<!-- Tab panes -->
<div class="tab-content form-control-static">
    <div class="tab-pane active">
        <table class="table table-striped table-hover">
            <thead>
                <?php
                    echo $this->Html->tableHeaders(array('#', __('Name'), __('Value'), ''));
                ?>
            </thead>
            <tbody>
                <?php
                    foreach ($settings as $key => $setting) {
                        $name = $setting['Setting']['key'];
                        switch($name) {
                            case('language'):
                                $name = __('Language');
                                break;
                            case('metadata'):
                                $name = __('Alternate book path');
                                break;
                            case('auth'):
                                $name = __('Authorization');
                                break;
                        }

                        $value = $setting['Setting']['value'];
                        switch($value) {
                            case('0'):
                                $value = __('Disabled');
                                break;
                            case('1'):
                                $value = __('Enabled');
                                break;
                        }

                        echo $this->Html->tableCells(array(
                            array(
                                $key + 1,
                                $name,
                                $value,
                                array(
                                    $this->Html->link('<i class="icon-pencil"></i>', array('controller' => 'settings', 'action' => 'edit', $setting['Setting']['id']), array('escape' => false, 'class' => 'btn btn-primary btn-xs'))
                                    . $this->Form->end(),
                                    array('class' => 'text-right')
                                )
                            )
                        ));
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>