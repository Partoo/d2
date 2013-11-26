<?php

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('系统首页', route('home'));
});

Breadcrumbs::register('document', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('公文管理', route('home.documents.index'));
});

Breadcrumbs::register('document.inbox', function($breadcrumbs) {
    $breadcrumbs->parent('home.documents');
    $breadcrumbs->push('公文管理', route('inbox'));
});

Breadcrumbs::register('document.create', function($breadcrumbs) {
    $breadcrumbs->parent('document');
    $breadcrumbs->push('创建公文', route('home.documents.create'));
});

Breadcrumbs::register('document.show', function($breadcrumbs,$document) {
    $breadcrumbs->parent('document');
    $breadcrumbs->push('公文详情', route('home.documents.show',$document->id));
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
    $breadcrumbs->push('管理', route('users'));
});

Breadcrumbs::register('admin.users', function($breadcrumbs) {
        $breadcrumbs->parent('admin');
       $breadcrumbs->push('管理用户', route('users'));
});
