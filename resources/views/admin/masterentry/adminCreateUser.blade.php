@extends('admin.layout.appnext')
@section('title')
	Create User
@endsection
@section('style')
<style>
.container input:checked ~
.checkmark {
    background-color: #2196F3;
    border-radius: 20px;
    color: #FFFFFF;
}
.checkmark {
    width: 100%;
    padding: 4px 0px;
    text-align: center;
}
.container:hover input ~ .checkmark {
    background-color: #ccc;
    border-radius: 10px;
}
.dotted_text {
    white-space: nowrap;
    width: 80px;
    overflow: hidden;
    text-overflow: ellipsis;
    /* border: 1px solid #000000; */
}   
span {
    display: inline-block;
}
/* element.style {
    overflow: auto;
    height: 100%;
    width: 100%;
} */
.container {
    /* border: 1px solid #FF0000; */
    width: 12%;
    
}
.container {
    /* width: 100%; */
    padding-right: 15px;
    padding-left: 15px;
    display: inline-block;

}
label {
    display: inline-block;
    margin-bottom: .5rem;
}

</style>    
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <div class="row">       
                <div style="width: 15%">&nbsp;</div>     
                        <div class="card-body" style="width: 70%;border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                            @if (session('msg'))
                                <div class="alert  alert-success">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            <div style="text-align: center;color:gray;font-size:15px;margin-top:-15px"><b><u>CREATE USER</u></b></div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ url('ad-cuser') }}"  enctype="multipart/form-data">
                                @csrf 
                                    <div class="col-sm-12" style="margin-top: 5px">
                                            <select name="user_group" id="user_group" class="form-controls"  >
                                                <option value="">Select User Group</option>
                                                {{-- <option value="SU">Admin</option> --}}
                                                <option value="US">User</option>
                                            </select>
                                            @if ($errors->has('user_group'))
                                                <div class="text-danger">
                                                    {{ $errors->first('user_group') }}
                                                </div>
                                            @endif
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 5px">
                                        <input type="text" id="admin_name" class="register_input" name="admin_name" required  autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter User Name "></label>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 5px">
                                        <select name="user_gender" id="user_gender" class="form-controls"  >
                                            <option value="">Select User Gender</option>
                                            <option value="M">M</option>
                                            <option value="F">F</option>
                                        </select>
                                </div>
                                    <div class="col-sm-12" style="margin-top: 5px">
                                        <input type="text" id="admin_user_id" class="register_input" name="admin_user_id" required  autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter User Id "></label>
                                    </div>
                                    
                                    <div class="col-sm-12" >
                                        <input type="email" id="email" class="register_input" name="email"  required autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter e@mail"></label>
                                    </div>
                                
                                    <div class="col-sm-12" >
                                        <input type="password" id="password" class="register_input" name="password" required autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter Password"></label>
                                    </div>
                                    <div class="col-sm-12" >
                                        <input type="password" id="password_confirmation" class="register_input" name="password_confirmation" required autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter Confirm Password"></label>
                                    </div>
                                        {{-- <div style="overflow: auto;height: 100%; width: 100%;" >
                                            <label class="container">
                                                <input name="" type="checkbox" value="Main" style="display:none;">
                                                <span title="Main" class="checkmark dotted_text">Main</span>
                                            </label>
                                            <label class="  container">
                                                <input name="" type="checkbox" value="" style="display:none;">
                                                <span title="State" class="checkmark dotted_text">State</span>
                                            </label>
                                        </div>   --}}
                                        <label style="margin-left: 15px">Select User Permission : </label>
                                        <div class="col-sm-12">
                                            <input type="checkbox" id="main_per" name="main_per" value="G" >
                                            <label for="main_per"  >Main</label>

                                            <input type="checkbox" id="state_per" name="state_per" value="G" >
                                            <label for="state_per"  >State</label>

                                            <input type="checkbox" id="membership_per" name="membership_per" value="G">
                                            <label for="membership_per" >Membership</label>

                                            <input type="checkbox" id="master_per" name="master_per" value="G" >
                                            <label for="master_per" >Master Entry</label>

                                            <input type="checkbox" id="function_per" name="function_per" value="G" >
                                            <label for="function_per" >Function</label>

                                            <input type="checkbox" id="mail_per" name="mail_per" value="G">
                                            <label for="mail_per" >Mail</label>
                                        </div>
                                    <div class="col-sm-12"style='text-align: center;padding:10px' >
                                        <button type='submit' class='button22' id="search_tn_1">
                                           Add {{-- <i class="fa fa-plus" style="font-size:20px"></i> --}}
                                        </button>
                                    </div>
                            </form>
                        </div>
                <div style="width: 15%">&nbsp;</div>
            </div>
        </div>
    <div> 

@endsection
@push('scripts')

@endpush