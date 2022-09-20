@extends('layouts.master')
@section('title', 'My Family Users')

@section('content')

    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="staticBackdropThree" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form class="needs-validation" action="{{ route('store.user') }}" method="post" enctype="multipart/form-data" novalidate="">
                    @csrf
                            
                    <input type="hidden" id="familyName" name="family_name" value="">
                    <input type="hidden" id="rankName" name="rank_name" value="">

                    <div class="modal-body">
                            <h5 style="text-align: center;">Family Name: <span class="text-primary family-title" style="font-weight: 550;"></span></h5>

                            <br>

                            <div class="col-md-12">
                                <div class="mb-3 position-relative">
                                    <label for="validationTooltip11" class="form-label">User/Player Name</label>
                                    <input type="text" class="form-control" id="validationTooltip11" placeholder="Enter User name" name="player_name" value="" required="">
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>

                                    <div class="invalid-tooltip">
                                        Please enter player name.
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="col-md-12">
                                <div class="mb-3 position-relative">
                                    <label for="validationTooltip12" class="form-label">E-mail (*)</label>
                                    <input type="email" class="form-control" id="validationTooltip12" name="email" value="" placeholder="Enter E-mail Address" required="">
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>

                                    <div class="invalid-tooltip">
                                        Please enter valid E-mail address.
                                    </div>
                                </div>
                            </div> 

                            <br>                                              
                        
                            <div class="col-md-12">
                                <div class="mb-3 position-relative">
                                    <label for="validationTooltip13" class="form-label">Upload Photo (Optional)</label>
                                    <input type="file" class="form-control" id="validationTooltip13" placeholder="Upload Photo" name="photo">
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>

                                    <div class="invalid-tooltip">
                                        Please upload a photo.
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="col-md-12">
                                <div class="mb-3 position-relative">
                                    <label for="validationTooltip07" class="form-label">Password (*)</label>

                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" id="validationTooltip07" name="password" value="{{ old('password') }}" aria-label="Password" aria-describedby="password-addon" placeholder="Enter Password" required="">

                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>

                                        <div class="invalid-tooltip">
                                            Please enter valid password.
                                        </div>
                                        
                                        <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
                            </div>  

                            <br>

                            <div class="col-md-12">
                                <div class="mb-3 position-relative">
                                    <label for="validationTooltip08" class="form-label">Re-type Password (*)</label>
                                    
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" id="validationTooltip08" placeholder="Re-type Password" aria-label="Password" aria-describedby="password-addon-two" onkeyup="matchPassword()" required="">

                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>

                                        <div class="invalid-tooltip">
                                            Please Re-type Password again.
                                        </div>

                                        <button class="btn btn-light" type="button" id="password-addon-two" onclick="TogglePass()"><i class="mdi mdi-eye-outline"></i></button>

                                        <div class="valid-tooltip" id="matched" style="display: none;">
                                            Password Matched!
                                        </div>

                                        <div class="invalid-tooltip" id="notmatched" style="display: none;">
                                            Password not matched yet.
                                        </div>

                                    </div>

                                </div>
                            </div>
                            
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-10">
                                    <button type="submit" style="width: 100%; margin-left: .6rem;" class="btn btn-primary">Save User</button>
                                </div>

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">My Family Users</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('family.admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Family</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if(count($errors) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-dismissible fade show color-box bg-danger bg-gradient p-4" role="alert">
                                    <x-jet-validation-errors class="mb-4 my-2 text-white" />
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <h5><b>My Family Name :</b> <span class="text-primary"><b>{{ $family }}</b></span></h5> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">
                                            No.
                                        </th>
                                        <th style="width: 12%;" class="align-middle">User/Player</th>
                                        <th style="width: 8%;" class="align-middle">Rank</th>
                                        <th style="width: 3%;" class="align-middle">Status</th>
                                        <th style="width: 1%;" class="align-middle">Action</th>
                                        <th style="width: 25%;" class="align-middle">Shooter 1</th>
                                        <th style="width: 25%;" class="align-middle">Shooter 2</th>
                                        <th style="width: 25%;" class="align-middle">Shooter 3</th>
                                    </tr>
                                </thead>


                                <tbody>

                                <?php
                                    $counter = 1;
                                ?>

                                @foreach($attrs as $key => $data)
                                    <tr>

                                        <td>
                                            {{ $counter++ }}
                                        </td>

                                        <?php
                                            $player = \App\Models\Player::where('player_name', $data['uname'])->where('family_name', $data['f_name'])->where('rank_name', $data['rank_name'])->first();
                                            
                                        ?>

                                        <td id="tooltip-container">
                                            <span style="float: left;">
                                                <span style="font-weight: 500;">{{ $data['uname'] }}</span>
                                            </span>

                                            @if($player && $player->user_id != null)

                                                <span class="CellWithComment">
                                                    <i class="mdi mdi-arrow-up-bold-circle-outline ms-1 text-success" style="position: relative; top: -4px; cursor: pointer; font-size: 18px; float: right;"></i>
                                                    <span class="CellComment" style="background-color:#34c38f !important;">Activated</span>
                                                </span>

                                            @else

                                                <span class="CellWithComment">
                                                    <i class="mdi mdi-arrow-down-bold-circle-outline ms-1 text-danger" style="position: relative; top: -4px; cursor: pointer; font-size: 18px; float: right;"></i>
                                                    <span class="CellComment" style="background-color:#f46a6a !important;">De-activated</span>
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $data['rank_name'] }}">
                                                {{ $data['rank_name'] }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($data['status'] == 2)
                                                <span class="badge bg-success">Alive</span>
                                            @elseif($data['status'] == 3)
                                                <span class="badge bg-danger">Dead</span>
                                            @endif
                                        </td>

                                        <td style="text-align: center;">
                                            @if($player && $player->user_id)

                                                <form class="needs-validation" action="{{ route('delete.player', $player->user_id) }}" method="post" novalidate="">
                                                @csrf

                                                    <button class="btn btn-outline-danger btn-sm edit" title="Delete User" onclick="return confirm('Are you sure to remove permanently?')">
                                                        <i class="fas fa-user-tie"></i>
                                                    </button>

                                                </form>

                                            @else
                                                <button class="btn btn-outline-info btn-sm edit" id="getFam" data-bs-toggle="modal" data-bs-target="#staticBackdropThree" data-family="{{ $data['f_name'] }}" data-rank="{{ $data['rank_name'] }}" data-user="{{ $data['uname'] }}" title="Approve">
                                                    <i class="fas fa-user-tie"></i>
                                                </button>

                                            @endif
                                        </td>

                                        <td>

                                            @if($player && $player->shooter_one)

                                                <form class="needs-validation" action="{{ route('delete.shooter.one', $data['uname']) }}" method="post" novalidate="">
                                                @csrf

                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip01" value="{{ $player->shooter_one }}" name="shooter_one" disabled="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-danger editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @else

                                                <form class="needs-validation" action="{{ route('shooter.one') }}" method="post" novalidate="">
                                                @csrf

                                                    <input type="hidden" name="family_name" value="{{ $family }}">
                                                    <input type="hidden" name="player_name" value="{{ $data['uname'] }}">
                                                    <input type="hidden" name="rank_name" value="{{ $data['rank_name'] }}">
                                                
                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip02" placeholder="Enter Shooter 1" name="shooter_one" required="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @endif
                                        </td>

                                        <td>

                                            @if($player && $player->shooter_two)

                                                <form class="needs-validation" action="{{ route('delete.shooter.two', $data['uname']) }}" method="post" novalidate="">
                                                @csrf

                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip03" value="{{ $player->shooter_two }}" name="shooter_two" disabled="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-danger editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @else

                                                <form class="needs-validation" action="{{ route('shooter.two') }}" method="post" novalidate="">
                                                @csrf

                                                    <input type="hidden" name="family_name" value="{{ $family }}">
                                                    <input type="hidden" name="player_name" value="{{ $data['uname'] }}">
                                                    <input type="hidden" name="rank_name" value="{{ $data['rank_name'] }}">
                                                
                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip04" placeholder="Enter Shooter 2" name="shooter_two" required="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @endif
                                        </td>

                                        <td>

                                            @if($player && $player->shooter_three)

                                                <form class="needs-validation" action="{{ route('delete.shooter.three', $data['uname']) }}" method="post" novalidate="">
                                                @csrf

                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip05" value="{{ $player->shooter_three }}" name="shooter_three" disabled="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-danger editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @else

                                                <form class="needs-validation" action="{{ route('shooter.three') }}" method="post" novalidate="">
                                                @csrf

                                                    <input type="hidden" name="family_name" value="{{ $family }}">
                                                    <input type="hidden" name="player_name" value="{{ $data['uname'] }}">
                                                    <input type="hidden" name="rank_name" value="{{ $data['rank_name'] }}">
                                                
                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip06" placeholder="Enter Shooter 3" name="shooter_three" required="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

            <p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary waves-effect waves-light" href="{{ route('family.admin.dashboard') }}"><i class="far fa-arrow-alt-circle-left"></i> Go To Dashboard </a></p>
            <br>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection


@section('styles')
    <style type="text/css">
        .CellWithComment{
            position:relative;
        }

        .CellComment{
            display:none;
            position:absolute; 
            z-index:100;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            bottom: -35px;
        }

        .CellWithComment:hover span.CellComment{
            display:block;
        }

        .form-control:disabled, .form-control[readonly] {
            color: #000 !important;
            background: rgb(142 147 168 / 25%)!important;
        }
    </style>
@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#getFam', function(e){

                e.preventDefault();
                var family = $(this).data('family');
                $('.family-title').html(family);
                $('#familyName').val(family);

                var rank = $(this).data('rank');
                $('#rankName').val(rank);

                var user = $(this).data('user');
                $('#validationTooltip11').val(user);
            });
        });
    </script>


    <script>
        function matchPassword() {  
            var pw1 = document.getElementById("validationTooltip07").value;  
            var pw2 = document.getElementById("validationTooltip08").value;
            if($.trim(pw1) != ''){
                if($.trim(pw2) != ''){
                    if(pw1 != pw2)  
                    { 
                        $('#matched').css('display', 'none');  
                        $('#notmatched').css('display', 'block');
                    } else { 
                        $('#notmatched').css('display', 'none');
                        $('#matched').css('display', 'block');
                    }
                } else {
                    $('#notmatched').css('display', 'none');
                    $('#matched').css('display', 'none');
                }
            }
        }


        function TogglePass() {
            var temp = document.getElementById("validationTooltip08");
            if (temp.type === "password") {
                temp.type = "input";
            }
            else {
                temp.type = "password";
            }
        }
    
    </script>
@endsection