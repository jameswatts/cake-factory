<?php
echo $this->FormHelper->create($this->model, $this->processOptions());
echo $this->renderChildren();
echo $this->FormHelper->end($this->submit);
echo $this->parseEvents();
?>

