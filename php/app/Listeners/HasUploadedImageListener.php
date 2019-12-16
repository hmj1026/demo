<?php

namespace App\Listeners;

use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HasUploadedImageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImageWasUploaded  $event
     * @return void
     */
    public function handle(ImageWasUploaded $event)
    {
        // Grab the uploaded file's path
        $imagePath = $event->path();
    }
}
