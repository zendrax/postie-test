<?php

namespace App\Http\Controllers\Api\Auth;

use App\Acme\Http\Instagram;
use App\Exceptions;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AuthorizeController
 *
 * @package App\Http\Controllers\Api\Auth
 */
class AuthorizeController extends Controller
{
    /** @var \App\Acme\Http\Instagram instagram */
    protected $instagram;

    /**
     * AuthorizeController constructor.
     */
    public function __construct(Instagram $instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'token' => [
                'required',
                'string',
            ],
        ]);

        $instagramUserData = $this->instagram->user($payload['token']);

        if (empty($instagramUserData)) {
            throw new Exceptions\Response(
                'Wrong credentials',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user = User::firstOrCreate([
            'username' => $instagramUserData['username'],
        ], [
            'name' => $instagramUserData['full_name'],
            'api_token' => $payload['token'],
        ]);

        auth()->login($user);

        if (auth()->guest()) {
            throw new Exceptions\Response(
                'Wrong credentials',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return new Response([
            'data' => [
                'token' => $payload['token'],
            ],
        ]);
    }}
