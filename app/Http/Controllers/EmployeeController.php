<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
/**
* Display list of All Employees.
*
* @return \Illuminate\Http\Response
*
* @OA\Get(
*   path="/api/employee",
*   tags={"Employees"}, 
*   security={ {"bearer": {} }}, 
*    @OA\Response(
 *    response=401,
 *    description="UnAuthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="UnAuthanticated"),
 *    )
 * ),
 *  @OA\Response(
 *    response=500,
 *    description="Returns when there is server problem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Server Error"),
 *    )  
 * ),   
*   @OA\Response(
*     response="200",
*     description="Success|Returns Employees list",
*     @OA\JsonContent(
*       type="array",
*       @OA\Items(
 *           @OA\Property(
 *                         property="name",
 *                         type="string",
 *                         example="Elvin"
 *                      ),
 *                      @OA\Property(
 *                         property="email",
 *                         type="string",
 *                         example="elhirwa3@gmail.com"
 *                      ),
 *                      @OA\Property(
 *                         property="code",
 *                         type="string",
 *                         example="006"
 *                      ),
* )
*     )
*   )
* )
*/
    public function index()
    {
        return Employee::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create an Employee
     * @OA\Post (
     *     path="/api/employee",
     *     tags={"Employees"},
     *     security={ {"bearer": {} }},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="array",
     *                       @OA\Items(
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="code",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="phone",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="post",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="identity_number",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="age",
     *                          type="string"
     *                      ),),
     *                 ),
     *                 example={
     *                     "name":"Bebe",
     *                     "email":"example@content.com",
     *                     "code":"101",
     *                     "phone":"0784562344",
     *                     "post":"Engineer",
     *                     "identity_number":"1198580045563328",
     *                     "age":"36",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="name"),
     *              @OA\Property(property="email", type="string", example="email@ab.com"),
     *              @OA\Property(property="code", type="string", example="404"),
     *              @OA\Property(property="phone", type="string", example="0798888888"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      ),
     *      @OA\Response(
 *    response=401,
 *    description="UnAuthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="UnAuthanticated"),
 *    )
 * ),
 *  @OA\Response(
 *    response=500,
 *    description="Returns when there is server problem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Server Error"),
 *    )  
 * ),
 *  @OA\Response(
     *          response=419,
     *          description="CSRF Token mismatch",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      ),   
     * )
     

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email' =>'required',
            'code' =>'required',
            'phone' =>'required',
            'post' =>'required',
            'identity_number' =>'required',
            'age' =>'required',
        ]);
       
           return Employee::Create($request->all());
    }

   /**
    * Display specified Employee.
    *
    * @return \Illuminate\Http\Response
    * @param  int  $id
     * @OA\Get (
     *     path="/api/employee/{id}",
     *     tags={"Employees"},
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="title"),
     *              @OA\Property(property="email", type="string", example="content@gmil.com"),
     *              @OA\Property(property="code", type="string", example="808"),
     *              @OA\Property(property="phone", type="string", example="089564584"),
     *              @OA\Property(property="post", type="string", example="post"),
     *              @OA\Property(property="identity_number", type="string", example="120859495989598"),
     *              @OA\Property(property="age", type="string", example="40"),
     *         )
     *     ),
     *      @OA\Response(
 *    response=401,
 *    description="UnAuthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="UnAuthanticated"),
 *    )
 * ),
 *  @OA\Response(
 *    response=500,
 *    description="Returns when there is server problem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Server Error"),
 *    )  
 * )   
     * )
     */
    public function show($id)
    {
        return Employee::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

     /**
     * Update an Employee
     * @OA\Put (
     *     path="/api/employee/{id}",
     *     tags={"Employees"},
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="code",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="phone",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="post",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="identity_number",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="age",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Bebe",
     *                     "email":"example@content.com",
     *                     "code":"101",
     *                     "phone":"0784562344",
     *                     "post":"Engineer",
     *                     "identity_number":"1198580045563328",
     *                     "age":"36",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="name"),
     *              @OA\Property(property="email", type="string", example="email@ab.com"),
     *              @OA\Property(property="code", type="string", example="404"),
     *              @OA\Property(property="phone", type="string", example="0798888888"),
     *          )
     *      ),
     *      @OA\Response(
 *    response=401,
 *    description="UnAuthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="UnAuthanticated"),
 *    )
 * ),
 *  @OA\Response(
 *    response=500,
 *    description="Returns when there is server problem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Server Error"),
 *    )  
 * ),
 *  @OA\Response(
     *          response=419,
     *          description="CSRF Token mismatch",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      ),
     * )
    

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
            $employee = Employee::find($id);
            $employee-> update($request->all());
            return $employee;
    
    }

     /**
     * Delete an Employee
     * @OA\Delete (
     *     path="/api/employee/{id}",
     *     tags={"Employees"},
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="Employee deletion success")
     *         )
     *     ),
     *      @OA\Response(
 *    response=401,
 *    description="UnAuthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="UnAuthanticated"),
 *    )
 * ),
 *  @OA\Response(
 *    response=500,
 *    description="Returns when there is server problem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Server Error"),
 *    )  
 * ),  
 *  @OA\Response(
     *          response=419,
     *          description="CSRF Token mismatch",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      ), 
     * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        return DB::delete("DELETE FROM employees WHERE id=?" ,[$id]);
       
            
    }


     /**

     * @param  str  $name
     * @return \Illuminate\Http\Response

     * @OA\Get (
     *     path="/api/employee/search/{name}",
     *     tags={"Employees"},
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         in="path",
     *         name="name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="title"),
     *              @OA\Property(property="email", type="string", example="content@gmil.com"),
     *              @OA\Property(property="code", type="string", example="808"),
     *              @OA\Property(property="phone", type="string", example="089564584"),
     *              @OA\Property(property="post", type="string", example="post"),
     *              @OA\Property(property="identity_number", type="string", example="120859495989598"),
     *              @OA\Property(property="age", type="string", example="40"),
     *         )
     *     ),
     *      @OA\Response(
 *    response=401,
 *    description="UnAuthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="UnAuthanticated"),
 *    )
 * ),
 *  @OA\Response(
 *    response=500,
 *    description="Returns when there is server problem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Server Error"),
 *    )  
 * ),   
     * )
     */
    public function search($name)
    {
        return Employee::where('name','like', '%'.$name.'%')->get();
    } 
}
