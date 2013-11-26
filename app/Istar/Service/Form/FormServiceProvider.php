<?php
namespace Istar\Service\Form;
use Illuminate\Support\ServiceProvider;
use Istar\Service\Form\Document\DocumentForm;
use Istar\Service\Form\Document\DocumentFormValidator;


/**
 * FormServiceProvider
 */

class FormServiceProvider extends ServiceProvider {

        public function register()
        {
                $app = $this->app;

                $app->bind('Istar\Service\Form\Document\DocumentForm',function($app){

                    return new DocumentForm(
                            new DocumentFormValidator($app['validator']),
                            $app->make('Istar\Repo\Document\IDocument')
                        );
                });
        }
}
