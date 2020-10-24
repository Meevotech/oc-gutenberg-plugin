# Gutenberg for OctoberCMS

Internal use for now

---

## Installation

Install plugin by OctoberCMS plugin updater.

Go to Settings –> Updates&Plugins find Gutenberg in plugin search. Click on icon and install it.

or via Composer

```
composer require meevo/gutenberg
```

## Usage

This plugin works only by implementing Gutenberg behavior in your model.
It will create morphOne relation with `Gutenberg\Content` model.

Go to your model and add behavior in \$implement array:

```php
public $implement = ['Meevo.Gutenberg.Behaviors.Gutenbergable'];
```

After you need to add behavior to \$implement array in your model controller.

```php
public $implement = ['Meevo.Gutenberg.Behaviors.GutenbergController'];
```

Done. Your model now has morphOne with `Gutenberg\Content` Model by `content` field that **renders only on created model page**.

## Rendering

Rendering examples below.

```twig
{{ post.content.render }}
```

```
$post->content->render();
```

In order to correctly display Gutenberg styles. You must add laraberg public styles to your page:

```html
<link
  href="/plugins/meevo/gutenberg/assets/laraberg.min.css"
  rel="stylesheet"
/>
```

## Working with source js code

If you want to add some features you can work with source files of Laraberg in `/plugins/meevo/gutenberg/formwidgets/gutenberg/assets/resources`, to set up all environment follow these steps:

1. Clone Gutenberg rep.:
   `git clone https://github.com/WordPress/gutenberg.git gutenberg`
2. After cloning execute these commands:
   ```bash
   cd gutenberg           // go to Gutenberg folder
   npm i                  // install all dependencies
   npm run build          // Build Gutenberg
   sudo npm link          // Link it to your global node_modules
   cd ..                  // Go back to Laraberg root
   npm i                  // install all dependencies
   npm link gutenberg     // Link Gutenberg package to Laraberg
   ```
3. Now you set up.

---

Developed by [meevo.ca](https://meevo.ca)
