<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('type', 'customer')->get();
        return view('admin.customers.index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'password' => 'required|confirmed',

        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $file = $request->image;
            $data['image'] = $file->move('uploads\images', 'img_' . uniqid() . '.' .  $file->getClientOriginalExtension());
        }
        $data['type'] = "customer";
        User::create($data);
        return redirect()->route('admin.customers.index')->with('success', __('created successfully'));
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
        return view('admin.customers.edit', [
            'user' => $user
        ]);
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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'required',
            // 'password' => 'required|confirmed',

        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $prevImg = false;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $data['image'] = $file->move('uploads\images', 'img_' . uniqid() . '.' .  $file->getClientOriginalExtension());
            $prevImg = $user->image;
        }
        $data['type'] = "customer";
        $user->update($data);
        if ($prevImg) {

            Storage::delete($prevImg);
        }
        return redirect()->route('admin.customers.index')->with('success', __('Updated successfully'));
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

        return redirect()->route('admin.customers.index')->with('success', __('Deleted successfully'));
    }
}
