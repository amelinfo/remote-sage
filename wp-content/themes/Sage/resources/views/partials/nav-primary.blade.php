    <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
        
    <div class="navbar-menu" id="navMenu">
        <nav id="navigation" class="navbar flex-center-web full-width" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <div class="logo">
                    @php
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        if($custom_logo_id) :
                            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    @endphp        
                        <a class="brand" href="{{ home_url('/') }}"><img src="{{ $image[0] }}" alt="Logo"></a>
                    @php    
                        else: 
                    @endphp
                        <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
                    @php
                        endif;
                    @endphp
                </div>
            </div>
            <div class="nav-primary">
                    <div class="navbar-start"></div>
                    
                    @if (has_nav_menu('primary_navigation'))
                    {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'container' => false, 'menu_class' => 'navbar-end', 'fallback_cb' => 'bulmapress_navwalker::fallback', 'walker' => new App\bulmapress_navwalker()]) !!}
                    @endif
            </div>
        </nav>
    </div>