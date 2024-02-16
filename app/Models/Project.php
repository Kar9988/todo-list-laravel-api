<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    protected $guarded = [''];

    public function lists(): HasMany
    {
        return $this->hasMany(ProjectList::class);
    }

    public function listCards(): HasManyThrough
    {
        return $this->hasManyThrough(Card::class, ProjectList::class, 'id', 'list_id');
    }

}
