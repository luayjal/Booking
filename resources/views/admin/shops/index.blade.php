<x-dashboard-layout header="{{ __('shops') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a href="{{ route('admin.shops.create') }}" class="btn btn-success">اضافة <i class="fas fa-plus"
                            aria-hidden="true"></i></a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>
                            {{ session('success') }}
                        </strong>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('phone') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('action') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $shop)
                                    <tr>
                                        <td>{{ $shop->name }}</td>
                                        <td>{{ $shop->phone }}</td>
                                        <td>{{ $shop->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.shops.edit', $shop->id) }}"
                                                class="btn btn-sm btn-outline-primary"><i
                                                    class="far fa-edit"></i></a>
                                            <button shop_id="{{$shop->id}}" type="button" class="btn btn-sm btn-outline-danger btn_delete"><i
                                                    class="far fa-trash-alt "></i></button>



                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Delete Shopategory')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <p>{{__('do you are sure you want to delete this')}}</p>
                    <form class="d-inline form-delete" action=""
                        method="post">
                        @csrf
                        @method('delete')


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete <i
                            class="far fa-trash-alt "></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(".btn_delete").on('click',function(){
                var id = $(this).attr('shop_id');
                var form = $("#deleteModal").find('.form-delete');
                form.attr('action','/dashboard/shops/'+id);
                $('#deleteModal').modal()
            });
        </script>
        <script>
            $(function() {
                // $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,

                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                });
            });
        </script>
    @endpush
</x-dashboard-layout>
