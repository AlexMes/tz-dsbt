<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

class CpcnTableFields extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;


    protected $table = 'cpcn_table_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'table_id',
        'name',
        'localization',
        'localization->name',
        'localization->description',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'localization'          => 'array',
        'type'          => 'array',
        //''    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'table_id',
        'name' => Like::class,
        'localization->name->ua',
        'localization->description->ua',
        'type',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'table_id',
        'name',
        'localization->name->ua',
        'localization->description->ua',
        'type',
    ];


}
