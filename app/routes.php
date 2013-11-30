<?php
use App\Libs\Sms;


Route::get('/',function(){
  return Redirect::to('home');
});
// login
Route::get('login',array('as'=>'login','uses'=>'AuthController@getLogin'));
Route::post('login','AuthController@postLogin');
// logout
Route::get('logout',array('as'=>'logout','uses'=>'AuthController@getLogout'));
// email signup
Route::get('signUp',array('as'=>'signUp','uses'=>'AuthController@signUp'));
Route::post('signUp','AuthController@postSignUp');
// mobile signup
Route::get('mobileSignUp', array('as'=>'mobileSignUp','uses'=>'AuthController@mobileSignUp'));
Route::post('mobileSignUp','AuthController@postMobileSignUp');
# Account Activation
Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
//Send authcode to mobile
// Route::get('sendSms/{phone}',array('as'=>'sendSms','uses'=>'AuthController@sendSms'));
  // Forgot Password
Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPsw'));
Route::post('forgot-password', 'AuthController@postForgotPsw');
Route::post('forgot-password-mail', 'AuthController@postMailForgotPsw');

  // Forgot Password Confirmation
Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

//Home Route Group
Route::group(array('prefix' => 'home'), function()
{
 Route::get('/',array('as'=>'home','uses'=>'DocumentsController@index'));

 Route::get('documents',array('as'=>'documents','uses'=>'DocumentsController@index'));
 Route::get('documents/api_index',array('as'=>'api_index','uses'=>'DocumentsController@api_index'));

 Route::get('documents/inbox',array('as'=>'inbox','uses'=>'DocumentsController@inbox'));
 Route::get('documents/outbox',array('as'=>'outbox','uses'=>'DocumentsController@outbox'));

 Route::get('documents/audit',array('as'=>'audit','before'=>'leader','uses'=>'DocumentsController@auditHome'));
 Route::get('documents/api_audit',array('as'=>'api_audit','before'=>'leader','uses'=>'DocumentsController@api_audit'));
 Route::get('documents/audit/{id}',array('before'=>'auditShow','uses'=>'DocumentsController@audit'));
 Route::post('documents/audit/{id}','DocumentsController@handleAudit');

 Route::get('documents/show/{id}',array('before'=>'docShow','uses'=>'DocumentsController@show'));
 Route::post('documents/show/{id}', 'DocumentsController@handleDocument');

 Route::get('documents/create','DocumentsController@create');
 Route::post('documents/create','DocumentsController@store');

 Route::get('documents/api_inbox',array('as'=>'api_inbox','uses'=>'DocumentsController@api_inbox'));
 Route::get('documents/api_outbox',array('as'=>'api_outbox','uses'=>'DocumentsController@api_outbox'));

 Route::get('documents/edit/{id}',array('before'=>'senderOnly','as'=>'edit','uses'=>'DocumentsController@edit'));
 Route::post('documents/edit/{id}','DocumentsController@update');

//公文跟踪
 Route::get('documents/showTimeLine/{id}','DocumentsController@docflow');

//转发
 Route::get('documents/redirect/{id}',array('before'=>'senderOnly','as'=>'redirect','uses'=>'DocumentsController@redirect'));
 Route::post('documents/redirect/{id}','DocumentsController@handleRedirect');

 //办结
 Route::get('documents/done/{id}',array('before'=>'senderOnly','as'=>'done','uses'=>'DocumentsController@done'));
 Route::post('documents/done/{id}','DocumentsController@handleDone');

 //搜索
 //按tag搜索
 Route::get('documents/search/tag/{id}', 'DocumentsController@searchByTag');

});



Route::group(array('prefix' => 'account'), function()
{
  # Account Dashboard
  Route::get('/', array('as' => 'account', 'uses' => 'account\ProfileController@dashboard'));

  # Profile
  Route::get('profile', array('as' => 'profile', 'uses' => 'account\ProfileController@index'));
  Route::get('new-profile','account\ProfileController@create');
  Route::post('profile', 'account\ProfileController@changeProfile');

  # Change Password
  Route::post('change-password', 'account\ProfileController@changePassword');

  # Change Email
  Route::post('change-email','account\ProfileController@changemail');

    # Change Name
  Route::post('change-name','account\ProfileController@changename');

    # Change Mobile
  Route::post('change-phone', 'account\ProfileController@changephone');

    # Change Unit
  Route::post('change-unit', 'account\ProfileController@changeunit');

});



