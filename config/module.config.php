<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'CKEditorModule\Config' => 'CKEditorModule\Service\ConfigServiceFactory',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formckeditor' => 'CKEditorModule\Form\View\Helper\FormCKEditor',
            'formelement' => 'CKEditorModule\Form\View\Helper\FormElement',
        ),
    ),
    'ckeditor_module' => array(
        'src' => '//cdn.ckeditor.com/4.4.4/full/ckeditor.js',
        'ckeditor_options' => array(
            'toolbar' => array(
                array('name' => 'document', 'groups' => array('mode', 'document', 'doctools'), 'items' => array('Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates')),
                array('name' => 'clipboard', 'groups' => array('clipboard', 'undo'), 'items' => array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo')),
                array('name' => 'editing', 'groups' => array('find', 'selection', 'spellchecker'), 'items' => array('Find', 'Replace', '-', 'SelectAll', '-', 'Scayt')),
                array('name' => 'forms', 'items' => array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField')),
                '/',
                array('name' => 'basicstyles', 'groups' => array('basicstyles', 'cleanup'), 'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat')),
                array('name' => 'paragraph', 'groups' => array('list', 'indent', 'blocks', 'align', 'bidi'), 'items' => array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language')),
                array('name' => 'links', 'items' => array('Link', 'Unlink', 'Anchor')),
                array('name' => 'insert', 'items' => array('Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe')),
                '/',
                array('name' => 'styles', 'items' => array('Styles', 'Format', 'Font', 'FontSize')),
                array('name' => 'colors', 'items' => array('TextColor', 'BGColor')),
                array('name' => 'tools', 'items' => array('Maximize', 'ShowBlocks')),
                array('name' => 'others', 'items' => array('-')),
                array('name' => 'about', 'items' => array('About'))
            ),
        ),
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
    ),
);
