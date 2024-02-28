<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


//Models
use App\Models\User;

//Resources
use App\Http\Resources\UserResource;

//Requests
use App\Http\Requests\LoginRequest;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(
            'auth:api', ['except' => ['login']]
        );
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {

        try {
            
            $credentials = $request->only(['email', 'password']);

            if (!$token = auth('api')->attempt($credentials)) {
                return $this->error('Unsuccessfully login', ["error" => "Credenciales no validas."], [], 200);
            }

            $user = auth('api')->user();

            return $this->success('Login successfully', $this->respondWithToken($token));

        } catch (\Exception $e) {
            return $this->error('Excepción', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }

        
    }

     /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        try {
            
            $user = auth('api')->user();

            $response = [
                'user' => new UserResource($user)
            ];

            return $this->success('User retrivied successfully', $response);

        } catch (\Exception $e) {
            return $this->error('Excepción', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }

    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
       
            $logout = auth('api')->logout();

            return $this->success('Successfully logged out', ['message' => 'Successfully logged out']);

        } catch (\Exception $e) {
            return $this->error('Excepción', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
       
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        try {

            return $this->success('Token updated successfully', $this->respondWithToken(auth('api')->refresh()));
            
        } catch (\Exception $e) {            
            return $this->error('Excepción', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        $user = auth('api')->user();

        return ['authorization' => [
            'token' => $token,
            'user' => new UserResource($user),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 180,
        ]];
    }
}
