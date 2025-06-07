@extends('layouts.front')
<style>
    .header.inner-header{
        height: 274px;
    }
    .header {
        padding: 104px 100px !important;
    }
    @media (max-width:767px) {
        .header.inner-header {
            height: 224px;
        }
    }

    .carousel-cell {
        width: 250px !important;
        margin-right: 5px;
    }
    .flickity-button.next {
        /* display: none !important; */
        margin-right: -20px;
    }
    .flickity-button.previous {
        margin-left: -10px;
        /* display: none !important; */
    }
    .flickity-page-dots {
        /* display: none !important; */
    }
    .section-header hr {
        width: 100px !important;
        margin-top: 3px !important;
        margin-bottom: 1.5rem !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        border-top: 2px solid #0f0f0f !important;
    }

</style>
@section('header-text')
    <h1 class="hidden-sm-down text-white fs-40 mb-10">{{ ucwords($job->title) }}</h1>
    <h3 class="hidden-sm-up text-white  mb-10">{{ ucwords($job->title) }}</h3>
    <div class="text-white">
        <a class="text-white" href="{{ route('jobs.jobOpenings') }}"><u>@lang('modules.front.jobOpenings')</u>&nbsp; </a> &raquo; &nbsp;<span class="text-white">{{ ucwords($job->title) }}</span>
    </div>
@endsection

