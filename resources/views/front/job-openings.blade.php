@extends('layouts.front')

@section('header-text')
    <h1 class="hidden-sm-down text-white fs-50 mb-30">@if(!is_null($frontTheme->welcome_title)) {{ $frontTheme->welcome_title }} @else @lang('modules.front.homeHeader')@endif </h1>
    <h4 class="hidden-sm-up text-white mb-30"> @if(!is_null($frontTheme->welcome_title)) {{ $frontTheme->welcome_title }} @else @lang('modules.front.homeHeader')@endif </h4>
    <p class="text-white mb-40">@if(!is_null($frontTheme->welcome_sub_title)) {!! $frontTheme->welcome_sub_title !!}  @else @lang('modules.front.jobOpeningText') @endif</p>
    <div class="location-search d-flex rounded-pill bg-white ">

        <div class="align-items-center d-flex rounded-pill location height-50">
            <select class="myselect" name="loaction" id ="location_id">
                <option value="all">@lang('modules.front.allLocation')</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ ucfirst($location->location) }}</option>
                    @endforeach
            </select>
        </div>

        <span class="space position-relative hidden-sm-down "></span>

        <div class="align-items-center d-flex rounded-pill designation height-50">
            <select class="myselect" name="category" id ="category">
                <option value="all">@lang('modules.front.allCategory')</option>
                @foreach($categories as $category)
                     <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="search-btn w-25 rounded-pill align-items-center ">
            <button type="button" name="search" class="btn btn-lg btn-dark height-48 mr-4 my-1 align-items-center d-flex rounded-pill justify-content-center"  id="search">SEARCH</button>

            {{-- <a class="btn btn-lg btn-dark height-48 mr-4 my-1 align-items-center d-flex rounded-pill justify-content-center" href="#">SEARCH</a> --}}
        </div>
    </div>
@endsection

