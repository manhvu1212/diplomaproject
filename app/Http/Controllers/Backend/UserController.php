<?php
/**
 * Created by PhpStorm.
 * User: manhv
 * Date: 05/03/2016
 * Time: 2:30 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('layout.backend.user.index');
    }

    public function login()
    {
        $input = Input::all();
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );
        if (!Validator::make($input, $rules)->fails()) {
            $credentials = [
                'email' => $input['email'],
                'password' => $input['password'],
            ];
            $remember = isset($input['remember']) ? true : false;
            try {
                $user = Sentinel::authenticate($credentials, $remember);
                if (!$user) {
                    Session::flash('notification', trans('general.Email or Password is not correct'));
                }
            } catch (NotActivatedException $error) {
                Session::flash('notification', trans('general.This account has not been activated'));
            } catch (ThrottlingException $error) {
                Session::flash('notification', trans('general.This accout is throttled.'));
            }
        } else {
            Session::flash('notification', trans('general.Email or Password is not invalid'));
        }
        return Redirect::back();
    }

}