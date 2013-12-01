<?php
namespace Istar\Repo\Document;
use Illuminate\Database\Eloquent\Model;
use App\Libs\Sms;
use Istar\Repo\Tag\ITag;


class EloquentDocument implements IDocument {

  protected $document;
  protected $tag;
  protected $message;
  protected $sms;
  protected $docflow;

  public  function __construct(Model $document,ITag $tag,Model $message,Model $user,Sms $sms,Model $docflow) {
    $this->document = $document;
    $this->tag = $tag;
    $this->message = $message;
    $this->user = $user;
    $this->sms = $sms;
    $this->docflow = $docflow;
  }

  /**
   * 获取全部的文档(管理员用)
   * @return [type] [description]
   */
  public function getAll()
  {
    return $this->document->select('id','subject','docnumber','state','category','creDep','created_at');
  }

  public function getById($id)
  {
    return $this->document->find($id);
  }

  public function getByTag($id)
  {
    return \Tag::find($id);
  }

  public function getAllAudit()
  {
    # code...
  }

  public function getAuditById($id)
  {
    # code...
  }

  public function getNewInbox($uid)
  {
    $user = $this->user->find($uid);
    return $user->documents()->where('type','=',0)->where('document_user.state','=',0)->count();
  }

  public function getNewOutbox($uid)
  {
    $user = $this->user->find($uid);
    return $user->documents()->where('type','=',1)->where('document_user.state','=',0)->count();
  }

  public function getNewAuditBox($uid)
  {
    $user = $this->user->find($uid);
    return $user->documents()->where('type','=',2)->where('document_user.state','=',0)->count();
  }

  public function getAuditedBox($uid)
  {
    $user = $this->user->find($uid);
    return $user->documents()->where('type','=',2)->where('document_user.state','=',1)->count();
  }

  public function getSigned($uid)
  {
    $user = $this->user->find($uid);
    return $user->documents()->where('type','=',0)->where('document_user.state','=',1)->count();
  }

public function getInboxRelate($doc_id,$uid)
{
   return $this->getRelateState($doc_id,$uid);
}
public function getOutboxRelate($doc_id,$uid)
{
   return $this->getRelateState($doc_id,$uid,1);
}
public function getAuditboxRelate($doc_id,$uid)
{
   return $this->getRelateState($doc_id,$uid,2);
}
  /**
   * 获取document_user表中的用户文档状态
   * @param  [type]  $doc_id [文档号]
   * @param  [type]  $uid    [用户id]
   * @param  integer $type   [0:收件箱 1:发件箱 2:收到审批 3:发出审批]
   * @return [string]          [description]
   */

  protected function getRelateState($doc_id,$uid,$type=0)
  {
    $state = \DB::table('document_user')
        ->select('state')
        ->where('document_user.type','=',$type)
        ->where('user_id','=',$uid)
        ->where('document_id','=',$doc_id)
        ->first();
    return $state->state;
  }

  public function getState($id)
  {
    return $this->document->find($id)->state;
  }

