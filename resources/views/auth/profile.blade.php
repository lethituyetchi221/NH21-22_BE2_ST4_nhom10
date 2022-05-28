@extends('layout')
@section('content')
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Xác định vị trí tooltip */
            position: absolute;
            z-index: 1;
            top: 100%;
            left: 50%;
            margin-left: -60px;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        body {
            /* background: -webkit-linear-gradient(left, #3931af, #00c6ff); */
        }

        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            /* background: #fff; */
            /* background: -webkit-linear-gradient(left, #3931af, #00c6ff); */
            background:
                /* top, transparent black, faked with gradient */
                linear-gradient(rgba(0, 0, 0, 0.7),
                    rgba(0, 0, 0, 0.7)),
                /* bottom, image */
                url("https://png.pngtree.com/thumb_back/fw800/back_our/20190620/ourmid/pngtree-sushi-gourmet-poster-advertising-background-image_160531.jpg");
            background-size: contain;
        }

        .profile-img {
            text-align: center;
        }

        .profile-img img {
            width: 70%;
            height: 100%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }

        .logout_btn {
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }

        .proile-rating {
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-work {
            padding: 14%;
            margin-top: -15%;
        }

        .profile-work p {
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }

        .profile-work a {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-work ul {
            list-style: none;
        }

        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }

    </style>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                        alt="" />
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-head">
                    <h2 style="color: white">
                        {{ Auth::user()->name }}
                    </h2>
                    <p class="proile-rating"><span></span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Bill</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <a href="{{ route('showEditProfile') }}"> <button class="logout_btn" name="btnAddMore"> Edit
                        Profile</button></a>
            </div>
        </div>

        <div class="row">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="{{ route('changePassword') }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Enter password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password" style="margin-bottom: 10px" required>
                                <input name="confirmPassword" type="password" class="form-control"
                                    id="exampleInputPassword1" placeholder="Confirm password" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save change</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
            <div class="col-md-4">
                <div class="profile-work text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Change password
                    </button>



                </div>

            </div>
            <div class="col-md-6">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label style="color: white">Name</label>
                            </div>
                            <div class="col-md-6">
                                <p style="color: white"> {{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label style="color: white">Email</label>
                            </div>
                            <div class="col-md-6">
                                <p style="color: white">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        {{-- <div class="row">
                                <div class="col-md-6">
                                    <label>Experience</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Expert</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Hourly Rate</label>
                                </div>
                                <div class="col-md-6">
                                    <p>10$/hr</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Total Projects</label>
                                </div>
                                <div class="col-md-6">
                                    <p>230</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>English Level</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Expert</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Availability</label>
                                </div>
                                <div class="col-md-6">
                                    <p>6 months</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Your Bio</label><br />
                                    <p>Your detail description</p>
                                </div>
                            </div> --}}

                        <div class="row">

                            <div class="col-md-1">
                                <p style="color:white ; text-decoration-line:underline">Id</p>
                            </div>
                            <div class="col-md-3">
                                <label style="color:white ; text-decoration-line:underline">Total</label>
                            </div>
                            <div class="col-md-4">
                                <p style="color:white ; text-decoration-line:underline">Create date</p>
                            </div>
                            <div class="col-md-4">
                                <p style="color:white ; text-decoration-line:underline">Status</p>
                            </div>
                        </div>
                        @foreach ($bill_by_userId as $item)
                            <div class="row">
                                <div class="col-md-1">
                                    <a href="{{ route('showBillDetail', ['bill_id' => $item->id]) }}"
                                        style="color: white; ">
                                        {{ $item->id }}
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('showBillDetail', ['bill_id' => $item->id]) }}"
                                        style="color: white; ">
                                        {{ number_format($item->total) }}
                                    </a>
                                    {{-- <label style="color:white ; ">{{ number_format($item->total) }}</label> --}}
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('showBillDetail', ['bill_id' => $item->id]) }}"
                                        style="color: white; ">
                                        {{ $item->create_date }}
                                    </a>
                                    {{-- <label style="color:white ; ">{{ $item->create_date }}</label> --}}
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('showBillDetail', ['bill_id' => $item->id]) }}"
                                        style="color: white; ">
                                        <?php if ($item->status == 0) {
                                            echo 'Chờ xác nhận';
                                        } elseif ($item->status == 1) {
                                            echo 'Đang giao hàng';
                                        } elseif ($item->status == 2) {
                                            echo 'Giao thành công';
                                        } elseif ($item->status == 3) {
                                            echo 'Đã nhận hàng';
                                        }
                                        ?>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
            </div>
            <div class="col-md-2">
                <a href="{{ route('logout') }}"><button class="logout_btn">Log out </button>
                </a>
            </div>
        </div>

    </div>
@endsection
