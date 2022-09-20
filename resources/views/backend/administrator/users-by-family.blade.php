@extends('layouts.master')
@section('title', 'Family Users')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Family Users</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('all.families') }}">All Families</a></li>
                                <li class="breadcrumb-item active">Families List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <h5>Showing results for the <b>Family Name</b> is: <span class="text-primary"><b>{{ $family }}</b></span></h5> 
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
                                            Serial No.
                                        </th>
                                        <th class="align-middle">User/Player Name</th>
                                        <th class="align-middle">Rank</th>
                                        <th class="align-middle">Status</th>
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
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $data['uname'] }}">
                                                <span style="font-weight: 500;">{{ $data['uname'] }}</span>
                                            </span>
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
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

            <p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary waves-effect waves-light" href="{{ route('all.families') }}"><i class="far fa-arrow-alt-circle-left"></i> Go Back To All Families </a></p>
            <br>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection