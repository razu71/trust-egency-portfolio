@extends('frontend.master')

@section('title','Contact')

@section('style')
    
@endsection

@section('content')
<!-- start main 6 section -->
<section class="s-main" id="home">
        <div class="main-6">
            <div class="main-6__bg parallax" data-background-image="assets/img/208.jpg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-5">
                        <div class="main-6-img">
                            <img src="assets/img/inc/iphone5-black-darkkhaki.png" class="main-6-img__img hidden-xs fx" data-animation-name="slideInUp" data-animation-duration="1.5s" data-animation-delay="0.1s" alt="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-7 pb-0">
                        <h1 class="main-6__title fx" data-animation-name="slideInRight" data-animation-duration=".8s" data-animation-delay="1.5s">Try Our <span class="theme-color">Awesome App!</span></h1>
                        <p class="main-6__description fx" data-animation-name="slideInDown" data-animation-duration=".8s" data-animation-delay="1.8s">This application does everything you want and even more! Try it now to open up new possibilities.</p>
                        <a class="btn-a ico-10 btn-a_color_theme btn-a_hover_2 fx" data-animation-name="fadeIn, pulse" data-animation-duration="1s" data-animation-delay="2.5s" href="http://themeforest.net/item/nowadays-onemulti-page-multipurpose-creative-agency-portfolio-blog-html5-template/15927752">Download</a>
                        <a class="btn-a scroll-to fx" data-animation-name="fadeIn, pulse" data-animation-duration="1s" data-animation-delay="2.9s" href="#offer">More info</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main 6 section -->

    <!-- start Contact us section -->
    <section class="section-2 section-white s-contact">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12"><span class="section__subtitle">Feel</span>
                    <h3 class="section__title">Free to Contact</h3>
                </div>
            </div>
            <div class="row contact">
                <div class="col-xs-12 col-sm-4">
                    <div class="contact-info">
                        <div class="contact-info__title">Information</div>
                        <div class="contact-info__item ico-60">
                            NowaDays Ltd.
                            <br>442 5th Avenue,
                            <br>Manhattan, NY,
                            <br>10018
                        </div>
                        <div class="contact-info__item ico-87">
                            <a class="contact-info__link" href="tel:+1234567890">+1-234-567-890</a>
                        </div>
                        <div class="contact-info__item ico-61">
                            <a class="contact-info__link" href="mailto:yourmail@yahoo.com">yourmail@yahoo.com</a></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="row">
                        <form action="ajax/feedback.php" class="contact-form">
                            <div class="col-xs-12 col-sm-6">
                                <input name="formName" type="text" placeholder="Name" class="contact-form__input" required>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <input name="formEmail" type="email" placeholder="Email address" class="contact-form__input" required>
                            </div>
                            <div class="col-xs-12 col-sm-12 align-left">
                                <textarea name="formMessage" placeholder="Message" cols="30" rows="10" class="contact-form__textarea" required></textarea>
                                <button class="contact-form__submit btn-a btn-a_fill_theme" type="submit" value="Send">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Contact us section -->

    <!-- start Google Maps block -->
    <div class="google-maps ">
        <div class="google-maps__container parallax" data-google-maps-api-key="AIzaSyBf-JoGKKntvN0K3i7kcta2Luk8okMgFRY" data-google-maps-coords="40.751915, -73.982556" data-parallax-min-fading="90" data-parallax-speed="1"></div>
    </div>
    <!-- end Google Maps block -->
@endsection

@section('script')
    
@endsection