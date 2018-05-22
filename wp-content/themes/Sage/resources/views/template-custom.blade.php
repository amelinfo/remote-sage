{{--
  Template Name: Custom Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    <?php $testimonial = get_option( 'testimonial_view' );
      $style= get_option('testimonial_slider_style');
      $orderby = get_option('testimonial_orderby');
      $order = get_option('testimonial_order');
      $thumb = get_option('testimonial_thumb');
      $limit = get_option('testimonial_limit');
    if($testimonial == 'slider')
    {
      //$autoslide= true;

      $autoslide=(get_option('auto_slide') == 1 ) ? "true" : "false" ;
      $animationSpeed = get_option('animation_speed');
      $animation = get_option('animation_type');
      $slideshowSpeed = get_option('slide_show_speed');
      
    echo do_shortcode('[sliding_testimonials style="'.$style.'" orderby="'.$orderby.'" 
    order="'.$order.'" post_id="" thumb="'.$thumb.'" 
    limit="'.$limit.'" autoslide="'.$autoslide.'" animation="'.$animation.'" slideshowSpeed='.$slideshowSpeed.' animationSpeed='.$animationSpeed.']'); 
    }
    else{
    echo do_shortcode('[testimonials view=list style="'.$style.'" orderby="'.$orderby.'" 
    order="'.$order.'" post_id="" thumb="'.$thumb.'" limit="'.$limit.'"]');
    }
?>   
  @endwhile
@endsection
