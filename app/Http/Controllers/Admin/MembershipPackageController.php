<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MembershipPackage;
use App\Setting;
use Illuminate\Http\Request;

class MembershipPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(1);
        $packages = MembershipPackage::all(); //orderBy('id', 'desc')->get()
        return view('admin.membership.index', compact('setting', 'packages'));
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
        $request->validate([
            'package_name' => 'required|string|unique:membership_packages,name' ,
            'position_number' => 'required|numeric|unique:membership_packages,position' ,
            'maximum_image' => 'required|numeric' ,
            'price_of_3_month' => 'required|numeric' ,
            'price_of_6_month' => 'required|numeric' ,
            'price_of_12_month' => 'required|numeric' ,
            'is_available_phone_number' => 'required|boolean' ,
            'is_available_description' => 'required|boolean' ,
        ]);
        $package = new MembershipPackage();
        $package->name =  $request->input('package_name');
        $package->three_month_price = $request->input('price_of_3_month');
        $package->six_month_price = $request->input('price_of_6_month');
        $package->twelve_month_price = $request->input('price_of_12_month');
        $package->mobile_availability = $request->input('is_available_phone_number');
        $package->description_availability = $request->input('is_available_description');
        $package->image_count = $request->input('maximum_image');
        $package->position = $request->input('position_number');
        $package->save();
        return $package;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'package' => 'required|string|exists:membership_packages,id' ,
            'package_name' => 'required|string|unique:membership_packages,name,'.$request->input('package'),
            'position_number' => 'required|numeric|unique:membership_packages,position,'.$request->input('package'),
            'maximum_image' => 'required|numeric' ,
            'price_of_3_month' => 'required|numeric' ,
            'price_of_6_month' => 'required|numeric' ,
            'price_of_12_month' => 'required|numeric' ,
            'is_available_phone_number' => 'required|boolean' ,
            'is_available_description' => 'required|boolean' ,
        ]);
        $package = MembershipPackage::find($request->input('package'));
        $package->name =  $request->input('package_name');
        $package->three_month_price = $request->input('price_of_3_month');
        $package->six_month_price = $request->input('price_of_6_month');
        $package->twelve_month_price = $request->input('price_of_12_month');
        $package->mobile_availability = $request->input('is_available_phone_number');
        $package->description_availability = $request->input('is_available_description');
        $package->image_count = $request->input('maximum_image');
        $package->position = $request->input('position_number');
        $package->save();
        return $package;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
