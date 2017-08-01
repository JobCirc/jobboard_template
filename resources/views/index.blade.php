@include('header')

<main>
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="search" style="margin-bottom:-17px;">
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-4 col-sm-offset-3 col-xs-offset-4 col-sm-9 col-xs-8" style="background:#fff;">
                            @if(!empty($jobs))
                                <h1 style="margin-bottom: 30px;">{{ isset($search) ? 'Your search returned '.count($jobs).' results.' : 'Latest Jobs' }}</h1>
                                @foreach($jobs as $job)
                                    <article class="search-posting col-md-12">
                                        <div class="row vertical-align">
                                            <div style="width:100%;border-bottom:1px solid #bac7ce;padding-bottom:10px;" class="">
                                                <h3 class="title"><a href="/job/{{ $job->id }}">{{ $job->title }}</a></h3>
                                                <p><small><span class="glyphicon glyphicon-map-marker"></span> <b><a href="/advanced-search?search={!! $job->city.', '.$job->state !!}">{{ $job->city.', '.$job->state }}</a></b></small>  <small>at <b><a href="/advanced-search?search={!! $job->company_name !!}">{{ $job->company_name }}</a></b> about {{ $job->updated_at->diffForHumans() }}</small></p>
                                                <p>{{ str_limit(strip_tags($job->description), 270) }}</p>
                                                <p><a class="" style="float:right;" href="/job/{{ $job->id }}">View <span class="glyphicon glyphicon-chevron-right"></span></a></p>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            @else
                                @if(!isset($search))
                                <p>No jobs at the moment.</p>
                                @endif
                            @endif
                            <div class="pages" style="margin:0 auto 30px auto;float:none;">
                                @if(!isset($search))
                                    @include('pagination.default', ['paginator' => $jobs])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12 col-xs-12">
                    @include('aside')
                </div>
            </div>
        </div>
    </div>
</main>

@include('footer')