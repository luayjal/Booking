<x-dashboard-layout header="تعديل الخدمة">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.services.update',$service->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('name') }}</label>
                            <input type="text" name="name"
                                class="form-control col-md-6 @error('name') is-invalid @enderror" value="{{old('name',$service->name)}}">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">{{__('shop')}}</label>
                            <select class="form-control col-md-6" name="user_id" id="">
                                <option value="">اختر المتجر</option>
                                @foreach ($users as $user)
                                <option  @if($user->id == $service->user_id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                  <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                          </div>
                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('time') }}</label>
                            <input type="text" name="time"
                                class="form-control col-md-6 @error('time') is-invalid @enderror" value="{{old('time',$service->time)}}">
                            @error('time')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('price') }}</label>
                            <input type="text" name="price"
                                class="form-control col-md-6 @error('price') is-invalid @enderror" value="{{old('price',$service->price)}}">
                            @error('price')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('description') }}</label>
                            <textarea name="description" class="form-control col-md-6">{{ old('description',$service->description) }}</textarea>
                            @error('description')
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
