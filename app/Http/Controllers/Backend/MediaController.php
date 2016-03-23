<?php
/**
 * Created by PhpStorm.
 * User: vu
 * Date: 3/23/16
 * Time: 4:04 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
        return view('layout.backend.media.index');
    }
}