@section('content')
<section class="section pb-40">
    <div class="container">
        <div class="row">

            <div class="col-lg-9 col-md-7">
                
                    <div class="bg-white p-15">
                        <div class="col-md-12">
                            <h4 class="mt-10">{{ ucwords($job->title) }}</h4>
                            <!-- @if($job->company->show_in_frontend == 'true')
                                <small class="company-title">@lang('app.by') {{ ucwords($job->company->company_name) }}</small>
                            @endif
                            <p>{{ ucwords($job->category->name) }}</p> -->

                            @if(count($job->skills) > 0)
                                <h6>@lang('menu.skills')</h6>
                                <div class="gap-multiline-items-1">
                                    @foreach($job->skills as $skill)
                                        <span class="badge badge-secondary">{{ $skill->skill->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <p class="mt-30 fw-500 fs-16 text-dark">@lang('modules.jobs.jobDescription')</p>

                            <div class="fw-400 text-color text-justify fs-16">
                                {!! $job->job_description !!}
                            </div>

                            <p class="mt-30 fw-500 fs-16 text-dark">@lang('modules.jobs.jobRequirement')</p>

                            <div class="fw-400 text-color text-justify fs-16" >
                                {!! $job->job_requirement !!}
                            </div>

                            <!-- <div class="my-30 text-center">
                                <a class="btn btn-lg btn-primary theme-background"
                                href="{{ route('jobs.jobApply', $job->slug) }}">@lang('modules.front.applyForJob')</a>
                            </div> -->

                        </div>

                    </div>
                    
                    <header class="section-header" style="margin-top: 20px;margin-bottom: -10px; max-width: 100% !important; text-align: left;">
                        <h4>Candidates :</h4>
                        <hr>
                    </header>
                    <table id="candidatesTable" class="table table-bordered table-striped" style="margin-top: 20px; width:100%;">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($candidates as $candidate)
                                <tr>
                                    <td>{{ ucwords($candidate->full_name) }}</td>
                                    <td>
                                        <span class="badge" style="background-color:{{$candidate->application_color}};">{{ ucwords($candidate->application_status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">@lang('modules.front.noData')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- DataTables CSS & JS -->
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
                    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#candidatesTable').DataTable({
                                "ordering": true,
                                "searching": true,
                                "paging": true,
                                "info": false,
                                "language": {
                                    "emptyTable": "@lang('modules.front.noData')"
                                }
                            });
                        });
                    </script>
               
            </div>

            <div class="col-lg-3 col-md-5">
                <div class="sidebar bg-white" id="sidebar">

                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('menu.postedby')</p>
                        <p class="fw-400 text-color fs-16 mb-0 company-title">
                            @if($job->company->show_in_frontend == 'true')
                                @lang('app.by') {{ ucwords($job->company->company_name) }}
                            @endif
                        </p>
                    </div>

                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('menu.locations')</p>
                        <p class="fw-400 text-color fs-16 mb-0">{{ ucwords($job->location->location) }}</p>
                    </div>

                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('menu.jobCategory')</p>
                        <p class="fw-400 text-color fs-16 mb-0">{{ ucwords($job->category->name) }}</p>
                    </div>
                    @if(count($job->skills) > 0)
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('menu.skills')</p>
                        @foreach($job->skills as $skill)
                            <p class="fw-400 text-color fs-16 mb-0">{{ $skill->skill->name }}</p>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('menu.totalPositions')</p>
                            <p class="fw-400 text-color fs-16 mb-0">{{ $job->total_positions }}</p>
                    </div>
                    @if($job->show_work_experience)
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('modules.jobs.workExperience')</p>
                            <p class="fw-400 text-color fs-16 mb-0">{{ $job->workExperience ? $job->workExperience->work_experience : '--' }}</p>
                    </div>  
                    @endif

                    @if($job->show_job_type)
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('modules.jobs.jobType')</p>
                            <p class="fw-400 text-color fs-16 mb-0">{{ $job->jobType ? $job->jobType->job_type : '--' }}</p>
                    </div>  
                    @endif

                    @if($job->show_salary)
                    @if($job->pay_type == 'Range')
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('menu.salary') @lang('modules.jobs.range')</p>
                            <p class="fw-400 text-color fs-16 mb-0">{{ $job->starting_salary. '--' .$job->maximum_salary . ' ' . '/'.$job->pay_according}} </p>
                    </div>  
                    @elseif($job->pay_type == 'Starting')
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('modules.jobs.startingSalary')</p>
                            <p class="fw-400 text-color fs-16 mb-0">{{ $job->starting_salary . ' ' . '/'.$job->pay_according}} </p>
                    </div>  
                    @elseif($job->pay_type == 'Maximum')
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('modules.jobs.maximumSalary')</p>
                            <p class="fw-400 text-color fs-16 mb-0">{{ $job->starting_salary . ' ' . '/'.$job->pay_according }} </p>
                    </div>  
                    @elseif($job->pay_type == 'Exact Amount')
                    <div class="p-30 bb-1">
                        <p class="fw-500 fs-16 text-dark mb-0">@lang('modules.jobs.exactSalary')</p>
                            <p class="fw-400 text-color fs-16 mb-0">{{ $job->starting_salary . ' ' . '/'.$job->pay_according }} </p>
                    </div>  
                    @endif
                    @endif

                    @if($job->end_date > now())
                    <div class="p-30">
                        <a class="btn btn-block btn-primary theme-background w-100"
                           href="{{ route('jobs.jobApply', $job->id) }}"
                           style="white-space: normal; word-break: break-word; font-size: 1rem; padding: 0.75rem 1rem;">
                            @lang('modules.front.applyForJob')
                        </a>
                    </div>
                    @endif
                    <style>
                        @media (max-width: 767px) {
                            .sidebar .btn {
                                font-size: 0.95rem;
                                padding: 0.65rem 0.75rem;
                            }
                            .sidebar .p-30 {
                                padding: 15px !important;
                            }
                        }
                    </style>

                    

                    <div class="py-10 border-light mt-20 text-center">
                        <span class="fs-12 fw-600">@lang('modules.front.shareJob')</span>

                        <div class="social social-boxed social-colored social-cycling text-center my-10">
                            <a class="social-linkedin"
                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('jobs.jobDetail', [$job->slug]) }}&title={{ urlencode(ucwords($job->title)) }}&source=LinkedIn"
                            ><i class="fa fa-linkedin"></i></a>
                            <a class="social-facebook"
                               href="https://www.facebook.com/sharer/sharer.php?u={{ route('jobs.jobDetail', [$job->slug]) }}"
                            ><i class="fa fa-facebook"></i></a>
                            <a class="social-twitter"
                               href="https://twitter.com/intent/tweet?status={{ route('jobs.jobDetail', [$job->slug]) }}"
                            ><i class="fa fa-twitter"></i></a>
                            <a class="social-gplus"
                               href="https://plus.google.com/share?url={{ route('jobs.jobDetail', [$job->slug]) }}"
                            ><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                    @if($linkedinGlobal->status == 'enable')
                        <a class="my-10 applyWithLinkedin btn btn-block btn-primary " href="{{ route('jobs.linkedinRedirect', 'linkedin') }}">
                            <i class="fa fa-linkedin-square"></i>
                            @lang('modules.front.linkedinSignin')
                        </a>
                    @endif 
                </div>
            </div>

        </div>
    </div>
</section>
@endsection


<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var $carousel = $('#detailsCandidate');
    // Destroy jika sudah pernah diinisialisasi
    if ($carousel.data('flickity')) {
        $carousel.flickity('destroy');
    }
    $carousel.flickity({
        wrapAround: true,
        pageDots: true,
        cellAlign: 'center',
        contain: true
    });
});
</script>