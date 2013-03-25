<?php
/**
 * CakePHP charset element.
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

App::uses('CakeElement', 'CakeFactory.View/Factory/Cake/Objects');

/**
 * Creates an object representing a CakePHP charset element.
 *
 * @package       CakeFactory.View.Factory.Cake.Objects
 */
class CakeCharset extends CakeElement {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'charset';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'charset' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'cake-charset';

/**
 * Determines if the node accepts child nodes.
 *
 * @var boolean Set to FALSE to block adding child nodes.
 */
	protected $_allowChildren = false;

/**
 * Determines if the node accepts events.
 *
 * @var boolean Set to FALSE to block adding events.
 */
	protected $_allowEvents = false;
}

