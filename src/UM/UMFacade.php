<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18/02/2017
 * Time: 9:49 PM
 */

namespace IvanCLI\UM;


use Illuminate\Support\Facades\Facade;

class UMFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'um';
    }
}