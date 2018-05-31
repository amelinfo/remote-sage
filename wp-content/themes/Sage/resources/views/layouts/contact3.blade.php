<!DOCTYPE html>
<html @php language_attributes() @endphp>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <main id="main" class="site-main clr">
     @include('partials.header-banner') 

    <div class="wrap container" role="document">
        <section class="section">
            <div class="columns">
                    <div class="column">
                        @yield('content')
                    </div>
            </div>    
        </section>
        <section class="section">
            <div class="columns">
                <div class="column">
                    <div class="full-width-input">
                       {!! do_shortcode('[contact-form-7 id="281" title="Contact form 3"]') !!}
                    </div>
                </div>
                <div class="column">
                        <div class="contact3-info-widget contact3-clr">
                            <div class="widget-title">Business Info</div>
                            <div class="contact3-info-widget-address contact3-clr">
                                <p><span class="fa fa-map-marker"></span>
                                @php $address1 = get_field('address_1'); $address2 = get_field('address_2'); $address3 = get_field('address_3'); @endphp    
                                @if ($address1)
                                    {{ $address1 }}<br/>
                                @endif
                                @if ($address2)
                                    {{ $address2 }}<br/>
                                @endif
                                @if ($address3)
                                    {{ $address3 }}<br/>
                                @endif
                                @php $address =urlencode($address1.''.$address2.''.$address3); @endphp
                            </div>
                            <div class="contact3-info-widget-phone contact3-clr">
                                <span class="fa fa-phone"></span>
                                {{ the_field('tel')}}
                            </div>
                            <div class="contact3-info-widget-fax contact3-clr">
                                <span class="fa fa-fax"></span>
                                {{ the_field('fax')}}
                            </div>
                            <div class="contact3-info-widget-email contact3-clr">
                                <span class="fa fa-envelope"></span>
                                <a href="mailto:{{ the_field('email')}}">{{ the_field('email')}}</a>
                            </div> 
                            @php $fb_link = get_field('facebook_page_link'); @endphp
                            @if($fb_link)
                                <div class="fb-page" data-href="{{$fb_link}}" data-tabs="timeline" data-height="180" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{$fb_link}}" class="fb-xfbml-parse-ignore"></blockquote></div>
                            @endif
                        </div>

                </div>
            </div>
        </section> 
    </div>
    </main>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
</body>
</html>