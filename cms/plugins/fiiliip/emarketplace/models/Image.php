<?php namespace Fiiliip\EMarketplace\Models;

use Model;
use Storage;

/**
 * Image Model
 */
class Image extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'fiiliip_emarketplace_images';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = ['listing_id', 'image_path'];

    /**
     * @var array rules for validation
     */
    public $rules = [
        'listing_id' => 'required',
        'image_path' => 'required'
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
    public $hasOne = [
        // 'listing' => ['Fiiliip\EMarketplace\Models\Listing']
    ];
    public $hasMany = [];
    public $belongsTo = [
        'listing' => ['Fiiliip\EMarketplace\Models\Listing']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'image' => ['System\Models\File', 'delete' => true]
    ];
    public $attachMany = [];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            unlink(storage_path($image->image_path));
            // Storage::delete($image->image_path);
            // Storage::delete($image->image->getPath());
        });
    }
}
