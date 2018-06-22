<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes,
        Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'barcode',
        'name',
        'description',
        'uom_id',
        'price',
        'quantity',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The model rules.
     *
     * @var array
     */
    public static $rules = [
        'barcode' => 'required|unique:products,barcode',
        'name' => 'required',
        'uom_id' => 'required|numeric',
        'price' => 'required',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'barcode' => $this->barcode,
            'unit_of_measure_name' => $this->uom->name,
            'unit_of_measure_abbreviation' => $this->uom->abbreviation,
        ];
    }

    public function uom()
    {
        return $this->belongsTo(UnitOfMeasure::class)->withDefault([
            'name' => '-',
            'abbreviation' => '-',
        ]);
    }
}