Route::group(array('prefix'=>'admin'),function(){
    # Document Management
  Route::group(array('prefix' => 'docs'), function()
  {
    Route::get('/', array('as' => 'docs', 'uses' => 'admin\DocsController@index'));
    Route::get('docManage',array('as'=>'docManage','uses'=>'admin\DocsController@docManage'));
    Route::get('create', array('as' => 'create/user', 'uses' => 'admin\DocsController@create'));
    Route::post('create', 'admin\DocsController@postCreate');
    Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'admin\DocsController@getEdit'));
    Route::post('{userId}/edit', 'admin\DocsController@postEdit');
    Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'admin\DocsController@getDelete'));
    Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'admin\DocsController@getRestore'));
  });
    # User Management
  Route::group(array('prefix' => 'users'), function()
  {
    Route::get('/', array('as' => 'users', 'uses' => 'admin\UsersController@index'));
    Route::get('user_index',array('as'=>'user_index','uses'=>'admin\UsersController@api_index'));
    Route::get('create', array('as' => 'create/user', 'uses' => 'admin\UsersController@create'));
    Route::post('create', 'admin\UsersController@postCreate');
    Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'admin\UsersController@getEdit'));
    Route::post('{userId}/edit', 'admin\UsersController@postEdit');
    Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'admin\UsersController@getDelete'));
    Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'admin\UsersController@getRestore'));
  });
  # Group Management
  Route::group(array('prefix' => 'groups'), function()
  {
    Route::get('/', array('as' => 'groups', 'uses' => 'admin\GroupsController@index'));
    Route::get('api_index',array('as'=>'groups_index','uses'=>'admin\GroupsController@getIndex'));
    Route::get('create', array('as' => 'create/group', 'uses' => 'admin\GroupsController@create'));
    Route::post('create', 'admin\GroupsController@store');
    Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'admin\GroupsController@show'));
    Route::get('{groupId}/api_show',array('as'=>'group_show','uses'=>'admin\GroupsController@showGroup'));
    Route::post('{groupId}/edit', 'admin\GroupsController@update');
    Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'admin\GroupsController@destroy'));
    Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'admin\GroupsController@getRestore'));
  });
  # Unit Management
  Route::group(array('prefix'=>'units'),function(){
    Route::get('/',array('as'=>'units','uses'=>'admin\UnitsController@index'));
    Route::get('create',array('as'=>'create/unit','uses'=>'admin\UnitsController@create'));
    Route::post('create', 'admin\UnitsController@store');
    Route::get('{unitId}/edit', array('as' => 'update/unit', 'uses' => 'admin\UnitsController@show'));
    Route::post('{unitId}/edit', 'admin\UnitsController@update');
    Route::get('api_index',array('as'=>'api_index','uses'=>'admin\UnitsController@getIndex'));
    Route::get('{unitId}/api_show',array('as'=>'unit_show','uses'=>'admin\UnitsController@showUnit'));
    Route::get('{unitId}/delete', array('as' => 'delete/unit', 'uses' => 'admin\UnitsController@destroy'));
  });
  #Site management
  Route::group(array('prefix'=>'site'),function(){
    Route::get('/', array('as'=>'site','uses'=>'admin\SiteController@index'));
    Route::post('/','admin\SiteController@handlePost');
  });
});

Route::post('sendSms',function(){
  $msg = new Sms;
  $num = $_POST['num'];
  $key = $_POST['key'];
  $currentKey = Session::get('mcode');
  if (md5($currentKey) == $key) {
   return $msg->sendSms($num);
 }
});


View::composer(array('_layouts.general','partials.sidebar'), function($view)
{
    $uid = Sentry::getUser()->id;
    $user = User::find($uid);
    $profile = $user->profile;
    if ($profile == NULL) {
      $avatar = 'img/avatar/noimg.gif';
    }else{
      $avatar = Profile::find($profile)->avatar;
    }
    $newInbox = DB::table('document_user')->where('user_id','=',$uid)->where('type','=',0)->where('state','=',0)->count();
    $newAuditbox = DB::table('document_user')->where('user_id','=',$uid)->where('type','=',2)->where('state','=',0)->count();
    $view->with('user',$user)
            ->with('newInbox',$newInbox)
            ->with('avatar',$avatar)
            ->with('newAuditbox',$newAuditbox);
});


