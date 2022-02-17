<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
        /**
 * @OA\POST(
 *     path="/api/register",
 *     summary="User Registration",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *        required = true,
 *        description = "Enter User's Credentials",
 *        @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                property="Users",
 *                type="array",
 *                example={{
 *                  "name": "Elvin",
 *                  "email": "Elhirwa3@gmail.com",
 *                  "password": "099",
 *                  "password_confirmation": "099",
 *                }
 * },
 *                @OA\Items(
 *                      @OA\Property(
 *                         property="Users",
 *                         type="string",
 *                         example=""
 *                      ),
 *                     
 *                     
 *                      
 *                     
 *                ),
 *             ),
 *        ),
 *     ),
 *
 *
 *     @OA\Response(
 *        response="200",
 *        description="Successful response| when User Registered",
 *     ),
 * )
 */
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

        /**
 * @OA\POST(
 *     path="/api/login",
 *     summary="User Login",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *        required = true,
 *        description = "Enter User's Credentials",
 *        @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                property="Users",
 *                type="array",
 *                example={{
 *                  "email": "Elhirwa3@gmail.com",
 *                  "password": "099",
 *                }
 * },
 *                @OA\Items(
 *                      @OA\Property(
 *                         property="Users",
 *                         type="string",
 *                         example=""
 *                      ),
 *                     
 *                     
 *                      
 *                     
 *                ),
 *             ),
 *        ),
 *     ),
 *
 *
 *     @OA\Response(
 *        response="200",
 *        description="Successful response| when User successfully Login",
 *     ),
 * )
 */

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
 * @OA\Post(
 * path="/api/logout",
 * summary="Logout",
 * description="Logout user and invalidate token",
 * operationId="authLogout",
 * tags={"Users"},
 * security={ {"bearer": {} }},
 * @OA\Response(
 *    response=200,
 *    description="Success"
 *     ),
 * @OA\Response(
 *    response=401,
 *    description="Returns when user is not authenticated",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Not authorized"),
 *    )
 * )
 * )
 */

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
    
}
