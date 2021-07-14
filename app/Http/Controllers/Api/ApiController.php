<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class ApiController extends Controller
{
    //create api - POST
    public function createEmployee(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone_no' => 'required',
            'gender' => 'required',
            'age' => 'required',
        ]);
        //create data
        //we can also use
        // Employee::create([
        //     'name' => $request->name,
        // ])
        $employee = new Employee();

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_no = $request->phone_no;
        $employee->gender = $request->gender;
        $employee->age = $request->age;
        $employee->save();


        //send response
        return response()->json([
            'status' => 1,
            'message' => 'Employee created successfully'
        ]);
    }

    //list api - GET
    public function listEmployees()
    {
        $employees = Employee::get();
        // print_r($employees);

        return response()->json([
            'status' => 1,
            'message' => "Listing Employees successfully!",
            'data' => $employees,
        ], 200);
    }

    //single detail api - GET
    public function getSingleEmployee($id)
    {
    }

    //update api - PUT
    public function updateEmployee(Request $request, $id)
    {
    }

    //delete api - DELETE
    public function deleteEmployee($id)
    {
    }
}
