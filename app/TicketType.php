<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketType extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];
    protected $table = 'ticket_types';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'color',
        'allow_entrance_payment',
        'active',
        'editor_id',
        'author_id',
    ];

    protected static $logName = 'tickettype';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'title',
        'slug',
        'description',
        'price',
        'color',
        'allow_entrance_payment',
        'active',
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
