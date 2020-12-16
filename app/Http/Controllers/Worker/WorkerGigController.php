<?php

namespace App\Http\Controllers\Worker;

use App\Gig;
use App\Http\Controllers\Controller;

use App\WorkerGig;
use App\WorkerServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WorkerGigController extends Controller
{
    public function index()
    {

        $categories = WorkerServiceCategory::all();
        return view('worker.gig.index', compact(, 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|min:3|max:100',
            'description'       => 'required|string|min:15|max:5000',
            'service'           => 'required|exists:worker_services,id',
            'day'               => 'required|numeric|min:1|max:30',
            'tags'              => 'nullable|string|min:3|max:200',
            'price'             => 'required|numeric|min:30',
        ]);

        $gig = new WorkerGig();

        $gig->worker_id         =   auth()->user()->id;
        $gig->title             =   $request->input('title');
        $gig->description       =   $request->input('description');
        $gig->service_id        =   $request->input('service');
        $gig->day               =   $request->input('day');
        $gig->tags              =   $request->input('tags');
        $gig->budget            =   $request->input('price');
        $gig->save();
        return  $gig;

    }

    public function show($id){

        $workerGig = WorkerGig::find(Crypt::decryptString($id));
        if ($workerGig->worker->id == Auth::user()->id){
            return view('worker.gig.show', compact(, 'workerGig'));
        }else{
            return redirect()->back();
        }
    }

    public function edit($id){

        $workerGig = WorkerGig::find(Crypt::decryptString($id));
        $categories = WorkerServiceCategory::all();
        if ($workerGig->worker->id == Auth::user()->id){
            return view('worker.gig.edit', compact(, 'workerGig','categories'));
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'gig'               => 'required|exists:worker_gigs,id',
            'title'             => 'required|string|min:3|max:100',
            'description'       => 'required|string|min:15|max:5000',
            'service'           => 'required|exists:worker_services,id',
            'day'               => 'required|numeric|min:1|max:30',
            'tags'              => 'nullable|string|min:3|max:200',
            'price'             => 'required|numeric|min:30',
        ]);

        $gig = WorkerGig::find($request->input('gig'));
        if ($gig->worker->id == Auth::user()->id){
            $gig->title             =   $request->input('title');
            $gig->description       =   $request->input('description');
            $gig->service_id        =   $request->input('service');
            $gig->day               =   $request->input('day');
            $gig->tags              =   $request->input('tags');
            $gig->budget            =   $request->input('price');
            $gig->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully gig updated',
            ]);
        }else{
            return response()->json([
                'type' => 'danger',
                'message' => 'Permission denied',
            ]);
        }
    }

    public function delete(Request $request){
        $request->validate([
           'gig' => 'required|exists:worker_gigs,id'
        ]);
        $gig = WorkerGig::find($request->input('gig'));
        if ($gig->worker->id == Auth::user()->id){
            $gig->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully gig deleted',
            ]);
        }else{
            return response()->json([
                'type' => 'danger',
                'message' => 'Permission denied',
            ]);
        }

    }
}
