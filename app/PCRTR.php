<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCRTR extends Model
{
    protected $table = 'pcrtrs';
    protected $guarded = ['user_id'];
}
