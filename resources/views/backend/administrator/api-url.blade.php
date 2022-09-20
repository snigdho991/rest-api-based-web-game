@extends('layouts.master')
@section('title', 'All Families')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Families List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Families List</li>
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
                        <div class="card-body">

                            <form class="needs-validation" action="{{ route('update.api.url') }}" method="post" novalidate="">
                                @csrf

                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <label for="validationTooltip01" class="form-label">API Callback Url (*)</label>
                                        <input type="text" class="form-control" id="validationTooltip01" placeholder="Enter API Callback Url" name="url" value="{{ old('url', $api) }}" required="">
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>

                                        <div class="invalid-tooltip">
                                            Please enter a valid api callback url.
                                        </div>
                                    </div>
                                </div>

                                <br>
                                
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Save API Url</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection
