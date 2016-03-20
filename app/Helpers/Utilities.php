<?php
/**
 * Created by PhpStorm.
 * User: manhv
 * Date: 08/03/2016
 * Time: 8:12 PM
 */

namespace App\Helpers;

use App\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class Utilities
{
    public static function getUserInfo($userID = null)
    {
        return Sentinel::findById($userID);
    }

    public static function getAllRoles() {
        return Role::all();
    }
}