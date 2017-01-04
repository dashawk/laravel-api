<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class PasswordGrant
{
    private $client;

    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $client = $this->client->find(env('AUTH_CLIENT_ID'));

        if($client === null) {
            throw (new ModelNotFoundException)->setModel(Client::class);
        }

        $query = [
            'grant_type' => 'password',
            'client_id' => env('AUTH_CLIENT_ID'),
            'client_secret' => $client->secret
        ];

        $request->request->add($query);

        return $next($request);
    }

}
