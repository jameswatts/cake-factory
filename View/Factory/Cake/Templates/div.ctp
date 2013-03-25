<?php
echo $this->HtmlHelper->div($this->{'class'}, (string) $this->text . $this->renderChildren(), $this->processOptions());
echo $this->parseEvents();
?>

