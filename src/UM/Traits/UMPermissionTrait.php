<?php
namespace IvanCLI\UM\Traits;

use Illuminate\Support\Facades\Config;

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18/02/2017
 * Time: 11:39 PM
 */
trait UMPermissionTrait
{

    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('um.role'), Config::get('um.permission_role_table'));
    }

    public function childPerms()
    {
        return $this->hasMany(Config::get('um.permission'), 'parent_id', 'id');
    }

    public function parentPerm()
    {
        return $this->belongsTo(Config::get('um.permission'), 'parent_id', 'id');
    }

    /**
     * Boot the permission model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the permission model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($permission) {
            if (!method_exists(Config::get('um.permission'), 'bootSoftDeletes')) {
                $permission->roles()->sync([]);
            }
            return true;
        });
    }
}