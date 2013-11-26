<?php
namespace Istar\Repo\Document;


/**
 * IDocument
 */

interface IDocument {


        public function getById($id);//按id遍历

        public function getByTag($tag); //按tag遍历

        public function create(array $data);//创建新公文

        public function getInbox($uid); //收件箱，归档(state==5)不显示

        public function getOutbox($uid);//发件箱

        // public function getByStatus($id); //获取某个状态的公文

        public function getAuditBox($uid);//获取待批的公文

        public function getAllAudit();//获取所有审批公文

        public function getAuditById($id);//获取指定某个待批公文

        public function getNewInbox($uid); //获取某用户收件箱未处理数量

        public function getNewOutbox($uid); //获取某用户发件箱未处理数量

        // public function redirect($doc_id,$arrTo);


        // 管理员用

        public function getAll();

        // public function postComment($id);//处理提交评论



}