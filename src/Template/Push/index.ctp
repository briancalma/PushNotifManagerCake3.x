<?php
echo $this->Form->create('');
echo $this->Form->control('fb_config',['type' => 'textarea']);
echo $this->Form->control('server_api_key',['type' => 'textarea']);
echo $this->Form->control('Auto Generate Service Worker', ['type' => 'checkbox', 'name' => 'isSW']);
echo $this->Form->button('Submit');
echo $this->Form->end();
?>

<?php echo $this->element('include_scr'); ?>