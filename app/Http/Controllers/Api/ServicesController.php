<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $services = Service::when($request->search, function ($q, $value) { 
             $q->where('name', 'LIKE','%'.$value.'%');
        })->latest()->paginate();
        return response()->json([
            'status' => true,
            'message' => 'successfully',
            'data' => $services,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->merge([
            'user_id' => $user->id
        ]);
        $service = Service::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'created successfully',
            'data' => $service,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = Service::where('user_id',$id)->latest()->paginate();
        return response()->json([
            'status' => true,
            'data' =>  ServiceResource::collection($services)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $user = Auth::guard('sanctum')->user();
        $service = Service::where('user_id',$user->id)->findOrFail($id);
        
        $request->merge([
            'user_id' => $user->id
        ]);
        $service->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully',
            'data' => $service,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::guard('sanctum')->user();
        $service = Service::where('user_id',$user->id)->withTrashed()->findOrFail($id);

        if ($service->trashed()) {
           // $user->restore();
            $service->forceDelete();

        } else {
            $service->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
