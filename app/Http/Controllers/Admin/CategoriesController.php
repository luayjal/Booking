<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categores = Category::latest()->paginate();

        return view('admin.category.index', [
            'categories' => $categores,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->move('uploads/images', uniqid() . '.' .  $file->getClientOriginalExtension());
            //= $file->store('/images',['disk' => 'uploads']);
        }

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'تم اضافة القسم بنجاح');
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit', [
            'category' => $category,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->all();

        $prevImg = false;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->move('uploads/images', uniqid() . '.' .  $file->getClientOriginalExtension());
            $prevImg = $category->image;
        }


        $category->update($data);
        if ($prevImg) {

            Storage::delete($prevImg);
        }
        return redirect()->route('admin.categories.index')->with('success', 'تم تحديث القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->trashed()) {
            $category->forceDelete();
        } else {
            $category->delete();
        }
        $prevImg = $category->image;
        if ($prevImg) {

            Storage::delete($prevImg);
        }
        return redirect()->route('admin.categories.index')->with('success', 'تم حذف القسم بنجاح');
    }
}
