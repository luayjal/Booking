<x-dashboard-layout header="تعديل القسم">

    <div class="container">
        <div class="card">

            {{-- <div class="card-header"><h4>اضافة قسم</h4></div> --}}
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">

                        <div class="col-md-12  mb-3">
                            <label for="">الاسم بالعربي</label>
                            <input type="text" name="name_ar" value="{{ $category->name_ar }}"
                                class="form-control col-md-6 @error('name_ar') is-invalid @enderror">
                            @error('name_ar')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12  mb-3">
                            <label for="">الاسم بالانجليزي</label>
                            <input type="text" name="name_en" value="{{ $category->name_en }}"
                                class="form-control col-md-6 @error('name_en') is-invalid @enderror">
                            @error('name_en')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group col-md-12 mb-3">
                            <label for="">صورة القسم</label>
                            <input type="file" name="image"
                                class="form-control col-md-6  @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group mb-5">
                        <button type="submit" class="btn btn-primary"> تعديل </button>
                    </div>

            </div>
            </form>
        </div>
    </div>
    </div>
</x-dashboard-layout>
