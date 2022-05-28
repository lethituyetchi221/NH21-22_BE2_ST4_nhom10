@extends('admin.layout-admin')
@section('content_admin')
    <?php
    use Illuminate\Support\Facades\Session;
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">{{ $typeProduct->type_name }}</h1> --}}
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Products of {{ $typeProduct->type_name }}</h6> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <form action="{{ route('addUser') }}" method="post" enctype="multipart/form-data"
                                id="image-form">
                                @csrf
                                <div class="row ">
                                    <div class="col-12 ">
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Name</h3>
                                            </div>
                                            <div class="col-8">
                                                <input required type="text" class="form-control" placeholder="Name"
                                                    aria-label="Username" aria-describedby="basic-addon1" name="name">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Email</h3>
                                            </div>
                                            <div class="col-8">
                                                {{-- <select id="inputStatus" class="form-control custom-select" name="protype"
                                                    required>
                                                    @foreach ($all_typeProduct as $item)
                                                        <option selected value="{{ $item->id }}">
                                                            {{ $item->type_name }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                                <input required type="email" class="form-control" placeholder="Email"
                                                    aria-label="Username" aria-describedby="basic-addon1" name="email">

                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Password</h3>
                                            </div>
                                            <div class="col-8">
                                                <input required type="password" class="form-control"
                                                    placeholder="Password" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="password">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Confirm password</h3>
                                            </div>
                                            <div class="col-8">
                                                <input required type="password" class="form-control"
                                                    placeholder="Confirm password" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="confirmPassword">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Role</h3>
                                            </div>
                                            <div class="col-8">
                                                <select id="inputStatus" class="form-control custom-select" name="role"
                                                    required>
                                                    <option selected value="1">
                                                        Admin
                                                    </option>
                                                    <option  value="0">
                                                        User
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-4">
                                        <div class="ml-2 col-sm-12">
                                            <div id="msg"></div>
                                            <input type="file" name="file" class="file" accept="image/*">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Upload File"
                                                    id="file">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse btn btn-primary">Browse...</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-2 col-sm-12">
                                            <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail"
                                                style="width:100%; heigth:100%">
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row justify-content-center">
                                    <input type="submit" class="btn btn-primary btn-lg active" role="button"
                                        aria-pressed="true" value="Add">
                                </div>
                            </form>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>


    <!-- End of Main Content -->
@endsection
