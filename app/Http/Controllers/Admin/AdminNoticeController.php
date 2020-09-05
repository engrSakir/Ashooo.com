<?php

namespace App\Http\Controllers\Admin;

use App\AdminNotice;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(1);
        $notices = AdminNotice::orderBy('id', 'desc')->get();
        return view('admin.admin-notice.index', compact('setting', 'notices'));
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
            'title' => 'nullable',
            'detail' => 'required',
        ]);
        $notice = new AdminNotice();
        $notice->admin_id = Auth::user()->id;
        $notice->title = $request->input('title');
        $notice->detail = $request->input('detail');
        $notice->save();
        return $notice;
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
        $id = $request->input('id');
        $request->validate([
            'title' => 'nullable',
            'detail' => 'required',
        ]);
        $notice = AdminNotice::find($id);
        $notice->title = $request->input('title');
        $notice->detail = $request->input('detail');
        $notice->save();
        return $notice;
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
