<h2>Login</h2>
<?php echo $this->Form->create('User', array('url' => 'login')); ?>
<?php echo $this->Form->input('username'); ?>
<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->end('Login'); ?>
