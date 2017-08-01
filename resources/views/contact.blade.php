@include('header')

<main>
    <div class="row">
        <div class="col-md-9">
            <div class="search">
            </div>
            <div class="row">
                <div style="background:#fff;" class="col-md-5 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <form action="/contact" method="post" class="contact">
                        {!! csrf_field() !!}
                        <h2 style="background:#dc1414;color:#fff;padding:20px;margin-bottom:10px;text-align:center;"><i class="fa fa-paper-plane"></i> Contact Us</h2>
                        <p style="margin-bottom:20px;">If you want your jobs published on our site on a large scale, contact us to know about our API.</p>
                        @if(isset($sent))
                            <div class="alert alert-success">Your message has been sent, thank you!</div>
                        @endif
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" placeholder="Your Email..." required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="company" class="form-control" placeholder="Your Company..." required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" name="subject" class="form-control" placeholder="How can we help you?">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <textarea required rows="8" name="message" placeholder="Be as detailed as you want!" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 col-md-offset-7">
                                <button type="submit" class="btn btn-send">Send</button>
                            </div>
                            <div class="col-md-2">
                                <button type="button" onclick="jQuery(this).closest('form').find('input, textarea').val('')" class="btn btn-reset">Reset</button>
                            </div>
                        </div>
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