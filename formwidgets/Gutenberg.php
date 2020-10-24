<?php namespace Meevo\Gutenberg\FormWidgets;

use Backend\Classes\FormWidgetBase;
use stdClass;

/**
 * Gutenberg Form Widget
 */
class Gutenberg extends FormWidgetBase
{
    //
    // Configurable properties
    //

    /**
     * @var int Minimal height of rich editor. 0 = 100%
     */
    public $minheight = 350;

    //
    // Object properties
    //

    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'gutenberg';

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->fillFromConfig([
            'minheight'
        ]);

        if ($this->formField->disabled) {
            $this->readOnly = true;
        }
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('gutenberg');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name']      = $this->formField->getName();
        $this->vars['value']     = $this->getLoadValue();
        $this->vars['model']     = $this->model;
        $this->vars['minheight'] = $this->minheight;
    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        // Required dependencies
        // The Gutenberg editor expects React, ReactDOM, Moment and JQuery to be in the environment it runs in.
        // An easy way to do this would be to add the following lines to your page:
        // Jquery already on page by default OctoberCMS env.
        $this->addJs('js/react.production.min.js', 'Meevo.Gutenberg');
        $this->addJs('js/react-dom.production.min.js', 'Meevo.Gutenberg');

        // Gutenberg assets
        $this->addCss('css/laraberg.css', 'Meevo.Gutenberg');
        $this->addJs('js/laraberg.js', 'Meevo.Gutenberg');

        // Formwidget assets
        $this->addJs('js/gutenberg.js', 'Meevo.Gutenberg');
        $this->addCss('css/gutenberg.css', 'Meevo.Gutenberg');

        \Event::fire('gutenberg.blocks', [$this]);

        $this->addCss($this->_css);
        $this->addJs($this->_js);

        foreach ($this->_js_single as $js) {
            $this->addJs($js);
        }
        foreach ($this->_css_single as $css) {
            $this->addCss($css);
        }
    }

    private $_css = [];
    private $_js = [];
    private $_js_single = [];
    private $_css_single = [];

    public function addBlockJs($path, $toCombine = true)
    {
        if ($toCombine) {
            $this->_js[] = $path;
        } else {
            $this->_js_single[] = $path;
        }
    }

    public function addBlockCss($path, $toCombine = false)
    {
        if ($toCombine) {
            $this->_css[] = $path;
        } else {
            $this->_css_single[] = $path;
        }
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $value;
    }
}
