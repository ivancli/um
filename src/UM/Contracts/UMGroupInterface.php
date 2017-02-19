<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19/02/2017
 * Time: 3:47 PM
 */

namespace IvanCLI\UM\Contracts;


interface UMGroupInterface
{
    /**
     * Many-to-Many relations with user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();
}