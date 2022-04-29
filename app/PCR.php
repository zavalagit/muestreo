<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCR extends Model
{
    protected $table = 'pcrs';
    protected $guarded = ['user_id','proceso_id'];
}
