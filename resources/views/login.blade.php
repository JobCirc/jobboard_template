@include('header')

<main>
    <div class="row">
        <div class="col-md-9">
            <div class="search">
            </div>
            <div class="row">
                <div class="col-md-5 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <form class="login text-center" method="post">
                        {!! csrf_field() !!}
                        @if(!empty($_POST))
                            <p class="bg-red text-center" style="color:white;padding:5px;margin-bottom:20px;">Please check credentials and try again.</p>
                        @endif
                        <div class="login-signup">
                            <a class="btn btn-login active">Log in</a>
                            <a  class="btn btn-signup">Sign up</a>
                        </div>
                        <div class="form-group">
                            <div class="input-group pull-left">
                                <span class="input-group-addon bg-red" id="basic-addon3"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon3">
                            </div>
                            <a disabled class="btn signup pull-right">Sign up</a>
                        </div>
                        <div class="form-group">
                            <div class="input-group pull-left">
                                <span class="input-group-addon bg-blue" id="basic-addon4"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span>
                                <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon4">
                            </div>
                            <a href="/contact" class="btn contact pull-right">Contact</a>
                        </div>
                        <button type="submit" value="log" class="btn btn-signin">Log in</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12">
            @include('aside')
        </div>
    </div>
</main>

@include('footer')