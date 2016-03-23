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
        if (!($user = Sentinel::findById($userID))) {
            return [
                '_id' => $user['_id'],
                'name' => $user['last_name'] . ' ' . $user['first_name']
            ];
        }
        return null;
    }

}