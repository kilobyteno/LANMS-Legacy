<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'ticket_types';

    protected $fillable = [
        'title',
    ];

    protected static $logName = 'ticket_type';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'title',
    ];

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id');
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id');
    }
}
