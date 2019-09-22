<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BrokenBand extends Model
{
    use LogsActivity;

    protected $table = 'broken_bands';

    protected $fillable = [
        'checkin_id',
        'previous_bandnumber',
        'new_bandnumber',
        'year',
        'author_id',
        'editor_id',
    ];

    protected static $logName = 'broken_band';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'checkin_id',
        'previous_bandnumber',
        'new_bandnumber',
    ];

    public function scopeThisYear($query)
    {
        return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
    }

    public function scopeLastYear($query)
    {
        return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
    }
}
