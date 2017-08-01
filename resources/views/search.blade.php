@include('header')

<main>
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="search">
                        <div class="row">
                            <form action="/advanced-search" method="get">
                                {!! csrf_field() !!}
                                <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" value="{{ isset($i['search']) ? $i['search'] : '' }}" name="search" class="form-control" placeholder="Job title, location or company">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <select name="pipeline" style="border: none;border-left: 1px solid #bac7ce;border-top: 1px solid #bac7ce;border-bottom: 1px solid #bac7ce;border-right: 1px solid #bac7ce;color: #696969;width: 100%;text-align: left;padding: 10px;height: 100%; display: block;" class="form-control">
                                            <option value="" selected hidden>Pipeline...</option>
                                            @foreach($pipelines as $key => $name)
                                                <option {{ isset($i['pipeline']) && $i['pipeline'] == $key ? 'selected' : '' }} value="{{ $key }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <select name="date" style="border: none;border-left: 1px solid #bac7ce;border-top: 1px solid #bac7ce;border-bottom: 1px solid #bac7ce;border-right: 1px solid #bac7ce;color: #696969;width: 100%;text-align: left;padding: 10px;height: 100%; display: block;" class="form-control">
                                            <option value="" selected hidden>Date...</option>
                                            <option {{ isset($i['date']) && $i['date'] == '0' ? 'selected' : '' }} value="0">Today</option>
                                            <option {{ isset($i['date']) && $i['date'] == '7' ? 'selected' : '' }} value="7">This Week</option>
                                            <option {{ isset($i['date']) && $i['date'] == '30' ? 'selected' : '' }} value="30">This Month</option>
                                            <option {{ isset($i['date']) && $i['date'] == '60' ? 'selected' : '' }} value="60">2 Months</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <button style="background-color: #e8e8e8;border: none;border-left: 1px solid #bac7ce;border-top: 1px solid #bac7ce;border-bottom: 1px solid #bac7ce;border-right: 1px solid #bac7ce;color: #696969;width: auto;text-align: left;padding: 10px;height: 100%; display: block;" class="btn btn-default dropdown-toggle"><span class="glyphicon glyphicon-search"></span> Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
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
                                        {!! $jobs->links() !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</main>

@include('footer')