  /**
   * 创建新公文
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  public function create(array $data)
  {

    $user = \Sentry::getUser()->username;
    $document = $this->document->create(
      array(
       'subject' => $data['subject'],
       'category' =>$data['category'],
       'docnumber' =>$data['docnumber'],
       'seclevel' =>$data['seclevel'],
       'priority' =>$data['priority'],
       'sender_id' =>$data['sender_id'],
       'creDep' =>$data['creDep'],
       'leader' =>$data['recievers'],
       'filePath' =>$data['filepath'],
       'content' =>$data['content']
       )
      );
    //写入document_user表
    $arrTo = explode(',', $data['recievers']);
    //DocumentController已传递给DocumentForm一个sender_id值
    $uid = $data['sender_id'];
    $document->users()->attach($uid,array(
        'type'=>1 //1为发件
        ));

    $recievers=array();
    foreach ($arrTo as $key=>$val)
    {
      $recievers[$key] = \Sentry::findUserById($val)->username;
      $document->users()->attach($val,array(
        'sender_id'=>$data['sender_id'],
        'type'=>2 //0为收件,1为发件，2为审批
        ));
    }
    $recieverStr = implode(',', $recievers);
    //不成功返回false
    if (!$document) {
      return false;
    }
    //文档一经创建，需要同时写入：
    //tags,document_tag,messages,user_message,user_document,events,公文转换

    $this->syncTags($document,$data['tags']); //同步tags

    //同步messages message_user 表,调用同步方法
    $this->syncMessages($data['message'],$data['sender_id'],$arrTo);
    //发送短信
    // $this->sendSms($arrTo,1);

    //给docflow表写入comment(该字段功能不同于comments表，后者仅为签收记录)
    if (\Input::get('message')=='') {
       $event_comment= '我淘气地发送了一篇公文';
     }else{
       $event_comment= e(\Input::get('message'));
     }
    $this->syncEvent($document,0,$user,$event_comment,$recieverStr);
    return true;
  }

  public function update(array $data)
    {
        $user = \Sentry::getUser()->username;
        $document = $this->document->find($data['id']);
        $document->subject = $data['subject'];
        $document->category = $data['category'];
        $document->docnumber = $data['docnumber'];
        $document->seclevel = $data['seclevel'];
        $document->priority = $data['priority'];
        $document->creDep = $data['creDep'];
        $document->state = 0;
        $document->leader = $data['recievers'];
        if (!$data['filepath']=='') {
        $document->filePath = $data['filepath'];
        }
        $document->content = $data['content'];
        $document->save();
        $arrTo = explode(',', $data['recievers']);
        $this->syncTags($document,$data['tags']); //同步tags
        //写入document_user表
        $arrTo = explode(',', $data['recievers']);
        foreach ($arrTo as $val)
        {
                    $document->users()->detach($val,array(
            'sender_id'=>$data['sender_id'],
            'type' => 2
            ));
          $document->users()->attach($val,array(
            'sender_id'=>$data['sender_id'],
            'type' => 2
            ));
        }

        //同步messages message_user 表,调用同步方法
        $this->syncMessages($data['message'],$data['sender_id'],$arrTo);

      //发送短信
      // $this->sendSms($arrTo,1);

    //给docflow表写入comment(该字段功能不同于comments表，后者仅为签收记录)
    if (\Input::get('message')=='') {
       $event_comment= '我淘气地发送了一篇公文';
     }else{
       $event_comment= e(\Input::get('message'));
     }
        $this->syncEvent($document,0,$user,$event_comment);

            return true;
  }

  /**
   * 获取用户发件箱
   * @param  [type] $uid [description]
   * @return [type]      [description]
   */
  public function getInBox($uid)
  {
    $user = $this->user->find($uid);
    // $results = $user->documents()->where('document_user.type','=',1);  //Laravel 写法
    $results = $this->user
    ->leftJoin('document_user','users.id','=','document_user.user_id')
    ->leftJoin('documents','documents.id','=','document_user.document_id')
    ->where('document_user.type','=',0)
    ->where('document_user.user_id','=',$uid)
    ->select('documents.id','subject','docnumber','document_user.state','category','creDep','documents.created_at');
    return $results;
  }

  /**
   * 获取用户发件箱
   * @param  [type] $uid [description]
   * @return [type]      [description]
   */
  public function getOutBox($uid)
  {
    $user = $this->user->find($uid);
    $results = $this->user->leftJoin('document_user','users.id','=','document_user.user_id')
    ->leftJoin('documents','documents.id','=','document_user.document_id')
    ->where('document_user.type','=',1)
    ->where('document_user.user_id','=',$uid)
    ->select('documents.id','subject','docnumber','documents.state','category','creDep','documents.created_at');
    return $results;
  }

  /**
   * 获取领导组用户批示箱
   * @param  [type] $uid [description]
   * @return [type]      [description]
   */
  public function getAuditBox($uid)
  {
    $results = $this->user->where('users.id','=',$uid)
    ->leftJoin('document_user','users.id','=','document_user.user_id')
    ->leftJoin('documents','documents.id','=','document_user.document_id')
    ->where('document_user.type','=',2)
    ->select('documents.id','subject','docnumber','documents.state','category','creDep','documents.created_at');
    return $results;
  }

