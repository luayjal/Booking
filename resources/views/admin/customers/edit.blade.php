<x-dashboard-layout header="تعديل المستخدم">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.customers.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('name') }}</label>
                            <input type="text" name="name"
                                class="form-control col-md-6 @error('name') is-invalid @enderror" value="{{old('name',$user->name)}}">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('phone') }}</label>
                            <input type="text" name="phone"
                                class="form-control col-md-6 @error('phone') is-invalid @enderror" value="{{old('phone',$user->phone)}}">
                            @error('phone')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('email') }}</label>
                            <input type="email" name="email"
                                class="form-control col-md-6 @error('email') is-invalid @enderror" value="{{old('email',$user->email)}}">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('password') }}</label>
                            <input type="password" name="password"
                                class="form-control col-md-6 @error('password') is-invalid @enderror" value="{{old('password')}}">
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('confirm password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control col-md-6" value="{{old('password_confirmation')}}">
                        </div>
                            <div class="mb-2">
                                <img width="120px" src="{{asset($user->image)}}" alt="">
                            </div>
                        <div class="form-group col-md-12 mb-3">
                            <label for="">{{ __('image') }}</label>
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
