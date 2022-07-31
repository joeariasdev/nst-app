<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    // Permission slug constants
    const ROLE_INDEX_SLUG = 'role.index';
    const ROLE_SHOW_SLUG = 'role.show';
    const ROLE_CREATE_SLUG = 'role.create';
    const ROLE_EDIT_SLUG = 'role.edit';
    const ROLE_DELETE_SLUG = 'role.delete';

    // User slug constants
    const USER_INDEX_SLUG = 'user.index';
    const USER_SHOW_SLUG = 'user.show';
    const USER_CREATE_SLUG = 'user.create';
    const USER_EDIT_SLUG = 'user.edit';
    const USER_DESTROY_SLUG = 'user.destroy';

    protected $fillable = [
        'name', 'slug', 'description',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
