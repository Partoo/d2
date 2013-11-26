<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    //是否进入维护模式
        if ( Sentry::check())
        {
            if (!Sentry::getUser()->hasAnyAccess(['admin']) && !Setting::get('site.siteOn')) {
                return View::make('error.503');
            }
        }

});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	// if (Auth::guest()) return Redirect::guest('login');
    if ( ! Sentry::check())
    {
        Session::put('loginRedirect', Request::url());
        return Redirect::route('login');
    }
});

Route::filter('leader',function(){
    if ( ! Sentry::check())
    {
        Session::put('loginRedirect', Request::url());
        return Redirect::route('login');
    } elseif (! Sentry::getUser()->hasAnyAccess(['leader'])) {
     return Redirect::route('login');
 }

});

Route::filter('docShow',function(){

    if ( ! Sentry::check())
    {
        Session::put('loginRedirect', Request::url());
        return Redirect::route('login');
    }else{

        $uid = Sentry::getUser()->id;
        $docId = Request::segment(4);
        $doc = Document::find($docId);
        $mainSend = $doc->mainSend;
        $author = $doc->sender_id;
        if (! in_array($uid,explode(',',$mainSend)) && $author<>$uid && ! Sentry::getUser()->hasAnyAccess(['leader'])) {
            return Redirect::route('documents')->with('error','您当前无法查看该公文');
        }
    }
});

Route::filter('senderOnly',function(){
    if ( ! Sentry::check())
    {
        Session::put('loginRedirect', Request::url());
        return Redirect::route('login');
    }else{

        $uid = Sentry::getUser()->id;
        $docId = Request::segment(4);
        $doc = Document::find($docId);
        $mainSend = $doc->mainSend;
        $author = $doc->sender_id;
        if ($author<>$uid) {
            return Redirect::route('documents')->with('error','您当前无法查看该公文');
        }
    }
});
Route::filter('auditShow',function(){

    if ( ! Sentry::check())
    {
        Session::put('loginRedirect', Request::url());
        return Redirect::route('login');
    }else{
        $uid = Sentry::getUser()->id;
        $docId = Request::segment(4);
        $doc = Document::find($docId);
        $leader = $doc->leader;
        $author = $doc->sender_id;
        if (! in_array($uid,explode(',',$leader)) && $author<>$uid && ! Sentry::getUser()->hasAnyAccess(['viewer'])) {
            return Redirect::route('documents')->with('error','您当前无法查看该公文');
        }
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});


Route::filter('admin-auth', function()
{
    // Check if the user is logged in
    if ( ! Sentry::check())
    {
        // Store the current uri in the session
        Session::put('loginRedirect', Request::url());

        // Redirect to the login page
        return Redirect::route('login');
    }

    // Check if the user has access to the admin page
    if ( ! Sentry::getUser()->hasAccess('admin'))
    {
        // Show the insufficient permissions page
        return App::abort(403);
    }
});
/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});