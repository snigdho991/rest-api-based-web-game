@extends('layouts.master')
@section('title', 'My Statistics')

@section('content')

    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">My Statistics</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('family.admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Statistics</li>
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
                                        <th>
                                            No.
                                        </th>
                                        <th class="align-middle">User/Player</th>
                                        <th class="align-middle">Rank</th>
                                        <th class="align-middle">Status</th>
                                        <th class="align-middle">E-mail</th>
                                        <th class="align-middle">Found</th>
                                        <th class="align-middle">Comment</th>
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

                                       <td id="tooltip-container">
                                            <span style="float: left;">
                                                <span style="font-weight: 500;">{{ $data['uname'] }}</span>
                                            </span>

                                            @if($find_player && $find_player->user_id != null)

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

                                        <td>
                                            <span style="font-weight: 500;">{{ \App\Models\User::where('id', $find_player->user_id)->first()->email }}</span>
                                        </td>

                                        <td>
                                            @if($find_player->found)

                                                <form class="needs-validation" action="{{ route('delete.found', $data['uname']) }}" method="post" novalidate="">
                                                @csrf

                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip01" value="{{ $find_player->found }}" name="found" disabled="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-danger editable-submit btn-sm waves-effect waves-light" onclick="return confirm('Are you sure to remove permanently ?'); "><i class="mdi mdi-trash-can-outline"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @else

                                                <form class="needs-validation" action="{{ route('submit.found') }}" method="post" novalidate="">
                                                @csrf

                                                    <input type="hidden" name="user_id" value="{{ $find_player->user_id }}">
                                                    <input type="hidden" name="family_name" value="{{ $family }}">
                                                    <input type="hidden" name="player_name" value="{{ $data['uname'] }}">
                                                    <input type="hidden" name="rank_name" value="{{ $data['rank_name'] }}">

                                                    <div class="row">
                                                        <div class="col-10" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip02" placeholder="Enter Found" name="found" required="">
                                                        </div>

                                                        <div class="col-2">
                                                            <button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @endif
                                        </td>

                                        <td>
                                            @if($find_player->comment)

                                                <form class="needs-validation" action="{{ route('delete.comment', $data['uname']) }}" method="post" novalidate="">
                                                @csrf

                                                    <div class="row">
                                                        <div class="col-9" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip01" value="{{ $find_player->comment }}" name="comment" disabled="">
                                                        </div>

                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-danger editable-submit btn-sm waves-effect waves-light" onclick="return confirm('Are you sure to remove permanently ?'); "><i class="mdi mdi-trash-can-outline"></i></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            @else

                                                <form class="needs-validation" action="{{ route('submit.comment') }}" method="post" novalidate="">
                                                @csrf

                                                    <input type="hidden" name="user_id" value="{{ $find_player->user_id }}">
                                                    <input type="hidden" name="family_name" value="{{ $family }}">
                                                    <input type="hidden" name="player_name" value="{{ $data['uname'] }}">
                                                    <input type="hidden" name="rank_name" value="{{ $data['rank_name'] }}">

                                                    <div class="row">
                                                        <div class="col-10" style="padding-right: 0;">
                                                            <input type="text" class="form-control form-control-sm" id="validationTooltip02" placeholder="Enter Comment" name="comment" required="">
                                                        </div>

                                                        <div class="col-2">
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

            <p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary waves-effect waves-light" href="{{ route('user.dashboard') }}"><i class="far fa-arrow-alt-circle-left"></i> Go To Dashboard </a></p>
            
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