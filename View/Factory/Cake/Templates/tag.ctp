<?php
echo $this->HtmlHelper->tag($this->name, (string) $this->text . $this->renderChildren(), $this->processOptions());
echo $this->parseEvents();
?>

