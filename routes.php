<?php

Route::group(['prefix' => 'laraberg', 'middleware' => ['web']], function () {
    Route::apiResource('blocks', 'Meevo\Gutenberg\Classes\BlockController');
    Route::get('oembed', 'Meevo\Gutenberg\Classes\OEmbedController');
});

// Route::get('test', function () {
//     $p = new Meevo\Gutenberg\Classes\WP_Block_Parser;
//     dd($p->parse('<!-- wp:group -->
// <div class="wp-block-group"><div class="wp-block-group__inner-container"><!-- wp:image {"sizeSlug":"large"} -->
// <figure class="wp-block-image size-large"><img src="/storage/app/media/Scan.jpeg" alt=""/></figure>
// <!-- /wp:image -->

// <!-- wp:audio {"align":"full"} -->
// <figure class="wp-block-audio alignfull"><audio controls src="/storage/app/media/243701ertfeldacorrect-online-audio-convertercom.mp3"></audio></figure>
// <!-- /wp:audio --></div></div>
// <!-- /wp:group -->'));
// });
