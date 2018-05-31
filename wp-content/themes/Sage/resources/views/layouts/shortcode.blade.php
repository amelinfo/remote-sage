<!DOCTYPE html>
<html @php language_attributes() @endphp>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
     @include('partials.header') 	
    <div class="wrap container" role="document">
      <section class="section">
        @php $content= the_content(); 
        $content = trim($content, " \t\n");
       
        do_shortcode('{{$content}}');
         @endphp
      </section> 
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
