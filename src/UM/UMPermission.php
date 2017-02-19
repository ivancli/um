<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18/02/2017
 * Time: 10:01 PM
 */

namespace IvanCLI\UM;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use IvanCLI\UM\Contracts\UMPermissionInterface;
use IvanCLI\UM\Traits\UMPermissionTrait;

class UMPermission extends Model implements UMPermissionInterface
{
    use UMPermissionTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;
    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('um.permissions_table');
    }
}