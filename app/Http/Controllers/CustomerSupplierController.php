<?php

namespace App\Http\Controllers;

use App\Models\CustomerSupplier;
use Illuminate\Http\Request;

class CustomerSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer-supplier');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerSupplier  $customerSupplier
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerSupplier $customerSupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerSupplier  $customerSupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerSupplier $customerSupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerSupplier  $customerSupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerSupplier $customerSupplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerSupplier  $customerSupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerSupplier $customerSupplier)
    {
        //
    }
}
