<?php
namespace CKEditorModule\Form\Element;

use Zend\Form\Element;

class CKEditor extends Element
{
    /**
     * @var array
     */
    protected $attributes = array(
        'type' => 'ckeditor',
    );
}
