<x-dashboard-layout header="اضافة متجر">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.shops.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('name') }}</label>
                            <input type="text" name="name"
                                class="form-control col-md-6 @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">{{ __('categories') }}</label>
                            <select class="form-control col-6" name="category_id" id="">
                                <option value="">اختر القسم</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('phone') }}</label>
                            <input type="text" name="phone"
                                class="form-control col-md-6 @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('email') }}</label>
                            <input type="email" name="email"
                                class="form-control col-md-6 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('password') }}</label>
                            <input type="password" name="password"
                                class="form-control col-md-6 @error('password') is-invalid @enderror"
                                value="{{ old('password') }}">
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12  mb-3">
                            <label for="">{{ __('confirm password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control col-md-6"
                                value="{{ old('password_confirmation') }}">
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
                                value="{{ old('location') }}">
                            @error('location')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row col-md-6 mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label">lat</label>
                                <input type="text" name="lat" class="form-control " id="lat">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">lng</label>
                                <input type="text" name="lng" class="form-control" id="lng">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="map" style="height:350px"></div>
                    <div class="mb3">
                        <table class="mb3 table">
                            <tr>
                                <th class="text-center">days</th>
                                <th class="text-center">status</th>
                                <th class="text-center">work time</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="days[0]" readonly value="Saturday">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="status[0]" checked value="on"
                                                class="custom-control-input switch" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1">open</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center status_day">
                                    <div class="row col-md-12 mb-3">
                                        <div class="col-md-6">

                                            <input type="text" name="from[0]" readonly placeholder="from" class="timepicker form-control"
                                                id="from">
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" name="to[0]" readonly class="timepicker-to form-control" placeholder="to"
                                                id="to">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="days[1]" readonly value="Sunday">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="status[1]" checked value="on"
                                                class="custom-control-input switch" id="customSwitch2">
                                            <label class="custom-control-label" for="customSwitch2">open</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center status_day">
                                    <div class="row col-md-12 mb-3">
                                        <div class="col-md-6">

                                            <input type="text" name="from[1]" readonly placeholder="from" class="timepicker form-control"
                                                id="from">
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" name="to[1]" readonly class="timepicker-to form-control" placeholder="to"
                                                id="to">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="days[2]" readonly value="Monday">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="status[2]" checked value="on"
                                                class="custom-control-input switch" id="customSwitch3">
                                            <label class="custom-control-label" for="customSwitch3">open</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center status_day">
                                    <div class="row col-md-12 mb-3">
                                        <div class="col-md-6">

                                            <input type="text" name="from[2]" readonly placeholder="from" class="timepicker form-control"
                                                id="from">
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" name="to[2]" readonly class="timepicker-to form-control" placeholder="to"
                                                id="to">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="days[3]" readonly value="Thuesday ">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="status[3]" checked value="on"
                                                class="custom-control-input switch" id="customSwitch4">
                                            <label class="custom-control-label" for="customSwitch4">open</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center status_day">
                                    <div class="row col-md-12 mb-3">
                                        <div class="col-md-6">

                                            <input type="text" name="from[3]" readonly placeholder="from" class="timepicker form-control"
                                                id="from">
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" name="to[3]" readonly class="form-control timepicker-to" placeholder="to"
                                                id="to">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="days[4]" readonly value="Wednesday">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="status[4]" checked value="on"
                                                class="custom-control-input switch" id="customSwitch5">
                                            <label class="custom-control-label" for="customSwitch5">open</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center status_day">
                                    <div class="row col-md-12 mb-3">
                                        <div class="col-md-6">

                                            <input type="text" name="from[4]" readonly placeholder="from" class="form-control timepicker"
                                                id="from">
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" name="to[4]" readonly class="form-control timepicker-to" placeholder="to"
                                                id="to">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="days[5]" readonly value="Thursday">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="status[5]" checked value="on"
                                                class="custom-control-input switch" id="customSwitch6">
                                            <label class="custom-control-label" for="customSwitch6">open</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center status_day">
                                    <div class="row col-md-12 mb-3">
                                        <div class="col-md-6">

                                            <input type="text" name="from[5]" placeholder="from" readonly
                                                class="timepicker form-control" id="from">
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" name="to[5]" readonly class="form-control timepicker-to"
                                                placeholder="to" id="to">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="days[6]" readonly value="Friday">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="status[6]" checked value="on"
                                                class="custom-control-input switch" id="customSwitch7">
                                            <label class="custom-control-label" for="customSwitch7">open</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center status_day">
                                    <div class="row col-md-12 mb-3">
                                        <div class="col-sm-6">

                                            <input type="text" name="from[6]" readonly class="form-control timepicker" />
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" id="timepicker" name="to[6]" readonly
                                                class="form-control timepicker-to" placeholder="to" id="to">
                                        </div>
                                    </div>
                                </td>
                            </tr>


                        </table>
                    </div>
                    <div class="form-group mb-5">
                        <button type="submit" class="btn btn-primary"> إضافة </button>
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
                    lat: 31.527360813865563,

                    lng: 34.5047581268727
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
