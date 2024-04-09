<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'thumb',
        'descriptions',
        'languages',
        'type_id',
        'slug',
    ];

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }

    //one to many
    public function type(): BelongsTo{

        return $this->belongsTo(Type::class);
    }

    //many to many
    public function technologies(): BelongsToMany{

        return $this->belongsToMany(Technology::class);
    }
}
