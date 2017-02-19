<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18/02/2017
 * Time: 11:32 PM
 */

namespace IvanCLI\UM\Middleware;


use Closure;
use Illuminate\Contracts\Auth\Guard;

class UMRole
{

    const DELIMITER = '|';
    protected $auth;

    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!is_array($roles)) {
            $roles = explode(self::DELIMITER, $roles);
        }
        if ($this->auth->guest() || !$request->user()->hasRole($roles)) {
            abort(403);
        }
        return $next($request);
    }
}