@section('content')



    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Working at TheThemeio
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <!-- <section class="section bg-gray py-60 aaaaa">
        <div class="container">

            <div class="row gap-y align-items-center">

                <div class="col-12">
                    <h3>@if(!is_null($frontTheme->welcome_title)) {{ $frontTheme->welcome_title }} @else @lang('modules.front.jobOpeningHeading') @endif</h3>
                    <p>@if(!is_null($frontTheme->welcome_sub_title)) {!! $frontTheme->welcome_sub_title !!}  @else @lang('modules.front.jobOpeningText') @endif</p>

                </div>

            </div>

        </div>
    </section> -->

    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Open positions
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <style>
        .carousel-cell {
            width: 350px;
            margin-right: 5px;
        }
        .flickity-button.next {
            /* display: none !important; */
            margin-right: -70px;
        }
        .flickity-button.previous {
            margin-left: -50px;
            /* display: none !important; */
        }
        .flickity-page-dots {
            /* display: none !important; */
        }
     </style>
    <section class="section">
        <div class="container">
            <header class="section-header">
                <h2>@lang('modules.front.jobOpenings')</h2>
                <hr>
                <hr>
            </header>
             <div data-provide="shuffle" id="applicant-notes">
                <div class="carousel" id="openingProjects" data-flickity='{ "wrapAround": true, "pageDots": true, "cellAlign": "left", "contain": true }'>
                    @forelse($jobs as $job)
                        <div class="carousel-cell col-12 col-md-6 col-lg-4 portfolio-2 job-list" data-shuffle="item" data-groups="{{ $job->location->location.','.$job->category->name }}">
                            <a href="{{ route('jobs.jobDetail', [$job->slug]) }}" class="job-opening-card">
                            <div class="card card-bordered">
                                <div class="card-block">

                                    <h5 class="card-title mb-0">{{ ucwords($job->title) }}</h5>
                                    @if($job->company->show_in_frontend == 'true')
                                    @if($job->job_company_id != null && $job->job_company_id != '')
                                        <small class="company-title mb-50">@lang('app.by') {{ ucwords($job->jobCompany->company_name) }}</small>
                                    @else
                                        <small class="company-title mb-50">@lang('app.by') {{ ucwords($job->company->company_name) }}</small>
                                    @endif
                                    @endif
                                    <div class="d-flex flex-wrap justify-content-between card-location">
                                        <span class="fw-400 fs-14"><i class="mr-5 fa fa-map-marker"></i>{{ ucwords($job->location->location).', '.ucwords($job->location->country->country_name) }}</span>
                                        <span class="fw-400 fs-14">{{ ucwords($job->category->name) }}<i class="ml-5 fa fa-graduation-cap"></i></span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @empty
                        <h4 id ="no-data" class="mx-auto mt-50 mb-40 card-title mb-0" >@lang('modules.front.noData') </h4>
                    @endforelse
                </div>
            </div>


        </div>
    </section>
    <section class="section" style="padding-top: 0px;">
        <div class="container">
            <header class="section-header">
                <h2>Running Projects</h2>
                <hr>
                <hr>
            </header>
            <div data-provide="shuffle" id="applicant-notes">
                <div class="carousel" id="runningProjects" data-flickity='{ "wrapAround": true, "pageDots": true, "cellAlign": "left", "contain": true }'>
                    @forelse($runPrj as $job)
                        <div class="carousel-cell col-12 col-md-6 col-lg-4 portfolio-2 job-list" data-shuffle="item" data-groups="{{ $job->location->location.','.$job->category->name }}">
                            <a href="{{ route('jobs.jobDetail', [$job->slug]) }}" class="job-running-card">
                            <div class="card card-bordered">
                                <div class="card-block">

                                    <h5 class="card-title mb-0">{{ ucwords($job->title) }}</h5>
                                    @if($job->company->show_in_frontend == 'true')
                                    @if($job->job_company_id != null && $job->job_company_id != '')
                                        <small class="company-title mb-50">@lang('app.by') {{ ucwords($job->jobCompany->company_name) }}</small>
                                    @else
                                        <small class="company-title mb-50">@lang('app.by') {{ ucwords($job->company->company_name) }}</small>
                                    @endif
                                    @endif
                                    <div class="d-flex flex-wrap justify-content-between card-location">
                                        <span class="fw-400 fs-14"><i class="mr-5 fa fa-map-marker"></i>{{ ucwords($job->location->location).', '.ucwords($job->location->country->country_name) }}</span>
                                        <span class="fw-400 fs-14">{{ ucwords($job->category->name) }}<i class="ml-5 fa fa-graduation-cap"></i></span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @empty
                        <h4 id ="no-data" class="mx-auto mt-50 mb-40 card-title mb-0" >@lang('modules.front.noData') </h4>
                    @endforelse
                </div>
            </div>


        </div>
    </section>
    <section class="section" style="padding-top: 0px;">
        <div class="container">
            <header class="section-header">
                <h2>Finished Projects</h2>
                <hr>
                <hr>
            </header>
             <div data-provide="shuffle" id="applicant-notes">
                <div class="carousel" id="finishedProjects" data-flickity='{ "wrapAround": true, "pageDots": true, "cellAlign": "left", "contain": true }'>
                    @forelse($finPrj as $job)
                        <div class="carousel-cell col-12 col-md-6 col-lg-4 portfolio-2 job-list" data-shuffle="item" data-groups="{{ $job->location->location.','.$job->category->name }}">
                            <a href="{{ route('jobs.jobDetail', [$job->slug]) }}" class="job-finished-card">
                            <div class="card card-bordered">
                                <div class="card-block">

                                    <h5 class="card-title mb-0">{{ ucwords($job->title) }}</h5>
                                    @if($job->company->show_in_frontend == 'true')
                                    @if($job->job_company_id != null && $job->job_company_id != '')
                                        <small class="company-title mb-50">@lang('app.by') {{ ucwords($job->jobCompany->company_name) }}</small>
                                    @else
                                        <small class="company-title mb-50">@lang('app.by') {{ ucwords($job->company->company_name) }}</small>
                                    @endif
                                    @endif
                                    <div class="d-flex flex-wrap justify-content-between card-location">
                                        <span class="fw-400 fs-14"><i class="mr-5 fa fa-map-marker"></i>{{ ucwords($job->location->location).', '.ucwords($job->location->country->country_name) }}</span>
                                        <span class="fw-400 fs-14">{{ ucwords($job->category->name) }}<i class="ml-5 fa fa-graduation-cap"></i></span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @empty
                        <h4 id ="no-data" class="mx-auto mt-50 mb-40 card-title mb-0" >@lang('modules.front.noData') </h4>
                    @endforelse
                </div>
            </div>


        </div>
    </section>

