<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectList extends Model
{
    use HasFactory;

    protected $table = 'lists';
    protected $guarded = [''];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'list_id', 'id');
    }
}
