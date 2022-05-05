<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = User::where('type', 'shop')->get();
        return view('admin.shops.index', [
            'shops' => $shops,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.shops.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
         $request->all();
       
          $data = $request->all();
      //  return $data['staus'];
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $file = $request->image;
            $data['image'] = $file->move('uploads\images', 'img_' . uniqid() . '.' .  $file->getClientOriginalExtension());
        }
        $data['type'] = "shop";
      $user =  User::create($data);
        // store category and lcation
        $user->shop()->create([
            'category_id' => $data['category_id'],
            'lat'=>$data['lat'],
            'lng' => $data['lng'],
            'location' =>  $data['location'],
            'logo' => $data['image'] ?? '',
        ]);
      // store work time
      for ($i=0; $i < count($data['days']); $i++) { 
        $user->workTimes()->create([
            'days' => $data['days'][$i],
            'status' => $data['status'][$i] ?? 'off',
            'from' => $data['from'][$i] ,
            'to' => $data['to'][$i]
        ]);
      }
     
        return redirect()->route('admin.shops.index')->with('success', __('created successfully'));
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
        $user = User::findOrFail($id);
        $categories = Category::all();
        return view('admin.shops.edit', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, $id)
    {
        $user = User::findOrFail($id);
       
        $data = $request->all();
       // return $data['sata'][4];
        $data['password'] = Hash::make($request->password);
        $prevImg = false;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $data['image'] = $file->move('uploads\images', 'img_' . uniqid() . '.' .  $file->getClientOriginalExtension());
            $prevImg = $user->image;
        }
        $data['type'] = "shop";
        $user->update($data);

        // store category and lcation
        $user->shop()->update([
            'category_id' => $data['category_id'],
            'lat'=>$data['lat'],
            'lng' => $data['lng'],
            'location' =>  $data['location'],
            'logo' => $data['image'] ?? '',
        ]);
      // store work time
      for ($i=0; $i < count($data['days']); $i++) { 
        $user->workTimes()->where('id',$data['time_id'][$i])->update([
            'days' => $data['days'][$i],
            'status' => $data['status'][$i] ?? 'off',
            'from' => $data['from'][$i] ,
            'to' => $data['to'][$i]
        ]);
      }
        if ($prevImg) {

            Storage::delete($prevImg);
        }
        return redirect()->route('admin.shops.index')->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user = User::findOrFail($id);
        $user = User::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            // $user->restore();
            $user->forceDelete();

            $prevImg = $user->image;
            if ($prevImg) {

                Storage::delete($prevImg);
            }
        } else {
            $user->delete();
        }

        return redirect()->route('admin.shops.index')->with('success', __('Deleted successfully'));
    }
}
