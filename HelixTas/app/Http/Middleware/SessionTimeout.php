<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    protected $session;
    protected $timeout = 60000;

    public function __construct(Store $session)
    {

        $this->session = $session;

    }

    public function handle(Request $request, Closure $next)
    {

        $isLoggedIn = $request->path() != 'profile';

        if(! session('lastActivityTime')) {

            $this->session->put('lastActivityTime', time());

        }

        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout) {

            $this->session->forget('lastActivityTime');

            $cookie = cookie('intend', $isLoggedIn ? url()->current():'profile');

            return redirect('login');

        }

        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');

        return $next($request);

    }

}
