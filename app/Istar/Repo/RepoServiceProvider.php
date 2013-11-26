<?php
namespace Istar\Repo;

use Tag,Document,User,Message,Docflow;
use Istar\Repo\Tag\EloquentTag;
use Istar\Repo\Message\EloquentMessage;
use Istar\Repo\Document\EloquentDocument;
use Illuminate\Support\ServiceProvider;
use App\Libs\Sms;


/**
 * ServiceProvider
 */

class RepoServiceProvider extends ServiceProvider {

    public function register()
    {
        $app = $this->app;

        $app->bind('Istar\Repo\Document\IDocument',function($app)
        {
            $document = new EloquentDocument(
                new Document,
                $app->make('Istar\Repo\Tag\ITag'),
                new Message,
                new User,
                new Sms,
                new Docflow
                );
            return $document;
        });

        $app->bind('Istar\Repo\Tag\ITag',function($app)
        {
            return new EloquentTag(
                new Tag
                );
        });

        $app->bind('Istar\Repo\Message\IMessage',function($app)
        {
            return new EloquentMessage(
                new Message
                );
        });

    }


}