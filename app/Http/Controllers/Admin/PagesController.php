<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.setting.offer', compact('pages '));
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
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        $request->validate([
            'page'   =>  'required|exists:pages,id',
            'en_name'   =>  'required|string|min:1|max:50|unique:pages,en_name,'.$request->input('page'),
            'bn_name'   =>  'required|string|min:1|max:50|unique:pages,bn_name,'.$request->input('page'),
            'en_title'  =>  'nullable|string|max:250',
            'bn_title'  =>  'nullable|string|max:250',
            'en_image'  =>  'nullable|image|max:500',
            'bn_image'  =>  'nullable|image|max:500',
            'en_description'    =>  'nullable|min:3|max:15000',
            'bn_description'    =>  'nullable|min:3|max:15000',
        ]);

        $page = Page::find($request->input('page'));
        $page->en_name      = $request->input('en_name');
        $page->bn_name      = $request->input('bn_name');
        $page->slug         = Str::slug($request->input('en_name')) ;
        $page->en_title     = $request->input('en_title');
        $page->bn_title     = $request->input('bn_title');
        $page->en_description        = $request->input('en_description');
        $page->bn_description        = $request->input('bn_description');

        if($request->hasFile('en_image')){
            $image             = $request->file('en_image');
            $folder_path       = 'uploads/images/pages/';
            $image_new_name    = Str::random(8).'-en_page-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->fit(600, 300, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            $page->en_image    = $folder_path.$image_new_name;
        }
        if($request->hasFile('bn_image')){
            $image             = $request->file('bn_image');
            $folder_path       = 'uploads/images/pages/';
            $image_new_name    = Str::random(8).'-bn_page-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->fit(600, 300, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            $page->bn_image    = $folder_path.$image_new_name;
        }
        $page->save();
        return redirect()->back();
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
