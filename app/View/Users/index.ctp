<?php echo $this->element('settingTabs') ?>

<!-- Tab panes -->
<div class="tab-content form-control-static">
    <div class="tab-pane active">
        <table class="table table-striped table-hover">
            <thead>
                <?php
                    echo $this->Html->tableHeaders(array('#', __('Username'), __('Role'), __('Deny Tags'), __('Language'), ''));
                ?>
            </thead>
            <tbody>
                <?php
                    foreach ($users as $key => $user) {
                        echo $this->Html->tableCells(array(
                            array(
                                $key + 1,
                                $user['User']['username'],
                                $user['User']['role'],
                                !empty($user['User']['deny']) ? $user['User']['deny'] : '-',
                                $user['User']['language'],
                                array(
                                    $this->Form->create(false, array('url' => array('controller' => 'users', 'action' => 'delete', $user['User']['id'])))
                                    . $this->Html->link('<i class="icon-pencil"></i>', array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('escape' => false, 'class' => 'btn btn-primary btn-xs'))
                                    . $this->Form->button('<i class="icon-remove"></i>', array('class' => 'btn btn-primary btn-xs col-lg-offset-1'))
                                    . $this->Form->end(),
                                    array('class' => 'text-right')
                                )
                            )
                        ));
                    }
                ?>
            </tbody>
        </table>
        <?php echo $this->Html->link(__('Add user'), array('controller' => 'users', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary text-right', 'role' => 'button')); ?>
    </div>
</div>