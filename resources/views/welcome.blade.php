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
<div class="container" style="margin-top:-60px">
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




@endsection

@push('scripts')
<script>

</script>
@endpush