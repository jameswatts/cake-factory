<?php
echo $this->FormHelper->error($this->field, (string) $this->text . $this->renderChildren(), $this->processOptions());
echo $this->parseEvents();
?>

