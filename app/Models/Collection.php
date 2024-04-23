<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'collections'; 
    protected $fillable = [
        'name', 'is_public', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(CollectionContent::class);
    }
    public function collectionContent()
    {
        return $this->hasMany(CollectionContent::class);
    }
}