  /**
   * 领导提交审阅/拟办意见
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function postAudit($id)
  {
     $doc = $this->document->find($id);
     $author = $doc->sender_id;
     $user = \Sentry::getUser()->username;
     $phone = $this->user->find($author)->phone;
     $from = \Sentry::getUser()->id;
     $comment = new \Comment;
     $msg = '您的公文通过审批';
     $comment->user_id = $from;
     if (\Input::get('comment')=='') {
       $comment->comment= '已审阅';
     }else{
       $comment->comment= e(\Input::get('comment'));
     }
     $docflow = new \Docflow;
     $docflow->document_id = $id;

    //给docflow表写入comment(该字段功能不同于comments表，后者仅为签收记录)
    if (\Input::get('message')=='') {
       $event_comment= '已审阅';
     }else{
       $event_comment= e(\Input::get('message'));
     }

     if (\Input::has('doc_pass')) {
      $doc->state = 1;
      $this->syncEvent($doc,1,$user,$event_comment);
      $msg = "您的公文通过审批";
      $doc->save();
      $doc->users()->where('user_id','=',$from)->update(array('document_user.state'=>1));
    }
    elseif (\Input::has('doc_cancel')) {
      $doc->state = 2;
      $this->syncEvent($doc,2,$user,$event_comment);
      $msg = "您的公文被审批退回";
      $doc->save();
      $doc->users()->where('user_id','=',$from)->update(array('document_user.state'=>2));
    }
    elseif (\Input::has('doc_preAudit')) {
      $doc->state = -1;
      $this->syncEvent($doc,7,$user,$event_comment);
      $msg = "您的公文有了拟办意见";
      $doc->save();
      $doc->users()->where('user_id','=',$from)->update(array('document_user.state'=>-1));
    }
    $doc->comments()->save($comment);
    $this->syncMessages($msg,$from,$author);


    // $this->sendSms($phone,2);
    return true;
  }

  public function postSign($id)
  {
     $doc = $this->document->find($id);
     $uid = \Sentry::getId();
     $user = \Sentry::getUser()->username;
     $from = \Sentry::getUser()->id;
     $comment = new \Comment;
     $comment->user_id = $from;
     $doc->state = 3;
     if (\Input::get('comment')=='')
     {
       $comment->comment= '已签收';
     }
     else{
       $comment->comment= e(\Input::get('comment'));
     }
     $docflow = new \Docflow;
     $docflow->document_id = $id;
     $toAddModel = \DB::table('document_user')
                                ->where('user_id','=',$uid)
                                ->where('document_id','=',$id);
     $toAddModel->update(array('state' => 2));

    //给docflow表写入comment(该字段功能不同于comments表，后者仅为签收记录)
    if (\Input::get('message')=='') {
       $event_comment= '未提异议';
     }else{
       $event_comment= e(\Input::get('message'));
     }
     $this->syncEvent($doc,4,$user,$event_comment);
     $doc->comments()->save($comment);

  }


    public function postDone($id)
    {
       $doc = $this->document->find($id);
       $uid = \Sentry::getId();
       $user = \Sentry::getUser()->username;
       $from = \Sentry::getUser()->id;
       $comment = new \Comment;
       $comment->user_id = $from;
       if (\Input::get('comment')=='')
       {
         $comment->comment= '已成功办结';
       }
       else{
         $comment->comment= e(\Input::get('comment'));
       }
       $docflow = new \Docflow;
       $docflow->document_id = $id;
       $doc->state = 4;
       $doc->save();
       $doc->comments()->save($comment);

    //给docflow表写入comment(该字段功能不同于comments表，后者仅为签收记录)
    if (\Input::get('message')=='') {
       $event_comment= '任务顺利完成，感谢领导及同仁们支持！';
     }else{
       $event_comment= e(\Input::get('message'));
     }
       $this->syncEvent($doc,5,$user,$event_comment);

    }

    public function redirect($doc_id,$arrTo)
  {

    $uid = \Sentry::getId();
    $user = \Sentry::getUser()->username;
    $strMainsend = implode(',', $arrTo); //将传过来的数组变成字符写入mainSend
    $document = $this->document->find($doc_id);
    $document->mainSend = $strMainsend;
    $document->state = 3;
    $recievers=array();

    foreach ($arrTo as $key => $val)
    {
      $document->users()->attach($val,array('sender_id'=>$uid));
      $recievers[$key] = \Sentry::findUserById($val)->username;
    }
    $document->save();

    //给docflow表写入comment(该字段功能不同于comments表，后者仅为签收记录)
    if (\Input::get('message')=='') {
       $event_comment= '新公文请注意查收';
     }else{
       $event_comment= e(\Input::get('message'));
     }
    $this->syncEvent($document,3,$user,$event_comment,implode(',', $recievers));
    $msg = "有新的公文请您签收";
    $this->syncMessages($msg,$uid,$arrTo);
      // $this->sendSms($arrTo,2);
    return true;

  }

  /**
   * 同步TAGS
   * @param  Model  $document [description]
   * @param  array  $tags     [description]
   * @return [type]           [description]
   */
  protected function syncTags(Model $document,array $tags)
  {
    //确定当前的tag是已有还是需要新建,参考EloquentTag
    $found = $this->tag->findOrCreate($tags);
    $tagIds = array();

    foreach ($found as $tag)
    {
      $tagIds[] = $tag->id;
    }
                 //调用Model中的tags方法写入id
    $document->tags()->sync($tagIds);
  }

