<?php
namespace Istar\Repo\Message;


/**
 * IMessage
 */

interface IMessage {

/**
 * 创建一条消息
 * @param  array  $msg  消息主体
 * @param  array  $from   发件人
 * @param  [type] $type 消息类型
 * @return array或arrayable collection
 */
            public function createMsg($msg,$type=0);

}