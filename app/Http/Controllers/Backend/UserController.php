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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index($role = null)
    {
        $userModel = new User();
        $users = $userModel->all();
        $countUser = count($users);
        if ($role != null) {
            $role = Sentinel::findRoleBySlug($role);
            $users = $userModel->whereIn('role_id', [$role['_id']])->get();
        }

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
        $roles = Role::all();

        return view('layout.backend.user.index')
            ->with(array(
                'countUser' => $countUser,
                'users' => $users,
                'roles' => $roles
            ));
    }

    public function add($userID = null)
    {
        $roles = Role::all();
        $user = Sentinel::findById($userID);
        return view('layout.backend.user.add')
            ->with(array(
                'roles' => $roles,
                'user' => $user
            ));
    }

    public function save($userID = null)
    {
        $status = false;
        $notification = '';
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        );
        if (!Validator::make(Input::all(), $rules)->fails()) {
            $roles = Input::has('roles') ? Input::get('roles') : array('member');
            $credentials = (array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'email' => Input::get('email'),
                'password' => Input::get('password')
            ));
            if ($userID == null) {
                if (Sentinel::findByCredentials(['login' => Input::get('email')]) === null) {
                    $user = Sentinel::register($credentials);
                    $activation = Activation::create($user);
                    if (Activation::complete($user, $activation['code'])) {
                        Mail::send('email.adduser', [
                            'email' => $user['email'],
                            'first_name' => $user['first_name'],
                            'password' => Input::get('password')
                        ], function ($message) {
                            $message->from('hanoi@gmail.com', trans('email.name'));
                            $message->sender('hanoi@gmail.com', trans('email.name'));
                            $message->to(Input::get('email'), Input::get('first_name'));
                            $message->subject(trans('email.subject_register'));
                        });
                    } else {
                        Mail::send('email.register', [
                            'user_id' => $activation['user_id'],
                            'code' => $activation['code'],
                            'first_name' => $user['first_name'],
                            'password' => Input::get('password')
                        ], function ($message) {
                            $message->from('hanoi@gmail.com', trans('email.name'));
                            $message->sender('hanoi@gmail.com', trans('email.name'));
                            $message->to(Input::get('email'), Input::get('first_name'));
                            $message->subject(trans('email.subject_register'));
                        });
                        $notification = 'Tạo tài khoản thành công. Email kích hoạt đã được gửi.';
                    }
                    $status = true;
                    $notification = 'Tạo tài khoản thành công. Email kích hoạt đã được gửi.';
                } else {
                    $notification = 'Email này đã được đăng kí. Xin hãy kiểm tra lại.';
                }
            } else {
                $user = Sentinel::update(Sentinel::findById($userID), $credentials);
                $userRoles = $user['role_id'];
                foreach ($userRoles as $userRole) {
                    $role = Sentinel::findRoleById($userRole);
                    $role->users()->detach($user);
                }
            }
            if (isset($user)) {
                foreach ($roles as $role) {
                    Sentinel::findRoleBySlug($role)->users()->attach($user);
                }
                return Redirect::route('admin::user::index')->with(array(
                    'status' => $status,
                    'notification' => $notification
                ));
            }
        } else {
            $notification = 'Có lỗi xảy ra.';
        }
        return Redirect::back()->with(array(
            'status' => $status,
            'notification' => $notification
        ));
    }

    public function delete($userID)
    {
        $status = false;
        $user = Sentinel::findById($userID);
        $user->delete();
        if (!Sentinel::findById($userID)) {
            $status = true;
            $notification = 'Đã xóa tài khoản ' . $user['email'];
        } else {
            $notification = 'Có lỗi không thể xóa. Hãy thử lại!';
        }

        return [
            'user' => $user,
            'status' => $status,
            'notification' => $notification
        ];
    }

    public function login()
    {
        $status = false;
        $input = Input::all();
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:8'
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
                    $notification = trans('general.Email or Password is not correct');
                } else {
                    $status = true;
                    $notification = trans('general.Login_successful');
                }
            } catch (NotActivatedException $error) {
                $notification = trans('general.This account has not been activated');
            } catch (ThrottlingException $error) {
                $notification = trans('general.This accout is throttled.');
            }
        } else {
            $notification = trans('general.Email or Password is not invalid');
        }
        return Redirect::back()->with(array(
            'status' => $status,
            'notification' => $notification
        ));
    }

    public function signup()
    {
        $status = fales;
        $input = Input::all();
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        );
        if (!Validator::make($input, $rules)->fails()) {
            $credentials = [
                'login' => $input['email']
            ];
            if (Sentinel::findByCredentials($credentials) === null) {
                $user = Sentinel::register($input);
                $activation = Activation::create($user);
                $role = Sentinel::findRoleBySlug('member');
                $role->users()->attach($user);
                Mail::send('email.register', ['user_id' => $activation['user_id'], 'code' => $activation['code'], 'first_name' => $user['first_name']], function ($message) {
                    $message->from('hanoi@gov.vn', trans('email.name'));
                    $message->sender('hanoi@gov.vn', trans('email.name'));
                    $message->to(Input::get('email'), Input::get('first_name'));
                    $message->subject(trans('email.subject_register'));
                });
                $notification = 'Đăng ký thành công.';
            } else {
                $notification = 'Email này đã được đăng ký. <br/>Vui lòng thử đăng nhập lại.';
            }
        } else {
            $notification = 'Đăng ký không thành công. <br/>Vui lòng nhập vào những ô bắt buộc.';
        }
        return Redirect::back()->with(array(
            'status' => $status,
            'notification' => $notification
        ));
    }

    public function activation($user_id, $code)
    {
        $user = Sentinel::findById($user_id);
        if (Activation::exists($user)) {
            if (Activation::complete($user, $code)) {

            } else {

            }
        } else {

        }
    }
}