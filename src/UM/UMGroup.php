<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19/02/2017
 * Time: 3:50 PM
 */

namespace IvanCLI\UM;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use IvanCLI\UM\Contracts\UMGroupInterface;
use IvanCLI\UM\Traits\UMGroupTrait;

class UMGroup extends Model implements UMGroupInterface
{
    use UMGroupTrait;

    protected $table;

    public function __construct(array $attribute = [])
    {
        parent::__construct($attribute);
        $this->table = Config::get('um.groups_table');
    }
}