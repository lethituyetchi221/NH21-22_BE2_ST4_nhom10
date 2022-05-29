@extends('admin.layout-admin')
@section('content_admin')
    <?php
    use App\Models\Product;
    use App\Models\Bill_detail;
    use App\Models\User;
    
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Wishlists</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Wishlists of Royal SuShi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product</th>
                                <th>User ID</th>
                                <th>User</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_wishlist as $item)
                                <?php $product = Product::where('id', $item->product_id)->first();
                                $user = User::where('id', $item->user_id)->first();
                                ?>
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td> <img style="width: 100px; height: 100px;"
                                            src="{{ asset('img/product/' . $product->image) }}"
                                            alt="">{{ $product->product_name }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>


                                    {{-- <td class="text-center">
                                        <a href="{{ route('showEditBill_admin', ['id' => $item->id]) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteModal{{ $item->id }}" href="#"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ready to delete?
                                                        </h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Cancel</button>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('deleteUser', ['id' => $item->id]) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div class="row" style=" float:right;">
                        <div class="div">
                            {{ $all_wishlist->appends(request()->all())->links() }}

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
