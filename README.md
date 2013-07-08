Cake Factory
============

**Cake** is a *CakePHP* plugin which provides an additional factory for the **Cake Toolkit** (CTK), adding configurable objects for the core **Html** and **Form** helpers available with the framework.

The inclusion of an object-oriented interface for the core helpers allows for a more sophisticated usage, such as adding child nodes and binding events, as well as improving the overall level of abstraction and separation of concerns in the View layer.

Requirements
------------

* CakePHP 2+
* PHP 5.3+
* Cake Toolkit (https://github.com/jameswatts/cake-toolkit)

Installation
------------

To use the plugin simply include it in your application's "app/Plugin" directory, and load it in the "app/Config/bootstrap.php" file.

```php
CakePlugin::load('CakeFactory');
```

The above code is *not* required if you're already using ```CakePlugin::loadAll()``` to load all plugins.

Implementation
--------------

Once the plugin is available it's ready to use in your **CTK** Views, or with the **Factory** helper included with the **Cake Toolkit**. To include the **Cake** factory in a View just add the factory to your *$factories* collection, for example:

```php
public $factories = array('CakeFactory.Cake');
```

With the factory now available you can call it in your View, and build your application using the **Html** and **Form** helpers via an object-oriented interface.

Here's a simple example of creating a **link** from the **Html** helper:

```php
$this->Cake->Link(array(
	'title' => __('Read more'),
	'url' => array(
		'controller' => 'Posts',
		'action' => 'view',
		$postId
	)
));	
```

Another example, creating a **form** with an **input** from the **Form** helper, with the additional binding of an **event** to the input element:

```php
// create a CakePHP form
$form = $this->Cake->Form(array(
	'model' => 'Example',
	'options' => array(
		'action' => 'add'
	)
));
	// create a CakePHP input
	$input = $this->Cake->Input(array(
		'field' => 'Example.column',
		'options' => array(
			'type' => 'text'
		)
	));
	// bind an event to the input
	$input->bind('keyup', $this->Js->Alert(array(
		'code' => $this->Js->Element(array('node' => $input))->getValue()
	)));
// add the input to the form
$form->add($input);
// add the form to the view
$this->add($form);
```

Documentation
-------------

The **Cake** factory has been designed to follow the existing methods and arguments defined in the *CakePHP* core helpers. This allows for an easy transition to using the factory, as you'll already be familiar with the parameters expected. The documentation for each helper class can be found here:

* **HtmlHelper:** http://api.cakephp.org/2.3/class-HtmlHelper.html
* **FormHelper:** http://api.cakephp.org/2.3/class-FormHelper.html

There have been some modifications to parameter names compared to their equivalent arguments. This is almost always the case for arguments which are composed of *2* or more words, such as the *$fieldName* argument, which becomes just the *field* parameter.

Support
-------

For support, bugs and feature requests, please use the [issues](https://github.com/jameswatts/cake-factory/issues) section of this repository.

Contributing
------------

If you'd like to contribute new features, enhancements or bug fixes to the code base just follow these steps:

* Create a [GitHub](https://github.com/signup/free) account, if you don't own one already
* Then, [fork](https://help.github.com/articles/fork-a-repo) the [Cake](https://github.com/jameswatts/cake-factory) factory repository to your account
* Create a new [branch](https://help.github.com/articles/creating-and-deleting-branches-within-your-repository) from the *develop* branch in your forked repository
* Modify the existing code, or add new code to your branch, making sure you follow the [CakePHP Coding Standards](http://book.cakephp.org/2.0/en/contributing/cakephp-coding-conventions.html)
* Modify or add [unit tests](http://book.cakephp.org/2.0/en/development/testing.html) which confirm the correct functionality of your code (requires [PHPUnit](http://www.phpunit.de/manual/current/en/installation.html) 3.5+)
* Consider using the [CakePHP Code Sniffer](https://github.com/cakephp/cakephp-codesniffer) to check the quality of your code
* When ready, make a [pull request](http://help.github.com/send-pull-requests/) to the main repository

There may be some discussion reagrding your contribution to the repository before any code is merged in, so be prepared to provide feedback on your contribution if required.

A list of contributors to the **Cake** factory can be found [here](https://github.com/jameswatts/cake-factory/contributors).

Licence
-------

Copyright 2013 James Watts (CakeDC). All rights reserved.

Licensed under the MIT License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.

Acknowledgements
----------------

Thanks to [Larry Masters](https://github.com/phpnut) and [everyone](https://github.com/cakephp/cakephp/contributors) who has contributed to [CakePHP](http://cakephp.org), helping make this framework what it is today.

