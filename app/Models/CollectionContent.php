<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'collection_id', 'title', 'description', 'image'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
