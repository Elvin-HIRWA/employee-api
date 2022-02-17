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
 *    description="Returns when user is not authenticated",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Client-side Error"),
 *    )
 * ),
 *  @OA\Response(
 *    response=500,
 *    description="Returns when server is down",
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
 * @OA\POST(
 *     path="/api/employee",
 *     summary="Add an Employee",
 *     tags={"Employees"},
 *     security={ {"bearer": {} }},
 *     @OA\RequestBody(
 *        required = true,
 *        description = "Enter Credentials of an Employee",
 *        @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                property="Employees",
 *                type="array",
 *                example={{
 *                  "name": "Elvin",
 *                  "email": "Elhirwa3@gmail.com",
 *                  "code": "099",
 *                  "phone": "0788456732",
 *                  "post": "Developer",
 *                  "identity_number": "123445566557787877",
 *                  "age": "21",
 *                }
 * },
 *                @OA\Items(
 *                      @OA\Property(
 *                         property="Employees",
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
 *        description="Successful response",
 *     ),
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
    * @OA\Get(
    *   path="/api/employee/{id}",
    *   tags={"Employees"}, 
    *   security={ {"bearer": {} }}, 
    *  @OA\Parameter(
    *     name="Employee ID",
    *     description="Specify Employee ID",
    *     required=true,
    *     in="path",
    *       @OA\Schema(
    *       type="integer"
    *     )
    *   ),
    *    @OA\Response(
    *    response=401,
    *    description="Returns when user is not authenticated",
    *    @OA\JsonContent(
    *       @OA\Property(property="message", type="string", example="Client-side Error"),
    *    )
    * ),
    *  @OA\Response(
    *    response=500,
    *    description="Returns when server is down",
    *    @OA\JsonContent(
    *       @OA\Property(property="message", type="string", example="Server Error"),
    *    )  
    * ),   
    *   @OA\Response(
    *     response="200",
    *     description="Success|Returns Employee Specified",
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
     * Update the specified Employee.

    * @OA\PUT(
    *     path="/api/employee/{id}",
    *     summary="Update an Employee",
    *     tags={"Employees"},
    *     security={ {"bearer": {} }},
    *  @OA\Parameter(
    *     name="Employee ID",
    *     description="Specify Employee ID to Update",
    *     required=true,
    *     in="path",
    *       @OA\Schema(
    *       type="integer"
    *     )
    *   ),
    *     @OA\RequestBody(
    *        required = true,
    *        description = "Enter Credentials of an Employee you want to update",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="Employees",
    *                type="array",
    *                example={{
    *                  "name": "Elvin",
    *                  "email": "Elhirwa3@gmail.com",
    *                  "code": "099",
    *                  "phone": "0788456732",
    *                  "post": "Developer",
    *                  "identity_number": "123445566557787877",
    *                  "age": "21",
    *                }
    * },
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="Employees",
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
    *        description="Successful response",
    *     ),
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
     * Remove the specified Employee.
      * @OA\Delete(
    *   path="/api/employee/{id}",
    *   tags={"Employees"}, 
    *   security={ {"bearer": {} }}, 
    *  @OA\Parameter(
    *     name="Employee ID",
    *     description="Specify Employee ID",
    *     required=true,
    *     in="path",
    *       @OA\Schema(
    *       type="integer"
    *     )
    *   ),
    *    @OA\Response(
    *    response=401,
    *    description="Returns when user is not authenticated",
    *    @OA\JsonContent(
    *       @OA\Property(property="message", type="string", example="Client-side Error"),
    *    )
    * ),
    *  @OA\Response(
    *    response=500,
    *    description="Returns when server is down",
    *    @OA\JsonContent(
    *       @OA\Property(property="message", type="string", example="Server Error"),
    *    )  
    * ),   
    *   @OA\Response(
    *     response="200",
    *     description="Success|Employees Deleted"
    *   )
    * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        return DB::delete("DELETE FROM employees WHERE id=?" ,[$id]);
       
            
    }


     /**
     * Search for Specified name.
     * @OA\Get(
    *   path="/api/employee/search/{name}",
    *   tags={"Employees"}, 
    *   security={ {"bearer": {} }}, 
    *  @OA\Parameter(
    *     name="Employee Name",
    *     description="Specify Employee name you want to search",
    *     required=true,
    *     in="path",
    *       @OA\Schema(
    *       type="string"
    *     )
    *   ),
    *    @OA\Response(
    *    response=401,
    *    description="Returns when user is not authenticated",
    *    @OA\JsonContent(
    *       @OA\Property(property="message", type="string", example="Client-side Error"),
    *    )
    * ),
    *  @OA\Response(
    *    response=500,
    *    description="Returns when server is down",
    *    @OA\JsonContent(
    *       @OA\Property(property="message", type="string", example="Server Error"),
    *    )  
    * ),   
    *   @OA\Response(
    *     response="200",
    *     description="Success|Returns Searched Employee name ",
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
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Employee::where('name','like', '%'.$name.'%')->get();
    } 
}
