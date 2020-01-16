<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $table = 'settings';

    protected $primaryKey = 'key';

    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'description',
    ];
}
