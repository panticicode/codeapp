<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{
	use Sluggable;
	use SluggableScopeHelpers;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
	protected $fillable = [
		'category_id',
		'photo_id',
		'title',
		'body'
	];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function photo(){
		return $this->belongsTo('App\Photo');
	}
	public function category(){
		return $this->belongsTo('App\Category');
	}
	public function comments(){
		return $this->hasMany('App\Comment');
	}
	public function photoPlaceholder(){
		return "http://placehold.it/";
	}
}
