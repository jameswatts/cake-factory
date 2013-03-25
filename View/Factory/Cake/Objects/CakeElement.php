<?php
/**
 * Base class for core CakePHP helper elements.
 *
 * PHP 5
 *
 * Cake Toolkit (http://caketoolkit.org)
 * Copyright 2013, James Watts (http://github.com/jameswatts)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2013, James Watts (http://github.com/jameswatts)
 * @link          http://caketoolkit.org Cake Toolkit
 * @package       CakeFactory.View.Factory.Cake.Objects
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkNode', 'Ctk.Lib');
App::uses('CtkEvent', 'Ctk.Lib');

/**
 * Abstract class representing a base core CakePHP helper element.
 *
 * @package       CakeFactory.View.Factory.Cake.Objects
 */
abstract class CakeElement extends CtkNode {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'element';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'options' => array()
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'cake-element';

/**
 * Processes the options to pass to the element.
 *
 * @return array
 */
	final public function processOptions() {
		$options = (isset($this->options) && is_array($this->options))? $this->options : array();
		if (!array_key_exists('id', $options) || !$options['id']) {
			$options['id'] = $this->getId();
		} else {
			$this->setId((string) $options['id']);
		}
		return $options;
	}

/**
 * Processes the attributes to pass to the element.
 *
 * @return array
 */
	final public function processAttributes() {
		$attributes = (isset($this->attributes) && is_array($this->attributes))? $this->attributes : array();
		if (!array_key_exists('id', $attributes) || !$attributes['id']) {
			$attributes['id'] = $this->getId();
		} else {
			$this->setId((string) $attributes['id']);
		}
		return $attributes;
	}

/**
 * Gets the content for the events for the template.
 *
 * @return string
 */
	final public function parseEvents() {
		$content = '';
		$hasEvents = $this->hasEvents();
		$allowsEvents = $this->allowsEvents();
		$nodeEvents = $this->getEvents();
		if ($hasEvents || (isset($this->events) && $allowsEvents)) {
			$content .= '<script type="text/javascript">(function(){';
		}
		if ($hasEvents) {
			foreach ($nodeEvents as $type => $events) {
				foreach ($events as $event) {
					$code = $event->render();
					$callback = uniqid('JS_');
					$content .= "var node=document.getElementById('{$this->getId()}'),{$callback}=function(){{$code}};if(node.addEventListener){node.addEventListener('{$type}',function(){return {$callback}.apply(node,arguments);});}else if(node.attachEvent){node.attachEvent('on{$type}',function(){return {$callback}.apply(node,arguments);});}else{node['on{$type}']=function(){return {$callback}.apply(node,arguments);};}";
				}
			}
		}
		if (isset($this->events)) {
			if ($allowsEvents) {
				foreach ($this->events as $type => $event) {
					$code = ($event instanceof CtkEvent)? $event->render() : (string) $event;
					$callback = uniqid('JS_');
					$content .= "var node=document.getElementById('{$this->getId()}'),{$callback}=function(){{$code}};if(node.addEventListener){node.addEventListener('{$type}',function(){return {$callback}.apply(node,arguments);});}else if(node.attachEvent){node.attachEvent('on{$type}',function(){return {$callback}.apply(node,arguments);});}else{node['on{$type}']=function(){return {$callback}.apply(node,arguments);};}";
				}
			}
		}
		if ($hasEvents || (isset($this->events) && $allowsEvents)) {
			$content .= '})();</script>';
		}
		return $content;
	}
}

