<x-dashboard-layout header="الأقسام">

    <div class="content">
        <div class="container">

            <br>
            {{-- <div class="page-title">
            <h3>الأقسام</h3>
        </div> --}}
            <div class="box box-primary">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <a class="btn btn-info mb-3" href="{{ route('admin.categories.create') }}">اضافة قسم <i
                        class="fas fa-plus"></i></a>
                <div class="card">
                    <div class="card-body">

                        <div class="box-body">
                            <table id="example2" class="table table-bordered">

                                <thead class="table-stripped">
                                    <tr style="text-align: center">

                                        <th>الاسم بالعربي</th>
                                        <th>الاسم بالانجليزي</th>
                                        <th>الصورة</th>
                                        <th>العمليات</th>
                                    </tr>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr style="text-align: center">

                                            <td style="text-align: center">{{ $category->name_ar }}</td>
                                            <td style="text-align: center">{{ $category->name_en }}</td>

                                            <td>
                                                @if ($category->image)
                                                    <img src="{{ asset($category->image) }}"
                                                        style="width:90px;height:70px" alt="Arabic Image">
                                                @endif


                                            <td style="text-align: center; margin-top:20px">

                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                    class="btn btn-outline-primary"><i class="far fa-edit"></i></a>

                                                    <button category_id="{{$category->id}}" type="button" class="btn btn-sm btn-outline-danger btn_delete"><i
                                                        class="far fa-trash-alt "></i></button>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                </thead>
                            </table>

                        </div>

                    </div>
                </div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Delete Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('do you are sure you want to delete this')}}</p>
                    <form class="d-inline form-delete" action="" method="post">
                        @csrf
                        @method('delete')


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete <i class="far fa-trash-alt "></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(".btn_delete").on('click', function() {
                var id = $(this).attr('category_id');
                var form = $("#deleteModal").find('.form-delete');
                form.attr('action', '/dashboard/categories/' + id);
                $('#deleteModal').modal()
            });
        </script>
        <script>
            $(function() {
                // $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                });
            });
        </script>
    @endpush

</x-dashboard-layout>
