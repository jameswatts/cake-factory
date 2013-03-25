<?php
$options = $this->processOptions();
echo $this->FormHelper->create($this->model, $options);
echo $this->renderChildren();
echo $this->FormHelper->end($options);
echo $this->parseEvents();
?>

