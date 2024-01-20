<?php namespace Fiiliip\EMarketplace\Models;

use Model;

/**
 * Listing Model
 */
class Listing extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'fiiliip_emarketplace_listings';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [
        'title',
        'price',
        'user_id',
        'category_id',
        'location',
        'description',
        'views',
    ];

    /**
     * @var array rules for validation
     */
    public $rules = [
        'title' => 'required',
        'price' => 'required',
        'user_id' => 'required',
        'category_id' => 'required',
        'location' => 'required',
        'description' => 'required',
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [
        'images' => ['Fiiliip\EMarketplace\Models\Image']
    ];
    public $belongsTo = [
        'category' => ['Fiiliip\EMarketplace\Models\Category'],
        'user' => ['RainLab\User\Models\User'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [
        'images' => ['System\Models\File']
    ];
}
