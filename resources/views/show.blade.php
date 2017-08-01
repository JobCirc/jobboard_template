@include('header')
<main>
    <div class="row">
        <div class="col-md-7 col-md-offset-1 col-sm-8 col-sm-offset-1 col-xs-12 col-xs-offset-0" style="background: #fff;">
            <article>
                <div class="row">
                    <div class="col-md-11 col-sm-10 col-xs-9">
                        <h2>{{ $job->title }}</h2>
                        <div class="date"><b>Posted </b> {{ $job->updated_at->format('F m, Y') }}</div>
                        <div class="date"><b>Apply: </b> <a target="_blank" href="/out/{{ $job->id }}">{{ $job->company_name }}</a></div>
                        <br><br>
                    </div>
                </div>
                {!! $job->description !!}
                {!! $job->qualifications !!}
            </article>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12">
            @include('aside')
        </div>
    </div>
</main>

@include('footer')