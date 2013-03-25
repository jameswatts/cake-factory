<?php
echo $this->HtmlHelper->para($this->{'class'}, (string) $this->text . $this->renderChildren(), $this->processOptions());
echo $this->parseEvents();
?>

