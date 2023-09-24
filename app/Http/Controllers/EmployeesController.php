<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{

    // custom

    public function getEmployees()
    {
        $employees = Employees::all();

        return response()->json(['employees' => $employees], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees = Employees::all();

        return response()->json(['employees' => $employees], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employees)
    {
        //
        echo 'lakfdlasd falf lkfjadf lak  ';
        //   return response()->json($employees);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employees $employees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employees $employees)
    {
        //
    }
}
