<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereBetween;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;


class register_events extends Model
{
    use Notifiable, AsSource, Filterable, Chartable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'register_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'date',
        'from',
        'accepted',
        'equipment_id',
        'updated_at',
        'created_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        /*hiddenFieldList*/
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'date' => WhereBetween::class,

    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'date',
        'from',
        'accepted',
        'equipment_id',
        'updated_at',
        'created_at',
    ];

    public function employee_from()
    {
        return $this->hasOne(\App\Models\employee::class, 'id', 'from')->withDefault();
    }

    public function employee_accepted()
    {
        return $this->hasOne(\App\Models\employee::class, 'id', 'accepted')->withDefault();
    }

    public function equipment_list_equipment_id()
    {
        return $this->hasOne(\App\Models\equipment_list::class, 'id', 'equipment_id')->withDefault();
    }



}
