@extends('layouts.master')
@section('title', 'Family Administrator Dashboard')

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->role }} Dashboard</h4>                      
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="row" style="margin-top: -40px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="text-align: center !important;">
                            <span class="badge bg-dark font-size-12"> All Statistics <i class="bx bx-caret-down"></i></span><br><br>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <p style="text-align: center; margin-bottom: 10px;"><button class="btn btn-primary waves-effect waves-light btn-sm" type="button" id="btn-reload"><i class="bx bx-loader-circle bx-spin" style="position: relative; top: 1px;"></i> Refresh Table </button></p>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>
                                                No.
                                            </th>
                                            <th class="align-middle">Player</th>
                                            <th class="align-middle">Rank</th>
                                            <th class="align-middle">Status</th>
                                            <th class="align-middle">Family</th>
                                            <th class="align-middle">Shooter 1</th>
                                            <th class="align-middle">Shooter 2</th>
                                            <th class="align-middle">Shooter 3</th>
                                            <th class="align-middle">Found</th>
                                            <th class="align-middle">Comment</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>

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

        div.dataTables_wrapper div.dataTables_processing {
            top: 0px;
            box-shadow: 0 2px 6px rgb(0 0 0 / 15%);
        }
    </style>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 20, 
                lengthMenu: [[20, 50, 100, 250, 500, -1], [20, 50, 100, 250, 500, "All"]],
                language: {
                  'processing': 'Displaying Records...'
                },
                ajax: '{!! route('dashboard.index.api') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', sortable: true },
                    { data: 'uname', name: 'uname' },
                    { data: 'rank_name', name: 'rank_name' },
                    { data: 'status', name: 'status' },
                    { data: 'f_name', name: 'f_name' },
                    { data: 'shooter_one'},
                    { data: 'shooter_two'},
                    { data: 'shooter_three'},
                    { data: 'found'},
                    { data: 'comment'},
                ]
            });

            $('#btn-reload').on('click', function() {
                table.ajax.reload();
            });
        });
    </script>
@endsection