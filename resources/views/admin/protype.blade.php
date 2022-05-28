@extends('admin.layout-admin')
@section('content_admin')
    <?php use App\Models\Product;
    use App\Models\Type_product; ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Protypes</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Protypes of Royal SuShi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10px">Id</th>
                                <th>Name</th>
                                <th>The Number Of Products</th>
                                <th class="text-center"> <a href="" class="btn btn-info btn-circle btn-sm"
                                        data-toggle="modal" data-target="#modalAddProtype">
                                        <i class="fa fa-plus"></i>
                                    </a></th>

                                <!--Modal: Login with Avatar Form-->
                                <div class="modal fade" id="modalAddProtype" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">

                                    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                                        <!--Content-->
                                        <div class="modal-content">
                                            <!--Header-->
                                            <div class="modal-header justify-content-center">
                                                <img style="width: 100px; heigth:100px"
                                                    src="{{ asset('img/royalsushi.png') }}" alt="avatar"
                                                    class="rounded-circle img-responsive">
                                            </div>
                                            <!--Body-->
                                            <form action="{{ route('addProtype') }}" method="post">
                                                @csrf
                                                <div class="modal-body text-center mb-1">
                                                    <h5 class="mt-1 mb-2">Enter protype name</h5>
                                                    <div class="md-form ml-0 mr-0">
                                                        <input type="text" type="text" id="form29"
                                                            class="form-control form-control-sm validate ml-0"
                                                            style=" text-align: center" name="name" required>
                                                    </div>
                                                    <div class="text-center mt-4">
                                                        <input type="submit" class="btn btn-primary" value="Add protype">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--/.Content-->
                                    </div>

                                </div>
                                <!--Modal: Login with Avatar Form-->


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_protype as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->type_name }}</td>
                                    <?php $quantyProduct = Product::where('type_id', '=', $item->id)
                                        ->with('type_products')
                                        ->get(); ?>
                                    <td>{{ count($quantyProduct) }}</td>

                                    <td class="text-center">
                                        <a href="" class="btn btn-info btn-circle btn-sm" data-toggle="modal"
                                            data-target="#modalEditProtype{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!--Modal: Login with Avatar Form-->
                                        <div class="modal fade" id="modalEditProtype{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                            <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                                                <!--Content-->
                                                <div class="modal-content">
                                                    <!--Header-->
                                                    <div class="modal-header justify-content-center">
                                                        <img style="width: 100px; heigth:100px"
                                                            src="{{ asset('img/royalsushi.png') }}" alt="avatar"
                                                            class="rounded-circle img-responsive">
                                                    </div>
                                                    <!--Body-->
                                                    <form action="{{ route('editProtype',['id'=>$item->id]) }}" method="post">
                                                        @csrf
                                                        <div class="modal-body text-center mb-1">
                                                            <h5 class="mt-1 mb-2">Enter protype name</h5>
                                                            <div class="md-form ml-0 mr-0">
                                                                <input value="{{ $item->type_name }}" type="text"
                                                                    type="text" id="form29"
                                                                    class="form-control form-control-sm validate ml-0"
                                                                    style=" text-align: center" name="name" required>
                                                            </div>
                                                            <div class="text-center mt-4">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Add protype">

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--/.Content-->
                                            </div>

                                        </div>
                                        <!--Modal: Login with Avatar Form-->


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
                                                            href="{{ route('deleteProtype', ['id' => $item->id]) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div class="row" style=" float:right;">
                        <div class="div">
                            {{ $all_protype->appends(request()->all())->links() }}

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    @if (Session::has('deleteSuccess'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right:20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ Session::get('deleteSuccess') }}
        </div>
    @endif

    @if (Session::has('updateSuccess'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right:20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ Session::get('updateSuccess') }}
        </div>
    @endif
@endsection
