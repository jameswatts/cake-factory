<?php
/**
 * Factory for CakePHP core helpers.
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
 * @package       CakeFactory.View.Factory
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkFactory', 'Ctk.Lib');

/**
 * Creates a factory to use the core CakePHP helpers.
 *
 * @package       CakeFactory.View.Factory
 */
class CakeFactory extends CtkFactory {

/**
 * An array containing the names of helpers this factory uses.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $helpers = array(
		'HtmlHelper' => array(
			'className' => 'Html'
		),
		'FormHelper' => array(
			'className' => 'Form'
		)
	);

/**
 * Method used to setup additional resources for the factory.
 * 
 * @return void
 */
	public function setup() {}

/**
 * Returns false if given form field described by the current entity has no errors.
 * Otherwise it returns the validation message
 *
 * @return mixed Either false when there are no errors, or an array of error
 *    strings. An error string could be ''.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#FormHelper::tagIsInvalid
 */
	final public function tagIsInvalid() {
		return $this->FormHelper->tagIsInvalid();
	}

/**
 * Add to or get the list of fields that are currently unlocked.
 * Unlocked fields are not included in the field hash used by SecurityComponent
 * unlocking a field once its been added to the list of secured fields will remove
 * it from the list of fields.
 *
 * @param string $name The dot separated name for the field.
 * @return mixed Either null, or the list of fields.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#FormHelper::unlockField
 */
	final public function unlockField($name = null) {
		return $this->FormHelper->unlockField((isset($name))? $name : null);
	}

/**
 * Returns true if there is an error for the given field, otherwise false
 *
 * @param string $field This should be "Modelname.fieldname"
 * @return boolean If there are errors this method returns true, else false.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#FormHelper::isFieldError
 */
	final public function isFieldError($field) {
		return $this->FormHelper->isFieldError($field);
	}


/**
 * Adds a link to the breadcrumbs array.
 *
 * @param string $name Text for link
 * @param string $link URL for link (if empty it won't be a link)
 * @param string|array $options Link attributes e.g. array('id' => 'selected')
 * @return void
 * @see HtmlHelper::link() for details on $options that can be used.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/html.html#creating-breadcrumb-trails-with-htmlhelper
 */
	final public function addCrumb($name, $link = null, $options = null) {
		$this->HtmlHelper->addCrumb($name, (isset($link))? $link : null, (isset($options))? $options : null);
	}

/**
 * Returns the breadcrumb trail as a sequence of &raquo;-separated links.
 *
 * If `$startText` is an array, the accepted keys are:
 *
 * - `text` Define the text/content for the link.
 * - `url` Define the target of the created link.
 *
 * All other keys will be passed to HtmlHelper::link() as the `$options` parameter.
 *
 * @param string $separator Text to separate crumbs.
 * @param string|array|boolean $startText This will be the first crumb, if false it defaults to first crumb in array. Can
 *   also be an array, see above for details.
 * @return string Composed bread crumbs
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/html.html#creating-breadcrumb-trails-with-htmlhelper
 */
	final public function getCrumbs($separator = '&raquo;', $startText = false) {
		return $this->HtmlHelper->getCrumbs($separator, $startText);
	}

/**
 * Returns a formatted existent block of $tags
 *
 * @param string $tag Tag name
 * @return string Formatted block
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/html.html#HtmlHelper::useTag
 */
	final public function useTag($tag) {
		return $this->HtmlHelper->useTag($tag);
	}
}

