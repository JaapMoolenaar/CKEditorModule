<?php
namespace CKEditorModule\Form\View\Helper;

use Zend\Json\Json as JsonFormatter;

class FormCKEditor extends \Zend\Form\View\Helper\FormTextarea
{

    /**
     * @var \Zend\ModuleManager\ModuleManager
     */
    protected $moduleManager;

    /**
     * @var array
     */
    protected $config;

    /**
     * @return \Zend\ModuleManager\ModuleManager
     * @throws \Exception
     */
    protected function getModuleManager()
    {
        if ($this->moduleManager === null) {
            $view = $this->getView();

            if (!$view instanceof \Zend\View\Renderer\RendererInterface) {
                throw \Exception('Cannot get the configuration before the view has been set');
            }

            /* @var $helper \Zend\View\HelperPluginManager */
            $helperPluginManager = $this->getView()->getHelperPluginManager();

            /* @var $serviceLocator \Zend\ServiceManager\ServiceLocatorInterface */
            $serviceLocator = $helperPluginManager->getServiceLocator();

            $this->moduleManager = $serviceLocator->get('ModuleManager');
        }

        return $this->moduleManager;
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function getConfig()
    {
        if ($this->config === null) {
            $view = $this->getView();

            if (!$view instanceof \Zend\View\Renderer\RendererInterface) {
                throw \Exception('Cannot get the configuration before the view has been set');
            }

            /* @var $helper \Zend\View\HelperPluginManager */
            $helperPluginManager = $this->getView()->getHelperPluginManager();

            /* @var $serviceLocator \Zend\ServiceManager\ServiceLocatorInterface */
            $serviceLocator = $helperPluginManager->getServiceLocator();

            $this->config = $serviceLocator->get('CKEditorModule\Config');
        }

        return $this->config;
    }

    protected static $functionNameCount = 0;

    /**
     * @return string
     */
    protected function getTmpLoadFunctionName()
    {
        self::$functionNameCount++;

        return 'loadEditorFunc' . self::$functionNameCount . 'Salt' . rand(1, 10000);
    }

    /**
     * @return string
     */
    public function render(\Zend\Form\ElementInterface $oElement)
    {
        $config = $this->getConfig();

        $name = $oElement->getName();

        // Check whether some options have been passed via the form element
        // options
        $options = $oElement->getOption('ckeditor');
        if (!empty($options) && !is_array($options)) {
            throw \Exception('The options should either be an array or a traversable object');
        } elseif (empty($options)) {
            $options = array();
        }

        $ckfinderLoaded = $this->getModuleManager()->getModule('CKFinderModule') !== null;

        // Because zf merges arrays instead of overwriting them in the config,
        // we allow a callback and use the return as the toolbar array
        if (array_key_exists('toolbar', $config['ckeditor_options'])
            && is_callable($config['ckeditor_options']['toolbar'])
        ) {
            $toolbar = $config['ckeditor_options']['toolbar']();
            if (is_array($toolbar)) {
                $config['ckeditor_options']['toolbar'] = $toolbar;
            }
        }

        // Merge the defaut edito options with the form element options
        // and turn them into json
        $jsonOptions = JsonFormatter::encode(array_merge(
            $config['ckeditor_options'],
            $ckfinderLoaded ? $config['ckeditor_ckfinder_options'] : array(),
            $options
        ), true);

        $loadFunctionName = $this->getTmpLoadFunctionName();

        $src = $config['src'];

        return parent::render($oElement)
                . '<script type="text/javascript" language="javascript">' . "\n"
                    . 'if(typeof window.ckEditorLoading == "undefined"){' . "\n"
                        . 'window.ckEditorLoading = false;' . "\n"
                        . 'window.ckEditorCallbacks = [];' . "\n"
                    . '}' . "\n"
                    . '(function() {' . "\n"
                        . 'function ' . $loadFunctionName . '(){' . "\n"
                            . 'CKEDITOR.replace("' . $name . '", ' . $jsonOptions . ');' . "\n"
                        . '}' . "\n"

                        . 'if(typeof CKEDITOR == "undefined"){' . "\n"
                            . 'window.ckEditorCallbacks.push(' . $loadFunctionName . ');' . "\n"

                            . 'if(!window.ckEditorLoading) {' . "\n"
                                . 'window.ckEditorLoading = true;' . "\n"
                                . 'var ckScript = document.createElement("script");' . "\n"
                                . 'ckScript.type = "text/javascript";' . "\n"
                                . 'ckScript.async = false;' . "\n"
                                . 'ckScript.src = "' . $src . '";' . "\n"
                                . 'var target = document.getElementsByTagName("script")[0];' . "\n"
                                . 'target.parentNode.insertBefore(ckScript, target);' . "\n"

                                . 'var ckEditorInterval = setInterval(function(){' . "\n"
                                    . 'if(typeof CKEDITOR != "undefined"){' . "\n"
                                        . 'clearInterval(ckEditorInterval);' . "\n"
                                        . 'for(var i in window.ckEditorCallbacks) window.ckEditorCallbacks[i]();' . "\n"
                                    . '}' . "\n"
                                . '}, 100);' . "\n"
                            . '}' . "\n"
                        . '} else {' . "\n"
                            . $loadFunctionName . '();' . "\n"
                        . '}' . "\n"
                    . '})();' . "\n"
                . '</script>' . "\n";
    }
}
