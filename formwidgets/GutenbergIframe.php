<?php namespace Meevo\Gutenberg\FormWidgets;

use Backend\Classes\FormWidgetBase;
use stdClass;

/**
 * GutenbergIframe Form Widget
 */
class GutenbergIframe extends FormWidgetBase
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'meevo_gutenberg_gutenberg_iframe';

    /**
     * @inheritDoc
     */
    public function init()
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('gutenbergiframe');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->addCss('css/gutenbergiframe.css', 'meevo.gutenberg');
        $this->addJs('js/gutenbergiframe.js', 'meevo.gutenberg');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $value;
    }
}
