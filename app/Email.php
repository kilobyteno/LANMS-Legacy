<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Email extends Model
{

    use LogsActivity;

    protected $fillable = [
        'subject',
        'content',
        'author_id',
    ];
    protected $table = 'emails';

    protected static $logName = 'email';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'subject',
        'content',
        'author_id',
    ];

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id');
    }

    /**
     * Get the users for the email.
     */
    public function users()
    {
        return $this->belongsToMany('LANMS\User');
    }
}