@endsection
@push('footer-script')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script>
    $(document).ready(function(){
        // ...existing code...

        // Inisialisasi Flickity setelah load more/search
        function reloadFlickity() {
            var $openingCarousel = $('#openingProjects');
            var $runningCarousel = $('#runningProjects');
            var $finishedCarousel = $('#finishedProjects');

            // Destroy Flickity instance jika sudah ada
            try { $openingCarousel.flickity('destroy'); } catch(e) {}
            try { $runningCarousel.flickity('destroy'); } catch(e) {}
            try { $finishedCarousel.flickity('destroy'); } catch(e) {}

            // Fungsi untuk menentukan cellAlign
            function getCellAlign($carousel) {
                return $carousel.find('.carousel-cell:visible').length === 1 ? 'center' : 'left';
            }

            // Inisialisasi ulang Flickity dengan cellAlign dinamis
            $openingCarousel.flickity({
                wrapAround: true,
                pageDots: true,
                cellAlign: getCellAlign($openingCarousel),
                contain: true
            });
            $runningCarousel.flickity({
                wrapAround: true,
                pageDots: true,
                cellAlign: getCellAlign($runningCarousel),
                contain: true
            });
            $finishedCarousel.flickity({
                wrapAround: true,
                pageDots: true,
                cellAlign: getCellAlign($finishedCarousel),
                contain: true
            });
        }
        reloadFlickity();

        //search
        $('body').on('click', '#search', function () {
            var location_id = $('#location_id').val();
            var category = $('#category').val();
            var token = '{{ csrf_token() }}';

            // Destroy Flickity sebelum ganti HTML
            if ($('#openingProjects').data('flickity')) {
            $('#openingProjects').flickity('destroy');
            }
            if ($('#runningProjects').data('flickity')) {
            $('#runningProjects').flickity('destroy');
            }
            if ($('#finishedProjects').data('flickity')) {
            $('#finishedProjects').flickity('destroy');
            }

            $.easyAjax({
            url:"{{ route('jobs.search-job') }}",
            type:'POST',
            data: {'_token':token, location_id:location_id, category:category},
            success:function(response){
                $('#openingProjects').html(response.view.opening);

                totalCurrentData = response.data.job_current_count;
                $([document.documentElement, document.body]).animate({
                scrollTop: $("#applicant-notes").offset().top
                }, 2000);
                if (response.data.hideButton !== 'undefined' && response.data.hideButton === 'yes'){
                $('#load_more_button').hide();
                }
                if (response.data.hideButton !== 'undefined' && response.data.hideButton === 'no') {
                $('#load_more_button').show();
                }
                reloadFlickity(); // Inisialisasi ulang Flickity setelah HTML baru
            }
            });
            $.easyAjax({
            url:"{{ route('jobs.search-job') }}",
            type:'POST',
            data: {'_token':token, location_id:location_id, category:category},
            success:function(response){
                $('#runningProjects').html(response.view.running);

                totalCurrentData = response.data.job_current_count;
                $([document.documentElement, document.body]).animate({
                scrollTop: $("#applicant-notes").offset().top
                }, 2000);
                if (response.data.hideButton !== 'undefined' && response.data.hideButton === 'yes'){
                $('#load_more_button').hide();
                }
                if (response.data.hideButton !== 'undefined' && response.data.hideButton === 'no') {
                $('#load_more_button').show();
                }
                reloadFlickity(); // Inisialisasi ulang Flickity setelah HTML baru
            }
            });
            $.easyAjax({
            url:"{{ route('jobs.search-job') }}",
            type:'POST',
            data: {'_token':token, location_id:location_id, category:category},
            success:function(response){
                $('#finishedProjects').html(response.view.finished);

                totalCurrentData = response.data.job_current_count;
                $([document.documentElement, document.body]).animate({
                scrollTop: $("#applicant-notes").offset().top
                }, 2000);
                if (response.data.hideButton !== 'undefined' && response.data.hideButton === 'yes'){
                $('#load_more_button').hide();
                }
                if (response.data.hideButton !== 'undefined' && response.data.hideButton === 'no') {
                $('#load_more_button').show();
                }
                reloadFlickity(); // Inisialisasi ulang Flickity setelah HTML baru
            }
            });
        });
    });
</script>
@endpush