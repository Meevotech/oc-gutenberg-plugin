<?php namespace Meevo\Gutenberg\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Widgets\Form;
use Cms\Classes\Theme;
use RainLab\Pages\Classes\Page;

class Pages extends Controller
{
    use \System\Traits\AssetMaker {
        \System\Traits\AssetMaker::addJs as _adjs;
    }
    public function load()
    {
        \Debugbar::disable();

        $this->assetPath = '/plugins/meevo/gutenberg/formwidgets/';
        $name = request()->get('name');
        if ($name) {
            $page = Page::load(Theme::getEditTheme(), $name);
        }

        if (!isset($page) || !$page) {
            $page = new Page;
        }

        $form = $this->makeWidget(Form::class, [
            'fields' => [
                'markup' => [
                   'tab' => 'rainlab.pages::lang.editor.content',
                   'type' => 'gutenberg',
                   'stretch' => 'true'
               ],
            ],
            'model' => $page,
        ]);

        $this->suppressLayout = true;

        $this->vars['form'] = $form;

        return $this->makeView('load');
        // dd($form);
    }

    public function addJs($name, $attributes = [])
    {
        // dump($this->assets);
        return $this->_adjs($name, $attributes);
        if (is_array($name)) {
            $name = $this->combineAssets($name, $this->getLocalPath($this->assetPath));
        }

        $jsPath = $this->getAssetPath($name);

        if (isset($this->controller)) {
            $this->controller->addJs($jsPath, $attributes);
        }

        if (is_string($attributes)) {
            $attributes = ['build' => $attributes];
        }

        $jsPath = $this->getAssetScheme($jsPath);

        $this->addAsset('js', $jsPath, $attributes);
    }
}
