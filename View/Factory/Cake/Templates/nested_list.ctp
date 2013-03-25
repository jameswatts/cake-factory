<?php
echo $this->HtmlHelper->nestedList($this->{'list'}, $this->processOptions(), $this->processAttributes(), $this->tag);
echo $this->parseEvents();
?>

