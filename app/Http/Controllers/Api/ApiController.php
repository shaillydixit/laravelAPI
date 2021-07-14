<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class ApiController extends Controller
{
    //create api - POST
    //http://127.0.0.1:8000/api/add-employee
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
    //http://127.0.0.1:8000/api/list-employees
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
    //http://127.0.0.1:8000/api/single-employee/2
    public function getSingleEmployee($id)
    {
        if (Employee::where('id', $id)->exists()) {
            $employee_detail = Employee::where('id', $id)->first();

            return response()->json([
                'status' => 1,
                'message' => 'Employee found',
                'data' => $employee_detail,
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Employee not found!'
            ], 404);
        }
    }

    //update api - PUT
    //http://127.0.0.1:8000/api/update-employee/2
    public function updateEmployee(Request $request, $id)
    {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);

            $employee->name = !empty($request->name) ? $request->name : $employee->name;
            $employee->email = !empty($request->email) ? $request->email : $employee->email;
            $employee->phone_no = !empty($request->phone_no) ? $request->phone_no : $employee->phone_no;
            $employee->gender = !empty($request->gender) ? $request->gender : $employee->gender;
            $employee->age = !empty($request->age) ? $request->age : $employee->age;
            $employee->save();
            return response()->json([
                'status' => 1,
                'message' => 'Employee Updated Successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Employee not found!'
            ], 404);
        }
    }

    //delete api - DELETE
    //http://127.0.0.1:8000/api/delete-employee/1
    public function deleteEmployee($id)
    {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);
            $employee->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Employee Deleted Successfully!',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Employee not found!'
            ], 404);
        }
    }
}
