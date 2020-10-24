<?php namespace Meevo\Gutenberg\Events;

use Illuminate\Queue\SerializesModels;

use Meevo\Gutenberg\Models\Content;

class ContentUpdated
{
    use SerializesModels;

    public $content;

    /**
     * Create a new event instance
     *
     * @param Meevo\Gutenberg\Models\Content $content
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }
}
