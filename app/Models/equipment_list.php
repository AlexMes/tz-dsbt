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


class equipment_list extends Model
{
    use Notifiable, AsSource, Filterable, Chartable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'equipment_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'equipment_type_id',
        'serial_number',
        'inventory_number',
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
        /*'permissions'          => 'array',
        'email_verified_at'    => 'datetime',*/
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'equipment_type_id',
        'serial_number',
        'inventory_number',
        'updated_at',
        'created_at',
    ];

    public function equipment_type_equipment_type_id()
    {
        return $this->hasOne(\App\Models\equipment_type::class, 'id', 'equipment_type_id')->withDefault();
    }



}
