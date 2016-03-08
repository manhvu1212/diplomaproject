<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Reminders extends Model
{
    protected $collection = 'reminders';
}
