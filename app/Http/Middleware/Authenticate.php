<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    private $guards;

    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        $this->authenticate($request, $guards);

        return $next($request);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(!empty($this->guards) && $this->guards[0] == 'admin') {
                return  route('back.login.show');
            }

            return route('login');
        }
    }
}
