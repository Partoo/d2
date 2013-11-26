<?php
namespace Istar\Repo\Message;

use Illuminate\Database\Eloquent\Model;

/**
 * EloquentMessage
 */

class EloquentMessage implements IMessage {

    protected $message;

    function __construct(Model $message) {
        $this->message = $message;
    }



    }