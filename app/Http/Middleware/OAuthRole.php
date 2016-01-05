<?php

namespace BenditaFome\Http\Middleware;

use BenditaFome\Repositories\UserRepository;
use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthRole
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $id   = Authorizer::getResourceOwnerId();
        $user = $this->repository->find($id);

        if ($user->role != $role)
            abort(403, 'Access Forbidden');

        return $next($request);
    }
}
