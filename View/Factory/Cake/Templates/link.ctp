<?php
echo $this->HtmlHelper->link((string) $this->title . $this->renderChildren(), $this->url, $this->processOptions(), $this->confirm);
echo $this->parseEvents();
?>

