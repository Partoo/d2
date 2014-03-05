<?php
namespace Istar\Service\Form\Document;

use Istar\Service\Validation\IValidation;
use Istar\Repo\Document\IDocument;
use App\Libs\Unoconv;

/**
 * DocumentForm
 */

class DocumentForm {
    /**
     * 表单的数值
     * @var array
     */
    protected $data;

    /**
     * Validator
     * @var \Istar\Form\Service\IValidation
     */
    protected $validator;

    /**
     * Document Repository
     * @var \Istar\Repo\Document\IDocument
     */
    protected $document;

    function __construct(IValidation $validator,IDocument $document)
    {
        $this->validator = $validator;
        $this->document = $document;
    }

    /**
     * 保存文档
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function save(array $input)
    {
        if (!$this->valid($input))
        {
            return false;
        }
        $input['tags'] = $this->processTags($input['tags']);
        $input['recievers'] = $this->processRecivers($input['recievers']);
        if (($input['files'][0]==NULL)) {
            $input['filepath'] = '';
        }else{
            $input['filepath'] = $this->processUpload($input['sender_id'],$input['files']);
        }

        return $this->document->create($input);
    }

    /**
     * 修改公文
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function update(array $input)
    {

        $input['tags'] = $this->processTags($input['tags']);
        $input['recievers'] = $this->processRecivers($input['recievers']);
        if (($input['files'][0]==NULL)) {
            $input['filepath'] = '';
        }else{
            $input['filepath'] = $this->processUpload($input['sender_id'],$input['files']);
        }
        return $this->document->update($input);
    }

    /**
     * 报错处理
     * @return [type] [description]
     */
    public function errors()
    {
        return $this->validator->errors();
    }

    /**
     * 验证表单
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    protected function valid(array $input)
    {
        return $this->validator->with($input)->passed();
    }

    /**
     * 处理TAGS
     * @param  [type] $tags [description]
     * @return [type]       [description]
     */
    protected function processTags($tags)
    {
        $tags = preg_split('/[\s,;]+/',$tags);

        foreach( $tags as $key => $tag )
        {
            $tags[$key] = trim($tag);
        }

        return $tags;
    }


    /**
     * 处理上传
     * @param  [type] $userId [description]
     * @param  [type] $files  [description]
     * @return [type]         [description]
     */
    protected function processUpload($userId,$files)
    {
        $destinationPath = 'uploads/'.$userId.'/'.date('Ymd');
        $filepath='';
        for ($i=0; $i <count($files) ; $i++) {
            $filename = date('YmdHis').rand(100,999).'.'.$files[$i]->getClientOriginalExtension();
            $uploadSuccess = $files[$i]->move($destinationPath,$filename);
            $path = $destinationPath.'/'.$filename;
            Unoconv::convertToHTML($path,$destinationPath);
            $htmlpath = $destinationPath.'html';
            $filepath .= $path.',';
        }
        return $filepath;
    }

    /**
     * 将表单中发送者id处理成形如 2,3 的字符串
     * @param  [type] $recivers [传过来的表单数据 input['leader']]
     * @return string  用于直接写入数据库字段 mainSend 或 leader
     */
    protected function processRecivers($recivers)
    {
        return implode(',',$recivers);
    }

}