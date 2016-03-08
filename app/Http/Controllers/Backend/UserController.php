<?php
/**
 * Created by PhpStorm.
 * User: manhv
 * Date: 05/03/2016
 * Time: 2:30 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = (new User())->all();
        foreach ($users as &$value) {
            $user = Sentinel::findById($value->_id);
            if (Activation::exists($user)) {
                $value->activation = 0;
            } elseif (Activation::completed($user)) {
                $value->activation = 1;
            } else {
                $value->activation = -1;
            }
        }
        $roles = (new Role())->all();

        return view('layout.backend.user.index')
            ->with(array(
                'users' => $users,
                'roles' => $roles
            ));
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