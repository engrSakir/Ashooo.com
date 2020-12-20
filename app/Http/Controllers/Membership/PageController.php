<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\MembershipServiceProfile;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (auth()->user()->membershipPages->count() > 0){
            return redirect()->route('membership.page.edit', auth()->user()->membershipPages->first()->id);
        }else{
            return redirect()->route('membership.page.create');
        }
        //return view('membership.page.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('membership.page.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $memberPage = MembershipServiceProfile::find($id);
        return view('membership.page.edit', compact('memberPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
