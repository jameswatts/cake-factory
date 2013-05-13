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

App::uses('Set', 'Utility');
App::uses('HelperCollection', 'View');
App::uses('CtkHelper', 'Ctk.View');
App::uses('HtmlFactory', 'Ctk.View/Factory');

/**
 * Creates a factory to use the core CakePHP helpers.
 *
 * @package       CakeFactory.View.Factory
 *
 * @method \CakeButton Button($params = array())
 * @method \CakeCharset Charset($params = array())
 * @method \CakeCheckbox Checkbox($params = array())
 * @method \CakeCrumbs Crumbs($params = array())
 * @method \CakeCss Css($params = array())
 * @method \CakeDateTime DateTime($params = array())
 * @method \CakeDay Day($params = array())
 * @method \CakeDiv Div($params = array())
 * @method \CakeDocType DocType($params = array())
 * @method \CakeElement Element($params = array())
 * @method \CakeError Error($params = array())
 * @method \CakeFile File($params = array())
 * @method \CakeForm Form($params = array())
 * @method \CakeHidden Hidden($params = array())
 * @method \CakeHour Hour($params = array())
 * @method \CakeImage Image($params = array())
 * @method \CakeInput Input($params = array())
 * @method \CakeInputs Inputs($params = array())
 * @method \CakeLabel Label($params = array())
 * @method \CakeLink Link($params = array())
 * @method \CakeMedia Media($params = array())
 * @method \CakeMeridian Meridian($params = array())
 * @method \CakeMeta Meta($params = array())
 * @method \CakeMinute Minute($params = array())
 * @method \CakeMonth Month($params = array())
 * @method \CakeNestedList NestedList($params = array())
 * @method \CakePara Para($params = array())
 * @method \CakePostButton PostButton($params = array())
 * @method \CakePostLink PostLink($params = array())
 * @method \CakeRadio Radio($params = array())
 * @method \CakeScript Script($params = array())
 * @method \CakeScriptBlock ScriptBlock($params = array())
 * @method \CakeSecure Secure($params = array())
 * @method \CakeSelect Select($params = array())
 * @method \CakeStyle Style($params = array())
 * @method \CakeSubmit Submit($params = array())
 * @method \CakeTableCells TableCells($params = array())
 * @method \CakeTableHeaders TableHeaders($params = array())
 * @method \CakeTag Tag($params = array())
 * @method \CakeTextarea Textarea($params = array())
 * @method \CakeYear Year($params = array())
 *
 */
