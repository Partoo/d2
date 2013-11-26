<?php

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('系统首页', route('home'));
});

Breadcrumbs::register('document', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('公文管理', route('documents'));
});

Breadcrumbs::register('inbox', function($breadcrumbs) {
    $breadcrumbs->parent('document');
    $breadcrumbs->push('我的收件箱', route('inbox'));
});

Breadcrumbs::register('outbox', function($breadcrumbs) {
    $breadcrumbs->parent('document');
    $breadcrumbs->push('我的发件箱', route('outbox'));
});

Breadcrumbs::register('create_doc', function($breadcrumbs) {
    $breadcrumbs->parent('document');
    $breadcrumbs->push('创建公文', url('home/documents/create'));
});

Breadcrumbs::register('show_doc', function($breadcrumbs,$id) {
    $breadcrumbs->parent('document');
    $breadcrumbs->push('公文详情', url('home/documents/show',$id));
});
//TODO: https://github.com/davejamesmiller/laravel-breadcrumbs/issues/18
Breadcrumbs::register('account', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('个人资料修改', route('account'));
});

Breadcrumbs::register('page', function($breadcrumbs, $page) {
    $breadcrumbs->parent('category', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});

Breadcrumbs::register('admin', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('管理页面', route('users'));
});

Breadcrumbs::register('admin.users', function($breadcrumbs) {
        $breadcrumbs->parent('admin');
       $breadcrumbs->push('管理用户', route('users'));
});
