<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19/02/2017
 * Time: 3:46 PM
 */

namespace IvanCLI\UM\Traits;


use Illuminate\Support\Facades\Config;

trait UMGroupTrait
{
    public function users()
    {
        return $this->belongsToMany(Config::get('um.user'), Config::get('um.group_user_table'));
    }
}