class CakeFactory extends HtmlFactory {

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
 * Method used to setup additional resources for the factory. If either the "html" or 
 * "form" settings are specified, these will be used as the "className" for the helper if 
 * the value is a string, or the helper settings if the value is an array. Any class used 
 * must extend the equivalent base helper in the core.
 * 
 * @return void
 */
	public function setup() {
		$updateHtml = false;
		$updateForm = false;
		if (isset($this->settings['html'])) {
			if (is_array($this->settings['html'])) {
				$updateHtml = true;
				$this->helpers['HtmlHelper'] = $this->settings['html'];
			} else if (is_string($this->settings['html'])) {
				$updateHtml = true;
				$this->helpers['HtmlHelper']['className'] = $this->settings['html'];
			}
		}
		if (isset($this->settings['form'])) {
			if (is_array($this->settings['form'])) {
				$updateForm = true;
				$this->helpers['FormHelper'] = $this->settings['form'];
			} else if (is_string($this->settings['form'])) {
				$updateForm = true;
				$this->helpers['FormHelper']['className'] = $this->settings['form'];
			}
		}
		if ($updateHtml || $updateForm) {
			$helpers = HelperCollection::normalizeObjectArray(Set::normalize($this->helpers));
			$helperCollection = new HelperCollection($this->_view->getBaseView());
			foreach ($helpers as $name => $properties) {
				list($plugin, $class) = pluginSplit($properties['class']);
				$this->_helpers[$class] = new CtkHelper($class, $helperCollection->load($properties['class'], $properties['settings']), $this->_view);
			}
		}
	}

/**
 * Load Html tag configuration.
 *
 * Loads a file from APP/Config that contains tag data. By default the file is expected
 * to be compatible with PhpReader:
 *
 * `$this->Html->loadConfig('tags.php');`
 *
 * tags.php could look like:
 *
 * {{{
 * $tags = array(
 *		'meta' => '<meta %s>'
 * );
 * }}}
 *
 * If you wish to store tag definitions in another format you can give an array
 * containing the file name, and reader class name:
 *
 * `$this->Html->loadConfig(array('tags.ini', 'ini'));`
 *
 * Its expected that the `tags` index will exist from any configuration file that is read.
 * You can also specify the path to read the configuration file from, if APP/Config is not
 * where the file is.
 *
 * `$this->Html->loadConfig('tags.php', APP . 'Lib' . DS);`
 *
 * Configuration files can define the following sections:
 *
 * - `tags` The tags to replace.
 * - `minimizedAttributes` The attributes that are represented like `disabled="disabled"`
 * - `docTypes` Additional doctypes to use.
 * - `attributeFormat` Format for long attributes e.g. `'%s="%s"'`
 * - `minimizedAttributeFormat` Format for minimized attributes e.g. `'%s="%s"'`
 *
 * @param string|array $configFile String with the config file (load using PhpReader) or an array with file and reader name
 * @param string $path Path with config file
 * @return mixed False to error or loaded configs
 * @throws ConfigureException
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/html.html#changing-the-tags-output-by-htmlhelper
 */
	final public function loadConfig($configFile, $path = null) {
		return $this->HtmlHelper->loadConfig($configFile, (isset($path))? $path : null);
	}

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

/**
 * Finds URL for specified action.
 *
 * Returns a URL pointing at the provided parameters.
 *
 * @param string|array $url Either a relative string url like `/products/view/23` or
 *    an array of url parameters. Using an array for urls will allow you to leverage
 *    the reverse routing features of CakePHP.
 * @param boolean $full If true, the full base URL will be prepended to the result
 * @return string  Full translated URL with base path.
 * @link http://book.cakephp.org/2.0/en/views/helpers.html
 */
	final public function url($url = null, $full = false) {
		return $this->HtmlHelper->url((isset($url))? $url : null, $full);
	}

/**
 * Checks if a file exists when theme is used, if no file is found default location is returned
 *
 * @param string $file The file to create a webroot path to.
 * @return string Web accessible path to file.
 */
	final public function webroot($file) {
		return $this->HtmlHelper->webroot($file);
	}

/**
 * Generate url for given asset file. Depending on options passed provides full url with domain name.
 * Also calls Helper::assetTimestamp() to add timestamp to local files
 *
 * @param string|array Path string or url array
 * @param array $options Options array. Possible keys:
 *   `fullBase` Return full url with domain name
 *   `pathPrefix` Path prefix for relative urls
 *   `ext` Asset extension to append
 *   `plugin` False value will prevent parsing path as a plugin
 * @return string Generated url
 */
	final public function assetUrl($path, $options = array()) {
		return $this->HtmlHelper->assetUrl($path, $options);
	}

/**
 * Adds a timestamp to a file based resource based on the value of `Asset.timestamp` in
 * Configure. If Asset.timestamp is true and debug > 0, or Asset.timestamp == 'force'
 * a timestamp will be added.
 *
 * @param string $path The file path to timestamp, the path must be inside WWW_ROOT
 * @return string Path with a timestamp added, or not.
 */
	final public function assetTimestamp($path) {
		return $this->HtmlHelper->assetTimestamp($path);
	}

/**
 * Used to remove harmful tags from content. Removes a number of well known XSS attacks
 * from content. However, is not guaranteed to remove all possibilities. Escaping
 * content is the best way to prevent all possible attacks.
 *
 * @param string|array $output Either an array of strings to clean or a single string to clean.
 * @return string|array cleaned content for output
 */
	final public function clean($output = '') {
		return $this->HtmlHelper->clean($output);
	}

/**
 * Generates a DOM ID for the selected element, if one is not set.
 * Uses the current View::entity() settings to generate a CamelCased id attribute.
 *
 * @param array|string $options Either an array of html attributes to add $id into, or a string
 *   with a view entity path to get a domId for.
 * @param string $id The name of the 'id' attribute.
 * @return mixed If $options was an array, an array will be returned with $id set. If a string
 *   was supplied, a string will be returned.
 */
	final public function domId($options = null, $id = 'id') {
		return $this->HtmlHelper->domId((isset($options))? $options : null, $id);
	}

/**
 * Sets this helper's model and field properties to the dot-separated value-pair in $entity.
 *
 * @param string $entity A field name, like "ModelName.fieldName" or "ModelName.ID.fieldName"
 * @param boolean $setScope Sets the view scope to the model specified in $tagValue
 * @return void
 */
	final public function setEntity($entity, $setScope = false) {
		$this->FormHelper->setEntity($entity, $setScope);
	}

/**
 * Returns the entity reference of the current context as an array of identity parts
 *
 * @return array An array containing the identity elements of an entity
 */
	final public function entity() {
		return $this->FormHelper->entity();
	}

/**
 * Gets the currently-used model of the rendering context.
 *
 * @return string
 */
	final public function model() {
		return $this->FormHelper->model();
	}

/**
 * Gets the currently-used model field of the rendering context.
 * Strips off field suffixes such as year, month, day, hour, min, meridian
 * when the current entity is longer than 2 elements.
 *
 * @return string
 */
	final public function field() {
		return $this->FormHelper->field();
	}

/**
 * Gets the data for the current tag
 *
 * @param array|string $options If an array, should be an array of attributes that $key needs to be added to.
 *   If a string or null, will be used as the View entity.
 * @param string $field
 * @param string $key The name of the attribute to be set, defaults to 'value'
 * @return mixed If an array was given for $options, an array with $key set will be returned.
 *   If a string was supplied a string will be returned.
 */
	final public function value($options = array(), $field = null, $key = 'value') {
		return $this->FormHelper->value($options, (isset($field))? $field : null, $key);
	}
}

