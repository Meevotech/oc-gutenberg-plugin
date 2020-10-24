<?php namespace Meevo\Gutenberg\Events;

use Meevo\Gutenberg\Models\Content;
use Illuminate\Queue\SerializesModels;

class ContentRendered
{
    use SerializesModels;

    public $content;

    /**
     * Create a new event instance
     *
     * @param Content $content
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }
}
