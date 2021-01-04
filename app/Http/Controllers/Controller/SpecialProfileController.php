<?php

namespace App\Http\Controllers\Controller;

use App\Http\Controllers\Controller;
use App\SpecialProfile;
use App\SpecialService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class SpecialProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $special_services = SpecialService::all();
        return view('controller.special-profile.index', compact('special_services'));
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
           'service' => 'required|exists:special_services,id',
           'name' => 'required',
           'phone' => 'required',
           'description' => 'required',
           'image' => 'nullable|max:500',
        ]);

        $special_profile = new SpecialProfile();
        $special_profile->special_service_id   = $request->input('service');
        $special_profile->controller_id   = auth()->user()->id;
        $special_profile->upazila_id   = auth()->user()->upazila->id;
        $special_profile->name  = $request->input('name');
        $special_profile->phone = $request->input('phone');
        $special_profile->description   = $request->input('description');
        if($request->hasFile('image')){
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/special/profile/';
            $image_new_name    = Str::random(8).'-special-profile-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(500, 300, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            $special_profile->image    = $folder_path.$image_new_name;
        }
        $special_profile->save();
        return $special_profile;

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy(Request $request)
    {
        $request->validate([
            'profile' => 'required|exists:special_profiles,id'
        ]);
        $special_profile = SpecialProfile::find($request->input('profile'));
        if ($special_profile->upazila_id == auth()->user()->upazila->id){
            try {
                $special_profile->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully deleted.',
                ]);
            }catch (\Exception $exception){
                return response()->json([
                    'type' => 'danger',
                    'message' => 'Sorry we are unable for this action.',
                ]);
            }
        }else{
            return response()->json([
                'type' => 'danger',
                'message' => 'You have not permission to delete this special profile.',
            ]);
        }
        //
    }
}