  /**
   * 同步消息表
   * @param  [type] $messages [description]
   * @param  [type] $from     [description]
   * @param  [type] $arrTo    [description]
   * @return [type]           [description]
   */
  protected function syncMessages($messages,$from,$arrTo)
  {
    $insertMsg = $this->message->create(array(
      'content'=>'您收到了新的公文',
                        'sender' =>$from//DocumentController中定义的当前用户id
                        ));

    $toAddMessageModel = $this->message->find($insertMsg->id);
    if (is_array($arrTo))
    {
      foreach ($arrTo as $val)
      {
        $toAddMessageModel->users()->attach($val,array('sender_id'=>$from));
      }
    }else{
      $toAddMessageModel->users()->attach($arrTo,array('sender_id'=>$from));
    }
  }

/**
 * 同步docflows表
 * @param  Model  $document [document Model]
 * @param  [type] $state_id [获取不同状态返回不同记录值]
 * @param  [type] $user     [激发事件的用户]
 * @param  [type] $comment  [不是comments表的内容,而是event_comment]
 * @param  string $memo     [备注]
 * @return [type]           [description]
 */
  protected function syncEvent(Model $document,$state_id,$user,$comment,$memo='')
  {
    $newflow =  $this->docflow;
    $newflow->document_id = $document->id;
    $newflow->type = $state_id;
    $newflow->comments=$comment;
    switch ($state_id) {
      case '0':
      $newflow->event=$user."  登记该文档,并发送至".$memo.'审批';
      break;

      case '1':
      $newflow->event=$user."  审批通过该文档";
      break;

      case '2':
      $newflow->event=$user."  审批驳回该文档";
      break;

      case '3':
      $newflow->event=$user."  签发该文档至:".$memo;
      break;

      case '4':
      $newflow->event=$user."  签收该文档";
      break;

      case '5':
      $newflow->event=$user."  将该文档设为'办结'";
      break;

      case '6':
      $newflow->event=$user."  将该文档归档";
      break;

      case '7':
      $newflow->event=$user."  批示拟办意见";
      break;
    }
    $newflow->save();
  }
  /**
   * 发送短信
   * @param  [type] $arrTo [description]
   * @param  [type] $type  [description]
   * @return [type]        [description]
   */
  protected function sendSms($arrTo,$type)
  {

        if (is_array($arrTo))
        {
             for ($i=0; $i < count($arrTo); $i++)
             {
                $this->sms->sendSms( $this->user->find($arrTo[$i])->phone,$type);
              }
        }else{
            $this->sms->sendSms($arrTo,$type);
      }
  }

}