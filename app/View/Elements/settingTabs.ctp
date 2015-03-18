<!-- Nav tabs -->
<ul class="nav nav-tabs help-block" role="tablist">
    <?php if ($this->Session->read('Auth.User.role') === 'admin') { ?>
        <li<?php echo $this->Txt->activeIndex('users', true); ?>><?php echo $this->Html->link('<i class="icon-group"></i> ' . __('Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
    <?php } ?>
</ul>