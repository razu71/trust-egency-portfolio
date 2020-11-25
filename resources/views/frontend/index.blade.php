@extends('frontend.master')

@section('title','Home')

@section('style')
    <style>
        .features-item__text h4{
            text-align: justify;
            letter-spacing: 0;
        }
        .team-item{
            height: 300px;
            width: 370px;
        }
        .client_image{
            height: 150px;
            width: 150px !important;
            margin: 0 auto;
            border-radius: 50%;
        }
        .main-5-slider__item.parallax{
            filter: brightness(100%) !important;
        }
    </style>

@endsection

@section('content')
    <!-- start main 5 (slider) section -->
    <section class="s-main" id="home">

        <div class="main-5-slider">
            @if(!empty($sliders))
                @foreach($sliders as $slider)
                    <div class="main-5-slider__item parallax" data-background-image="{{asset(SLIDER_UPLOAD_PATH.$slider->image)}}" data-parallax-min-fading="50" data-parallax-speed="0.9">
                        {{--<div class="container">--}}
                        <div class="main-5-slider-content">
                            <div class="main-5-slider-text">
                                <div class="main-5-slider-text">
                                    <div class="main-5-slider-text__pretitle fx">{{$slider->sub_title_one}}</div>
                                    <div class="main-5-slider-text__title_before fx"></div>
                                    <h2 class="main-5-slider-text__title fx"><span class="theme-color">{{$slider->main_title}}</span></h2>
                                    <div class="main-5-slider-text__title_after fx"></div>
                                    <div class="main-5-slider-text__subtitle">{{$slider->sub_title_two}}</div>
                                </div>
                            </div>
                        </div>
                        {{--</div>--}}
                    </div>
                    {{--<div class="main-5-slider-text">--}}
                    {{--</div>--}}
                @endforeach
            @endif
        </div>
        <a href="#about_us" class="section-arrow ico-110 scroll-to"></a>
    </section>
    <!-- end main 5 (slider) section -->

    @if(!empty($about[0]))
        <!-- start features 3 section -->
        <section class="section-2 section-white s-features features-3" id="about_us">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <span class="section__subtitle">Know</span>
                        <h3 class="section__title">About us</h3>
                    </div>
                </div>
                <div class="row features">
                    <div class="features-item col-sm-5 col-md-5 fx" data-animation-name="fadeInUp" data-animation-duration="0.6s" data-animation-delay="0.2s">
                        <div class="row">
                            <img src="{{asset(ABOUT_US_IMAGE_PATH.$about[0]->image)}}" alt="" class="offer-1-product__img fx" data-animation-name="slideInRight" data-animation-duration="0.7s" data-animation-delay="0s">
                        </div>
                    </div>
                    <div class="features-item col-sm-7 col-md-7 fx" data-animation-name="fadeInUp" data-animation-duration="0.6s" data-animation-delay="0.4s">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="features-item__title">History</h5>
                                <div class="features-item__text">
                                    <h4>
                                        {{$about[0]->text}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end features 3 section -->
    @endif

    @if(!empty($people[0]))
        <!-- start team 1 section -->
        <section class="section-2 section-white s-team" id="people">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <span class="section__subtitle">Meet</span>
                        <h3 class="section__title">Our Team</h3>
                    </div>
                </div>
                <div class="row team">
                    @foreach($people as $member)
                        <div class="team-item col-xs-12 col-sm-4 fx" data-animation-name="fadeInLeft" data-animation-duration="1s" data-animation-delay="0.5s">
                            <div class="team-item__wrap">
                                <img src="{{asset(PEOPLE_IMAGE_PATH.$member->image)}}" alt="" class="team-item__img">
                                <div class="team-item-social">
                                    @if($member->facebook)<a class="team-item-social__link" href="{{$member->facebook}}"><i class="ico-101 team-item-social__icon"></i></a>@endif
                                    @if($member->twitter)<a class="team-item-social__link" href="{{$member->twitter}}"><i class="ico-102 team-item-social__icon"></i></a>@endif
                                    @if($member->google)<a class="team-item-social__link" href="{{$member->google}}"><i class="ico-103 team-item-social__icon"></i></a>@endif
                                    @if($member->linkedin)<a class="team-item-social__link" href="{{$member->linkedin}}"><i class="ico-104 team-item-social__icon"></i></a>@endif
                                </div>
                            </div>
                            <div class="team-item-details">
                                <div class="team-item-details__name">{{$member->name}}</div>
                                <div class="team-item-details__position">{{$member->designation}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end team 1 section -->
    @endif

    <!-- end offer light section -->
    @if(!empty($galleries[0]))
        <!-- start portfolio masonry fullwidth gutter 5columns hover style 2 section -->
        <section class="section-2 section-white pb-0 s-portfolio" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <span class="section__subtitle">to imagine your future</span>
                        <h3 class="section__title">Take a look on our past</h3>
                    </div>
                </div>
            </div>

            <!-- start filter -->
            <div class="portfolio-filter">
                <span class="portfolio-filter__item portfolio-filter__item_active" data-filter="*">All</span>
            </div>
            <!-- end filter -->
            <div class="row portfolio-2 portfolio-masonry portfolio-gutter">
                @foreach($galleries as $gallery)
                    <div class="portfolio-item col-xs-12 col-sm-6 col-md-3 col-lg-5col" @if($gallery->type == IMAGE) data-category="Photo" @else data-category="Video" @endif >
                        <div class="portfolio-item__wrap">
                            @if($gallery->type == VIDEO)
                                <iframe class="portfolio-item__img" height="300px"
                                        src="{{$gallery->link}}">
                                </iframe>
                            @else
                                <img src="{{asset(GALLERY_IMAGE_PATH.$gallery->image)}}" alt="" class="portfolio-item__img" height="300px">
                            @endif
                            <div class="portfolio-item__inner">
                                @if($gallery->type == VIDEO)
                                    <a href="{{$gallery->link}}" class="portfolio-item__link ico-149 preview-video"></a>
                                @else
                                    <a href="{{asset(GALLERY_IMAGE_PATH.$gallery->image)}}" class="portfolio-item__link ico-150 preview-photo"></a>
                                @endif
                                <div class="project-modal">
                                    <div class="project-modal__inner">
                                        <div class="project-modal__title">{{$gallery->title}}</div>
                                        <div class="project-modal__description">{{$gallery->description}}</div>
                                        <div class="project-modal__date">{{$gallery->created_at}}</div>
                                    </div>
                                </div>
                                <h5 class="portfolio-item__title">@if($gallery->type == IMAGE) Photo Item @else Video Item @endif</h5>
                                <span class="portfolio-item__subtitle">@if($gallery->type == IMAGE) Photo @else Video @endif</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    <!-- end portfolio masonry fullwidth gutter 5columns hover style 2 section -->

    @if($clients[0])
        <!-- start clients 1 section -->
        <section class="section" id="clients">
            <div class="container">
                <div class="row clients">
                    @foreach($clients as $client)
                        <div class="clients-item col-sm-12">
                            <p class="clients-item__text section-dark">{{$client->reviews}}</p>
                            <img src="{{asset(CLIENT_IMAGE_PATH.$client->image)}}" class="client_image" alt="client image">
                            <h6 class="clients-item__name">{{$client->name}}</h6>
                            <span class="clients-item__company">{{$client->designation}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end clients 1 section -->
    @endif
    <!-- end counters 1 block -->
@endsection

@section('script')

@endsection