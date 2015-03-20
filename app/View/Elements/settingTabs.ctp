<!-- Nav tabs -->
<ul class="nav nav-tabs help-block" role="tablist">
    <?php
        echo $this->Html->tag('li', $this->Html->link('<i class="icon-gears"></i> ' . __('General'), array('controller' => 'settings', 'action' => 'index'), array('escape' => false)), ($this->Txt->activeIndex('settings', true) ? array('class' => 'active') : array()));
        if ($this->Session->read('Auth.User.role') === 'admin' && (bool)Configure::read('General.auth')) {
            echo $this->Html->tag('li', $this->Html->link('<i class="icon-group"></i> ' . __('Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)), ($this->Txt->activeIndex('users', true) ? array('class' => 'active') : array()));
        }
    ?>
</ul>