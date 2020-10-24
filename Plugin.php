<?php namespace Meevo\Gutenberg;

use App;
use Backend;
use System\Classes\PluginBase;
use Meevo\Gutenberg\Classes\Extenders;
use Meevo\Gutenberg\FormWidgets\Gutenberg;
use Meevo\Gutenberg\FormWidgets\GutenbergIframe;

/**
 * Gutenberg Plugin
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'meevo.gutenberg::lang.plugin.name',
            'description' => 'meevo.gutenberg::lang.plugin.description',
            'author'      => 'Meevo',
            'icon'        => 'icon-pencil-square-o',
            'homepage'    => 'https://github.com/FlusherDock1/Gutenberg'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array|void
     */
    public function boot()
    {
        Extenders::RainLabBlog();
        Extenders::LovataGoodNews();
        Extenders::IndikatorNews();

        // Coming soon.
        Extenders::StaticPages();
        //
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerFormWidgets()
    {
        return [
            Gutenberg::class => 'gutenberg',
            GutenbergIframe::class => 'gutenberg_frame'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'meevo.gutenberg.access_settings' => [
                'tab'   => 'meevo.gutenberg::lang.plugin.name',
                'label' => 'meevo.gutenberg::lang.permission.access_settings'
            ],
        ];
    }

    /**
     * Registers settings for this plugin
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'meevo.gutenberg::lang.settings.menu_label',
                'description' => 'meevo.gutenberg::lang.settings.menu_description',
                'category'    => 'meevo.gutenberg::lang.plugin.name',
                'icon'        => 'icon-cog',
                'class'       => 'Meevo\Gutenberg\Models\Settings',
                'order'       => 500,
                'permissions' => ['meevo.gutenberg.access_settings']
            ]
        ];
    }
}
