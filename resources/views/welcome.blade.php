@extends('layouts.appnext')
@section('title')
	tjapkbsk
@endsection
<style>
/* Carousel Stylings */

.slideshow {
  height: 500px;
  margin: 0 auto;
  margin-top: 20px;
  overflow: hidden;
  width: 1200px;
}

.slide-wrapper {
  animation: slide 18s linear infinite;
  width: 6000px;
}

.slide {
  border-radius: 15px;
  float: left;
  height: 375px;
  width: 1200px;
}

.slide:nth-child(1) {
  background: url(../public/images1/kp.jpg) no-repeat center;
  background-size: cover;
}

.slide:nth-child(2) {
  background: url(../public/gallery_photo/photo1.jpg) no-repeat center;
  background-size: cover;
}

.slide:nth-child(3) {
  background: url(../public/gallery_photo/p2.jpg) no-repeat center;
  background-size: cover;
}

.slide:nth-child(4) {
  background: url(../public/gallery_photo/p3.jpg) no-repeat center;
  background-size: cover;
}

.slide:nth-child(5) {
  background: url(../public/gallery_photo/p4.jpg) no-repeat center;
  background-size: cover;
  
}

.slide-number {
  color: rgb(255, 255, 255);
  font-family: Arial, Helvetica, sans-serif;
  font-size: 40px;
  padding-top: 300px;
  text-align: center;
}

@keyframes slide {
  10% {
    margin-left: 0;
  }

  20% {
    margin-left: -1200px;
  }

  30% {
    margin-left: -1200px;
  }
  
  40% {
    margin-left: -2400px;
  }

  50% {
    margin-left: -2400px;
  }

  60% {
    margin-left: -3600px;
  }

  70% {
    margin-left: -3600px;
  }

  80% {
    margin-left: -4800px;
  }

  100% {
    margin-left: -4800px;
  }
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 50%;
}

.card:hover {
  box-shadow: 0 16px 32px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}

/* right to left text css */
.animated {
  overflow: hidden;
  width: 100%;
  white-space: nowrap;
}

.animated > * {
  display: inline-block;
  position: relative;
  animation: 10s linear 0s infinite move;
}

.animated > *.min {
  min-width: 100%;
}
@keyframes move {
  
  0% {
    transform: translateX(30%);
  }
  100% {
    transform: translateX(-100%);
  }
}
/* top to bottom text css */
@keyframes movingTopToBottom {
  0% {
    bottom: 0px;
  }
  100% {
    bottom: 50px;
  }
}
.cont {
  height: 100px;
  overflow: hidden;
}
#divTAReviews {
  animation: movingTopToBottom 5s linear infinite;
  position: relative;
  padding: 10px;
}
	
</style>
@section('meta')

@endsection
@section('content')
<!-- slide show -->
<div class="slideshow ">
	<div class="slide-wrapper">
		<div class="slide">
		<h1 class="slide-number">One</h1>
		</div>
		<div class="slide">
		<h1 class="slide-number">Two</h1>
		</div>
		<div class="slide">
		<h1 class="slide-number">Three</h1>
		</div>
		<div class="slide">
		<h1 class="slide-number">Four</h1>
		</div>
		<div class="slide">
		<h1 class="slide-number">Five</h1>
		</div>
	</div>
</div>
<!-- End slide show -->
<div class="container" style="margin-top:-60px;">
    <div class="animated" style="margin-left:70px;color: #6d6d6d;font-family: roboto,Sans-serif;font-size: 16px;font-weight: 400;">
      <h3>We are proud to be a part of these government projects.</h3>
    </div>
  <div class="row">
      <div class="card col-sm-3" style="margin-left:80px">
        <a href="{{url('twenty-point')}}">
          <img src="{{ asset('gallery/20pp.png') }}"  style="width:100%">
        </a>
      </div>
      <div class="card col-sm-3" style="margin-left:60px">
        <a href="{{ url('about-us') }}">
          <img src="{{ asset('gallery/vision.jpg') }}"  style="width:100%">
        </a>
      </div>
      <!-- <div class="card col-sm-3" style="padding:10px;margin-top:25px;margin-left:60px">
        <a href="{{url('safe-drive')}}">
          <img src="{{ asset('gallery/drive1.jpg') }}"  style="width:100%">
        </a>
      </div> -->
      <div class="col-sm-3" style="padding:10px;margin-left:50px;margin-top:-70px">
         <video width="300"  height="300" controls>
            <source src="video/video1.mp4" type="video/mp4">
          </video>
          <a href="{{url('more-video')}}">More Videos</a>
      </div>
     
  </div>
  <div class="row" style="margin-top:30px">
      <div class="card col-sm-3" style="margin-left:80px">
        <a href="{{url('kanyashree')}}">
          <img src="{{ asset('gallery/kanyashree1.jpg') }}"  style="width:100%">

        </a>
      </div>
      <!-- <div class="card col-sm-3" style="padding:20px;margin-left:60px">
        <a href="">
          <img src="{{ asset('gallery/swach1.png') }}"  style="width:100%">
        </a>
      </div> -->
      <div class="card col-sm-3" style="padding:20px;margin-left:60px">
        <a href="{{url('beti-bachao-beti-padhao')}}">
        <img src="{{ asset('gallery/beti2.jpg') }}"  style="width:100%">
        </a>
      </div>
      <div class="col-sm-3" style="padding:20px;margin-left:60px;color: #6d6d6d;font-family: roboto,Sans-serif;font-size: 16px;font-weight: 400;">
          <div class="cont">
              <div id="divTAReviews">
                <h4>Latest News Display Here</h4> 
              </div>
          </div>
      </div>
  </div>

  <div>
  <h2>
		<u>About TJAPSKBSK Organization</u>
	</h2>
	<p style="color: #6d6d6d;font-family: roboto,Sans-serif;font-size: 16px;font-weight: 400;">
	K.B.S.K. completes around 34 years. These 34 years have been the years of spectacular 
	achievements unprecedented development and progress. Though it was not easy to scale these heights, especially in 
	the scenario we were offered by our predecessor. Yet we made it possible because of our well-directed and well 
	- intentioned strategies vision for the development of strong implementation 20 point programme. We have cherished 
	also, to make it a Krishi Bikash Shilpa Kendra to none in all respects. 
	</p>
  
  </div>
	
</div>




@endsection

@push('scripts')
<script>

</script>
@endpush