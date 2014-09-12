<?php
namespace CKEditorModule\Form\View\Helper;

use Zend\Form\View\Helper\FormElement as ZendFormElement;

class FormElement extends ZendFormElement
{
    public function __construct()
    {
        $this->addType('ckeditor', 'formckeditor');
    }
}
