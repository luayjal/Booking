<x-dashboard-layout header="تعديل متجر">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.shops.update',$user->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="form-group col-md-12">
                            <label for="">{{ __('categories') }}</label>
                            <select class="form-control col-6" name="category_id" id="">
                                <option value="">اختر القسم</option>
                                @foreach ($categories as $category)
                                    <option @if($user->shop->category_id == $category->id) selected @endif  value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                @endforeach
                            </select>
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
                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('location') }}</label>
                            <input type="text" name="location"
                                class="form-control col-md-6 @error('location') is-invalid @enderror"
                                value="{{ old('location',$user->shop->location) }}">
                            @error('location')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row col-md-6 mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label">lat</label>
                                <input type="text" name="lat" class="form-control" value="{{$user->shop->lat}}" id="lat">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">lng</label>
                                <input type="text" name="lng" class="form-control" value="{{$user->shop->lng}}" id="lng">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="map" style="height:350px"></div>
                    <table class="mb3 table">
                        <tr>
                            <th class="text-center">days</th>
                            <th class="text-center">status</th>
                            <th class="text-center">work time</th>
                        </tr>
                        @foreach ($user->workTimes as $work_time)
                        <tr>
                            <td>
                                <input type="hidden" name="time_id[{{$loop->index}}]" value="{{$work_time->id}}">
                                <input type="text" class="form-control" name="days[{{$loop->index}}]" readonly value="{{$work_time->days}}">
                            </td>
                            <td>
                                <div class="form-check">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status[{{$loop->index}}]" @if ($work_time->status == 'on')
                                        checked
                                        @endif  value="{{$work_time->status}}"
                                            class="custom-control-input switch" id="customSwitch{{$work_time->id}}">
                                        <label class="custom-control-label" for="customSwitch{{$work_time->id}}">open</label>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center status_day">
                                <div class="row col-md-12 mb-3">
                                    <div class="col-md-6">

                                        <input type="text" name="from[{{$loop->index}}]" placeholder="from" class="timepicker form-control"
                                            id="from" value="{{$work_time->from}}">
                                    </div>
                                    <div class="col-md-6">

                                        <input type="text" name="to[{{$loop->index}}]" class="timepicker-to form-control" placeholder="to"
                                            id="to" value="{{$work_time->to}}">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
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

    @push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"
        integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg=="
        crossorigin="anonymous" />
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endpush
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
        $('.timepicker').timepicker();
        $('.timepicker-to').timepicker();
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9IEplLLkfCOJ7ZBtto69imoSroJLrqEQ&callback=initMap">
    </script>
    <script>
        function initMap() {
            const myLatlng = {
                lat: {{$user->shop->lat}},

                lng:  {{$user->shop->lng}}
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: myLatlng,
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Click the map to get Lat/Lng!",
                position: myLatlng,
            });

            const uluru = {
                lat: -34.397,
                lng: 150.644
            };
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });
            google.maps.event.addListener(marker, 'position_changed',
                function() {
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                })
            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                })
        }

        window.initMap = initMap;
    </script>
    <script>
        $(document).ready(function() {
            $(".switch").change(function() {
                if (this.checked) {
                    var label = $(this).parent().find('label');
                    $(this).val('on');
                    label.html('open');


                } else {
                    var label = $(this).parent().find('label');
                    $(this).attr('checked', 'checked');
                    $(this).val('off');
                    label.html('close');
                }
            });
        });
    </script>
@endpush
</x-dashboard-layout>
