<h2>Sign Up</h2>
<?php echo $this->Form->create('User', array('url' => 'signup')); ?>
<?php echo $this->Form->input('username'); ?>
<?php echo $this->Form->input('email'); ?>
<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->end('Sign Up'); ?>