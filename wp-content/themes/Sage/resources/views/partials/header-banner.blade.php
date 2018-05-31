<header class="page-header background-image-page-header" style="background-image: url('{{ get_the_post_thumbnail_url(get_the_ID(),'full') }}')">
    <div class="page-header-inner container clr">
        @include('partials.nav-primary')
        <div class="page-header-table clr">
            <div class="page-header-table-cell">
                    <h1 class="page-header-title wpex-clr" itemprop="headline"><span>{!! App::title() !!}</span></h1>
            <div class="page-subheading clr">{{ the_field('title') }}</div>
            </div>
        </div>
      {{-- <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
 --}}
    </div>
    <span class="background-image-page-header-overlay style-dark"></span>
  </header>
  