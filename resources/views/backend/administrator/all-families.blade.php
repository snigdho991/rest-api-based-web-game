@extends('layouts.master')
@section('title', 'All Families')

@section('content')
    <!-- ========================== Page Content ==================================== -->

    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Local Family Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form class="needs-validation" action="{{ route('store.local.admin') }}" method="post" enctype="multipart/form-data" novalidate="">
                    @csrf
                            
                    <input type="hidden" id="familyName" name="family_name" value="">

                    <div class="modal-body">
                            <h5 style="text-align: center;">Family Name: <span class="text-primary family-title" style="font-weight: 550;"></span></h5>

                            <br>

                            <div class="col-md-12">
                                <div class="mb-3 position-relative">
                                    <label for="validationTooltip01" class="form-label">Local Admin Name (*)</label>
                                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Enter User name" name="name" value="{{ old('name') }}" required="">
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>

                                    <div class="invalid-tooltip">
                                        Please enter user name.
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="col-md-12">
                                <div class="mb-3 position-relative">
                                    <label for="validationTooltip02" class="form-label">E-mail (*)</label>
                                    <input type="email" class="form-control" id="validationTooltip02" name="email" value="{{ old('email') }}" placeholder="Enter E-mail Address" required="">
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
                                    <label for="validationTooltip03" class="form-label">Upload Photo (Optional)</label>
                                    <input type="file" class="form-control" id="validationTooltip03" placeholder="Upload Photo" name="photo">
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
                                    <button type="submit" style="width: 100%; margin-left: .6rem;" class="btn btn-primary">Save Admin</button>
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

    <div class="modal fade" id="staticBackdropTwo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">View Local Family Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                        <h5 style="text-align: center;">Family Name: <span class="text-primary family-title" style="font-weight: 550;"></span></h5>

                        <br>

                        <div class="row" id="customProPic" style="margin-bottom: 15px;">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <p style="text-align: center; color: #495057; font-size: 0.8125rem;font-weight: 500; margin-bottom: 7px;">Current Profile Picture</p>
                                <img class="img-fluid img-thumbnail rounded-circle d-block" id="proImage" alt="" src="" style="width:175px; height:175px;margin: 0 auto;">
                                
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3 position-relative text-center">
                                <label for="validationTooltip01" class="form-label">Local Admin Name </label>
                                <input type="text" class="form-control username" id="validationTooltip01" value="" readonly="">
                                
                            </div>
                        </div>

                        <br>

                        <div class="col-md-12">
                            <div class="mb-3 position-relative text-center">
                                <label for="validationTooltip02" class="form-label">E-mail</label>
                                <input type="email" class="form-control email" id="validationTooltip02" value="" readonly="">

                            </div>
                        </div> 
                            
                    </div>
                    <div class="modal-footer">
                        <span style="width: 100%;text-align: center;">
                            <button type="button" class="btn btn-light text-center" data-bs-dismiss="modal">Close</button>
                        </span>
                    </div>
            </div>
        </div>
    </div>

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

                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>
                                            Serial No.
                                        </th>
                                        <th class="align-middle">Family Name</th>
                                        <th class="align-middle">Local Family Admin</th>
                                        <th class="align-middle">Action</th>
                                    </tr>
                                </thead>


                                <tbody>

                                <?php
                                    $counter = 1;
                                ?>

                                @foreach($families as $key => $data)

                                    <?php
                                        $find_family = App\Models\FamilyAdmin::where('family_name', $data)->first();
                                        
                                        if($find_family) {
                                            $find_user = App\Models\User::find($find_family->user_id);
                                        }
                                    ?>

                                    <tr style="text-align: center;">

                                        <td>
                                            {{ $counter++ }}
                                        </td>

                                        <td id="tooltip-container">
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $data }}">
                                                {{ $data }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($find_family)
                                                <a class="btn btn-light btn-rounded btn-sm waves-effect waves-light" id="getUser" data-familyname="{{ $data }}" data-username="{{ $find_user->name }}" data-email="{{ $find_user->email }}" data-photo="{{ $find_user->profile_photo_path }}" data-bs-toggle="modal" data-bs-target="#staticBackdropTwo" href="#"><i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> View Family Admin</a>
                                            @else
                                                <span class="badge badge-soft-danger">Not Assigned Yet</span>
                                            @endif
                                        </td>

                                        <td>
                                        
                                        @if($find_family)
                                            <div class="inline" style="display: flex; justify-content: center;">
                                                <a class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="margin-left: 4px;" href="{{ route('users.by.family', $data) }}"><i class="bx bx-user-pin label-icon"></i> View Users </a>

                                                <form method="POST" action="{{ route('destroy.local.admin', $find_family->id) }}" style="position: relative; left: 4px;">
                                                    @csrf
                                                    @method('delete')
                                                
                                                    <button class="btn btn-danger btn-sm waves-effect btn-label waves-light" onclick="return confirm('Are you sure to remove permanently?')" style="margin-left: 10px;"><i class="bx bx-user-x label-icon"></i> Remove Family Admin </button>
                                                </form>
                                            </div>

                                        @else
                                            <a class="btn btn-primary btn-sm waves-effect btn-label waves-light" href="{{ route('users.by.family', $data) }}"><i class="bx bx-user-pin label-icon"></i> View Users </a>

                                            <a class="btn btn-success btn-sm waves-effect btn-label waves-light" id="getFamily" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-left: 10px;" href="#" data-family="{{ $data }}"><i class="bx bx-user-plus label-icon"></i> Assign Family Admin </a>
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

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#getFamily', function(e){

                e.preventDefault();
                var family = $(this).data('family');
                $('.family-title').html(family);
                $('#familyName').val(family);
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '#getUser', function(e){

                e.preventDefault();
                var familyname = $(this).data('familyname');
                $('.family-title').html(familyname);

                var username = $(this).data('username');
                $('.username').val(username);

                var email = $(this).data('email');
                $('.email').val(email);

                var photo = $(this).data('photo');
                if(photo) {
                    $("#proImage").attr("src", '/assets/uploads/local-admin/' + photo);
                } else {
                    $("#customProPic").css('display', 'none');
                }
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