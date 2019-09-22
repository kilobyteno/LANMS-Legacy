<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'subject',
        'content',
        'author_id',
    ];
    protected $table = 'emails';

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
