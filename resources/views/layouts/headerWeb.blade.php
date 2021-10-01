<div class="container-fluid"  style="background-color:rgb(176,239,248);">
    <div class="row" >
      <div class="col-sm-3 col-xs-12">
            <a href="{{ url('/') }}" style="text-decoration: none;">
                <img loading="lazy" width="20%" height="auto" class="m-20" src="{{ asset('images1/logo-Trans.png') }}">
            </a>
          <a href="{{url('/')}}"  style="text-decoration: none;">
            <b style=" font-size: 26px; font-weight: 600;color: rgb(185,122,87);">TJAPSKBSK</b>
          </a>
            <span class="web-none">
              <a href='#' id="login_manu" class="fr m-20 fa fa-bars" style=" font-size:30px; text-decoration:none; color:#333333;"></a>
            </span>
      </div>

      <div class="col-sm-9 mt-15">
            <div class="container-fluid m-20 mob-none">
            <div class="row">
              <b>
                <div class="col-sm-8" align="right">
                  <span>
                      <a href="{{ url('/') }}" style="text-decoration:none;">Home</a>
                  </span>
                  <span style="padding-left:15px;">
                      <a href="{{ url('about-us') }}" style="text-decoration:none;">About Us</a>
                  </span>
				          <span style="padding-left:15px;">
                      <a href="{{ url('message') }}" style="text-decoration:none;">Message</a>
                  </span>
                  <span style="padding-left:15px;">
                      <a href="{{ url('ourprogram') }}" style="text-decoration:none;">Our Program</a>
                  </span>
                  <span style="padding-left:15px;">
                      <a href="{{ url('gal') }}" style="text-decoration:none;">Gallery</a>
                  </span>
                  <span style="padding-left:15px;">
                      <a href="{{ url('contact-us') }}" style="text-decoration:none;">Contact Us</a>
                  </span>
                </div>
              </b>
                <div class="col-sm-4">
                    <div class='row'>
                      <div class="search-container" style="margin-top:-5px">
                        <form action="">
                          <input type="text" placeholder="Search.." name="search">
                          <button type="submit" style=" padding: 5px;cursor: pointer;"><i class="fa fa-search"></i></button>
                       </form>
                      </div>
                    </div>
                </div>
            </div>
          </div>
          </div>
          
      </div>
    </div>
</div>
    <!-- after click taggel -->
    <div class="web-none" style="background-color:rgb(176,239,248);">
       
        <div class="row web-none" id="login_manu_contain" style="display:none;">
          <div class="col-sm-9">
              <div class="pl-20 pr-20">
                <a href="{{ url('homemain') }}" style="text-decoration:none;">Home</a>
              </div>
              <div class="pr-20 pl-20">
                <a href="{{ url('#') }}" style="text-decoration:none;">About Us</a>
              </div>
              <div class="pr-20 pl-20">
                <a href="{{ url('#') }}" style="text-decoration:none;">Message</a>
              </div>
              <div class="pr-20 pl-20">
                <a href="{{ url('#') }}" style="text-decoration:none;">Our Program</a>
              </div>
             
              <div class="pl-20">
              <a href="{{ url('#') }}" style="text-decoration:none;">Gallery</a>
              </div>
              <div class="pl-20">
                <a href="{{ url('contact-us') }}" style="text-decoration:none;">Contact Us</a>
              </div>
             
          </div>
        </div>
    </div>
  </div>
@section('model')

     

@endsection
@push('scripts')
<script>
	$(document).ready(function(){
	  $("#login_manu").click(function(){
		$("#login_manu_contain").toggle(500);
	  });
	});
</script>
@endpush

