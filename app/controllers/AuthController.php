<?php
use App\Libs\Sms;
class AuthController extends BaseController {
/**
 * [if login success redirect to home,else hold on. Use Sentry 2]
 * @return [type] [description]
 */
public $key;
public function getLogin()
{
          // if isLogin then redirect to home page.
    if (Sentry::check())
    {
        return Redirect::to('home');
    }

    return View::make('login');
}
/**
 * Post Login Use Partoo's sentry.
 * https://gist.github.com/Partoo/577a400ddc256e0edf4b
 * Modified
 * @return [type] [description]
 */
public function postLogin()
{

    $login = Input::get('username');
    $loginAttribute = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    Sentry::getUserProvider()->getEmptyUser()->setLoginAttributeName($loginAttribute);
    $credentials = array(
        $loginAttribute => $login,
        'password' => Input::get('password')
        );

    try
    {
        $remember = Input::get('remember-me', 0);

        $user = Sentry::authenticate($credentials, $remember);

        if ($user)
        {
                         // Get the page we were before
            $redirect = Session::get('loginRedirect', 'home');
                        // Unset the page we were before from the session
            Session::forget('loginRedirect');
            return Redirect::to($redirect);
        }
    }
    catch(\Exception $e)
    {
        return Redirect::back()->withInput()->withErrors(array('login' => $e->getMessage()));
    }
}
/**
 * getLogout
 * @return [type] [description]
 */
public function getLogout()
{
    Sentry::logout();

    return Redirect::route('login')->with('success', '你已经成功退出本系统');
}

/**
 * [signUp description]
 * @return [View page] [User signup page]
 */
public function signUp()
{
    if (Sentry::check())
    {
        return Redirect::route('home');
    }
    return View::make('signUp');
}
/**
 * [postSignUp description]
 * @return [Post signup data] [description]
 */
public function postSignUp()
{
    $rules = array(
        'email' => 'required|email|unique:users',
        'username' => 'required|min:2',
        'password'         => 'required|between:3,32',
        're-password' => 'required|same:password',
        );
        // Create a new validator instance from our validation rules
    $validator = Validator::make(Input::all(), $rules);
        // If validation fails, we'll exit the operation now.
    if ($validator->fails())
    {
        return Redirect::back()->withInput()->withErrors($validator);
    }

    try
    {
            // Register the user
        $user = Sentry::register(array(
            'username' => Input::get('username'),
            'email'      => Input::get('email'),
            'password'   => Input::get('password'),
            ));

            // Data to be used on the email view
        $data = array(
            'user'          => $user,
            'activationUrl' => URL::route('activate', $user->getActivationCode()),
            );

            // Send the activation code through email
        Mail::send('emails.register-activate', $data, function($m) use ($user)
        {
            $m->to($user->email, $user->username);
            $m->subject('欢迎您，' . $user->username);
        });

            // Redirect to the register page
        return Redirect::route('login')->with('info', '验证邮件已发送，请查看您的邮箱激活您的账号。');
    }
    catch(\Exception $e)
    {
        return Redirect::back()->withInput()->withErrors(array('signUp' => $e->getMessage()));
    }

}
        /**
     * User account activation page.
     *
     * @param  string  $actvationCode
     * @return
     */
        public function getActivate($activationCode = null)
        {
        // Is the user logged in?
            if (Sentry::check())
            {
                return Redirect::route('home');
            }

            try
            {
            // Get the user we are trying to activate
                $user = Sentry::getUserProvider()->findByActivationCode($activationCode);

            // Try to activate this user account
                if ($user->attemptActivation($activationCode))
                {
                    // 验证成功则将user_id写入profiles表中
                    // $id = $user->id;
                    // $profile = new Profile;
                    // $profile->user_id=$id;
                    // $profile->birth = date('Y-m-d');
                    // $profile->save();
                    // Redirect to the login page
                    return Redirect::route('login')->with('success', '恭喜您！您已经激活您的账号，请登录');
                }

            // The activation failed.
                $error = '账号激活失败，请查看您的邮箱，使用最新的激活地址操作';
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                $error ='账号激活失败，请查看您的邮箱，使用最新的激活地址操作';
            }

        // Ooops.. something went wrong
            return Redirect::route('login')->with('error', $error);
        }
        // START MOBILE SIGNUP
        public function mobileSignUp()
        {
            if (Sentry::check())
            {
                return Redirect::route('home');
            }
            $this->getAuthCode();
            Session::put('mcode',$this->key);
            return View::make('signUp_m');

        }
        // START MOBILE POST
        public function postMobileSignUp()
        {
            // RULES
         $rules = array(
            'phone' => 'required|integer|unique:users',
            'username' => 'required|min:2',
            'password'         => 'required|between:3,32',
            're-password' => 'required|same:password',
            );
        // Create a new validator instance from our validation rules
         $validator = Validator::make(Input::all(), $rules);
        // If validation fails, we'll exit the operation now.
         if ($validator->fails())
         {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if (Session::get('mcode') != input::get('authCode')) {
            return Redirect::back()->withInput()->withErrors(array('authCode'=>'手机验证码不正确'));
        }

        try
        {

            // Register the user
            $user = Sentry::register(array(
                'username' => Input::get('username'),
                'phone'      => Input::get('phone'),
                'password'   => Input::get('password'),
                'email' => Input::get('phone').'@istar.sys'
                ));

            // As regist via mobile ,auto activate.
            return Redirect::route('activate', $user->getActivationCode());


        }
        catch(\Exception $e)
        {
            return Redirect::back()->withInput()->withErrors(array('signUp_m' => $e->getMessage()));
        }
    }

// 获取四位随机码
    public function getAuthCode()
    {
        $msg = new Sms;
        return $this->key = $msg->getCode();
    }

    /**
     * Forgot password form processing page.
     *
     * @return Redirect
     */
    public function postForgotPsw()
    {
            // RULES
     $rules = array(
        'phone' => 'required|integer|exists:users'
        );
        // Create a new validator instance from our validation rules
     $validator = Validator::make(Input::all(), $rules);
        // If validation fails, we'll exit the operation now.
     if ($validator->fails())
     {
        return Redirect::back()->withInput()->withErrors($validator);
    }

    if (Session::get('mcode') != input::get('authCode')) {
        return Redirect::back()->withInput()->withErrors(array('authCode'=>'手机验证码不正确'));
    }
    Sentry::getUserProvider()->getEmptyUser()->setLoginAttributeName('phone');
    $user = Sentry::getUserProvider()->findByLogin(Input::get('phone'));
    $confirmUrl = 'forgot-password/'.$user->getResetPasswordCode();
    return Redirect::to($confirmUrl);
}

public function getForgotPsw()
{
   $this->getAuthCode();
   Session::put('mcode',$this->key);
   return View::make('findPsw');
}

// HERE IS EMAIL PART *********************************************
    /**
     * Forgot password form processing page.
     *
     * @return Redirect
     */
    public function postMailForgotPsw()
    {
        // Declare the rules for the validator
        $rules = array(
            'email' => 'required|email|exists:users',
            );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password')->withInput()->withErrors($validator);
        }

        try
        {
            // Get the user password recovery code
            $user = Sentry::getUserProvider()->findByLogin(Input::get('email'));

            // Data to be used on the email view
            $data = array(
                'user'              => $user,
                'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
                );

            // Send the activation code through email
            Mail::send('emails.forgot-password', $data, function($m) use ($user)
            {
                $m->to($user->email, $user->username);
                $m->subject('密码找回验证邮件');
            });
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return Redirect::route('forgot-password')->with('success', '请转至您的邮箱收取邮件');
    }
       /**
     * Forgot Password Confirmation page.
     *
     * @param  string  $passwordResetCode
     * @return View
     */
       public function getForgotPasswordConfirm($passwordResetCode = null)
       {
        try
        {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
        }
        catch(Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', '没有该用户的有效请求');
        }

        // Show the page
        return View::make('editPsw');
    }
    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param  string  $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm($passwordResetCode = null)
    {
        // Declare the rules for the form validation
        $rules = array(
            'password'         => 'required',
            're-password' => 'required|same:password'
            );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
        }

        try
        {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

            // Attempt to reset the user password
            if ($user->attemptResetPassword($passwordResetCode, Input::get('password')))
            {
                // Password successfully reseted
                return Redirect::route('login')->with('success', '密码成功更改');
            }
            else
            {
                // Ooops.. something went wrong
                return Redirect::route('login')->with('error', '密码更改不成功，请联系管理员');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', '没有该用户的有效请求');
        }
    }
}