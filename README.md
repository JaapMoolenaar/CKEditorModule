# CKEditorModule
[![Latest Stable Version](https://poser.pugx.org/satsume/ckeditor-module/v/stable.svg)](https://packagist.org/packages/satsume/ckeditor-module) [![Latest Unstable Version](https://poser.pugx.org/satsume/ckeditor-module/v/unstable.svg)](https://packagist.org/packages/satsume/ckeditor-module) [![Build Status](https://travis-ci.org/Satsume/CKEditorModule.svg?branch=master)](https://travis-ci.org/Satsume/CKEditorModule)

## Introduction
This module allows you to use a ckeditor form field more easily using some basic
view helpers

## Installation
As usual, install the module via composer, either add a require statement to composer.json:
```
{
    "require": {
        "satsume/ckeditor-module": "0.*"
    }
}
```

And then let it install/update
```
composer update
```

Or use just the command line, like so:
```sh
./composer.phar require satsume/ckeditor-module
```

## Usage
Add a form field like you normally would:
```php
$this->add(array(
  'type' => 'CKEditorModule\Form\Element\CKEditor',
  'name' => 'editor',
  'options' => array(
    'label' => 'Editor content',
    'ckeditor' => array(
		// add anny config you would normaly add via CKEDITOR.editorConfig
        'language' => 'nl',
        'uiColor' => '#AADC6E',
    )
  ),
));
```

As type in a Form ```__construct()``` you cannot use 'ckeditor' this is because of the way the form element manager works. If you are using the form element manager to create forms and you're adding form fields in the ```init()``` method, you can use 'ckeditor' as type.

More info can be found in [zf2's documentation](http://framework.zend.com/manual/2.1/en/modules/zend.form.advanced-use-of-forms.html#creating-custom-elements)


## CKFinder
If you include the [CKFinderModule](https://github.com/Satsume/CKFinderModule) in your application, the ckfinder config is automatically added to the ckeditor config:
```php
'ckeditor_ckfinder_options' => array(
  'filebrowserBrowseUrl' => '/ckfinder/ckfinder.html',
  'filebrowserImageBrowseUrl' => '/ckfinder/ckfinder.html?type=Images',
  //'filebrowserFlashBrowseUrl' => '/ckfinder/ckfinder.html?type=Flash',
  'filebrowserUploadUrl' => '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
  'filebrowserImageUploadUrl' => '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
  //'filebrowserFlashUploadUrl' => '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
  'filebrowserWindowWidth' => '1000',
  'filebrowserWindowHeight' => '700'
),
```

( I turned off the flash browser, because I never use flash in my applications anymore )
