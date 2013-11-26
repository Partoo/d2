<?php
namespace Istar\Repo;

use Illuminate\Support\ServiceProvider;
use Istar\Repo\Document\EloquentDocument;
use Document;

/**
 * ServiceProvider
 */

class RepoProvider extends ServiceProvider {

    public function register()
    {
        $app = $this->app;

        $app->bind('Istar\Repo\Document\IDocument',function($app){
            return new EloquentDocument(new Document);
        });
    }
}