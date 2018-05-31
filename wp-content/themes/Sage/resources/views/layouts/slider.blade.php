<!DOCTYPE html>
<html @php language_attributes() @endphp>
@include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
      @include('partials.header-slider')
     
        @php $content= the_content(); 
        $content = trim($content, " \t\n");
       
        do_shortcode('{{$content}}');
         @endphp

      <div id="features" class="features section" role="document">
        <div class="container">
          <div class="section-heading features-heading">
            <div class="section-title features-title heading">Our core features</div>
            </div>
            <div class="columns wpb_row columns vc_row columns-fluid vc_custom_1489891119252">
              <div class="wpb_column vc_column_container column">
                <div class="vc_column-inner ">
                  <div class="wpb_wrapper">
                    <div class="module icon-box clr icon-box-one">
                      <div class="icon-box-container">
                        <div class="icon-box-icon">
                          <span class="fa fa-trophy" aria-hidden="true"></span>
                        </div>
                      </div>
                      <h2 class="icon-box-heading">Fully Customizable</h2>
                      <div class="icon-box-content clr">
                        <p>Etiam pretium leo risus, non varius nibh facilisis aliquet. Fusce aliquam fermentum lectus vel condimentum. Vestibulum non orci velit&nbsp;cursus et aptent justo.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="wpb_column vc_column_container column">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="module icon-box clr icon-box-one">
                    <div class="icon-box-container">
                      <div class="icon-box-icon">
                        <span class="fa fa-shopping-cart" aria-hidden="true"></span>
                      </div>
                    </div>
                    <h2 class="icon-box-heading">WooCommerce Support</h2>
                    <div class="icon-box-content clr">
                      <p>Etiam pretium leo risus, non varius nibh facilisis aliquet. Fusce aliquam fermentum lectus vel condimentum. Vestibulum non orci velit&nbsp;cursus et aptent justo.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="wpb_column vc_column_container column">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="module icon-box clr icon-box-one">
                    <div class="icon-box-container">
                      <div class="icon-box-icon">
                        <span class="fa fa-search" aria-hidden="true"></span>
                      </div>
                    </div>
                      <h2 class="icon-box-heading">SEO Optimized</h2>
                    <div class="icon-box-content clr">
                        <p>Etiam pretium leo risus, non varius nibh facilisis aliquet. Fusce aliquam fermentum lectus vel condimentum. Vestibulum non orci velit&nbsp;cursus et aptent justo.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div> 
      </div>
      <div id="tagline" class="section tagline">
        <div class="container">	
          <div class="tagline-body">
            <div class="tagline-content">Phasellus porta, ipsum faucibus euismod blandit, nulla velit <a href="#">ullamco sodales est eros in sapien</a>.</div>
          </div>
        </div>
      </div>
      <div id="portfolio" class="section portfolio">
        <div class="container">
          <div class=" section-heading portfolio-heading">
            <div class="section-title portfolio-title heading">Take a look at our work</div>
          </div>		
          <div class="row columns">
            <div class="column column-fit col3">
              <div class="portfolio-item dark  portfolio-item-has-excerpt">
                <a class="portfolio-item-link" href="https://demos.cpothemes.com/ascendant/portfolio-item/loughtay/"></a>
                <div class="portfolio-item-overlay is-primary"></div>
                <h3 class="portfolio-item-title"> Portfolio Slideshow	</h3>
                <div class="portfolio-item-description">
                  <p>This is a small description of the portfolio item, viewed from the main portfolio.</p>
                </div>
                <img width="368" height="270" src="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/StockSnap_BCLRC8333.jpg" class="attachment-portfolio size-portfolio wp-post-image" alt="" title="" srcset="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/StockSnap_BCLRC8333.jpg 368w, https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/StockSnap_BCLRC8333-300x220.jpg 300w" sizes="(max-width: 368px) 100vw, 368px">
              </div>
            </div>
            <div class="column column-fit col3">
              <div class="portfolio-item dark  portfolio-item-has-excerpt">
                <a class="portfolio-item-link" href="https://demos.cpothemes.com/ascendant/portfolio-item/hdr-gallery/"></a>
                <div class="portfolio-item-overlay is-primary"></div>
                <h3 class="portfolio-item-title"> HDR Gallery	</h3>
                <div class="portfolio-item-description">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac est nunc.</p>
                </div>
                <img width="368" height="270" src="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/technology-792180_1280.jpg" class="attachment-portfolio size-portfolio wp-post-image" alt="" title="" srcset="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/technology-792180_1280.jpg 368w, https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/technology-792180_1280-300x220.jpg 300w" sizes="(max-width: 368px) 100vw, 368px">
              </div>
            </div>
            <div class="column column-fit col3">
              <div class="portfolio-item dark  portfolio-item-has-excerpt">
                <a class="portfolio-item-link" href="https://demos.cpothemes.com/ascendant/portfolio-item/old-ship/"></a>
                <div class="portfolio-item-overlay is-primary"></div>
                <h3 class="portfolio-item-title"> Beach	</h3>
                <div class="portfolio-item-description">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac est nunc.</p>
                </div>
                <img width="368" height="270" src="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/paint-1772747_1280.jpg" class="attachment-portfolio size-portfolio wp-post-image" alt="" title="" srcset="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/paint-1772747_1280.jpg 368w, https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/paint-1772747_1280-300x220.jpg 300w" sizes="(max-width: 368px) 100vw, 368px">
              </div>
            </div>
          </div>
          <div class="row columns">
            <div class="column column-fit col3">
              <div class="portfolio-item dark  portfolio-item-has-excerpt">
                <a class="portfolio-item-link" href="https://demos.cpothemes.com/ascendant/portfolio-item/loughtay/"></a>
                <div class="portfolio-item-overlay is-primary"></div>
                <h3 class="portfolio-item-title"> Kuala Lumpur	</h3>
                <div class="portfolio-item-description">
                  <p>This is a small description of the portfolio item, viewed from the main portfolio.</p>
                </div>
                <img width="368" height="270" src="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/05/background-2846221_1280.jpg" class="attachment-portfolio size-portfolio wp-post-image" alt="" title="" srcset="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/05/background-2846221_1280.jpg 368w, https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/05/background-2846221_1280-300x220.jpg 300w" sizes="(max-width: 368px) 100vw, 368px">
              </div>
            </div>
            <div class="column column-fit col3">
              <div class="portfolio-item dark  portfolio-item-has-excerpt">
                <a class="portfolio-item-link" href="https://demos.cpothemes.com/ascendant/portfolio-item/hdr-gallery/"></a>
                <div class="portfolio-item-overlay is-primary"></div>
                <h3 class="portfolio-item-title"> Autumn Field	</h3>
                <div class="portfolio-item-description">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac est nunc.</p>
                </div>
                <img width="368" height="270" src="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/portfolio-_0002_tablet-1250410_1280.png" class="attachment-portfolio size-portfolio wp-post-image" alt="" title="" srcset="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/portfolio-_0002_tablet-1250410_1280.png 368w, https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/portfolio-_0002_tablet-1250410_1280-300x220.png 300w" sizes="(max-width: 368px) 100vw, 368px">
              </div>
            </div>
            <div class="column column-fit col3">
              <div class="portfolio-item dark  portfolio-item-has-excerpt">
                <a class="portfolio-item-link" href="https://demos.cpothemes.com/ascendant/portfolio-item/old-ship/"></a>
                <div class="portfolio-item-overlay is-primary"></div>
                <h3 class="portfolio-item-title"> Hong Kong	</h3>
                <div class="portfolio-item-description">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac est nunc.</p>
                </div>
                <img width="368" height="270" src="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/portfolio-_0000_macbook-336651_1280.png" class="attachment-portfolio size-portfolio wp-post-image" alt="" title="" srcset="https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/portfolio-_0000_macbook-336651_1280.png 368w, https://mk0cpothemesdemokfq4.kinstacdn.com/wp-content/uploads/sites/38/2012/04/portfolio-_0000_macbook-336651_1280-300x220.png 300w" sizes="(max-width: 368px) 100vw, 368px">
              </div>
            </div>
          </div>	
        </div>
      </div>
      <div id="services" class="section services">
        <div class="container">
          <div class=" section-heading services-heading"><div class="section-title services-title heading">What we can offer you</div></div>
            <div class="row columns">
              <div class="column  col2">
                <div class="service">
                  <a href="https://demos.cpothemes.com/ascendant/service/performance-auditing/"> <div class="is-primary service-icon"><span class="lnr lnr-laptop-phone"></span></div>		</a>
                  <div class="service-body">
                    <h3 class="service-title"> <a href="https://demos.cpothemes.com/ascendant/service/performance-auditing/">Performance Auditing</a>	</h3>
                    <div class="service-content">
                      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="column  col2">
                <div class="service">
                  <a href="https://demos.cpothemes.com/ascendant/service/wordpress-acceleration/"> <div class="is-primary service-icon"><span class="lnr lnr-chart-bars"></span></div>		</a>
                  <div class="service-body">
                    <h3 class="service-title"><a href="https://demos.cpothemes.com/ascendant/service/wordpress-acceleration/">WordPress Acceleration</a></h3>
                    <div class="service-content">
                      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row columns">
              <div class="column  col2">
                <div class="service">
                      <a href="https://demos.cpothemes.com/ascendant/service/web-development/"> <div class="is-primary service-icon"><span class="lnr lnr-leaf"></span></div>		</a>
                      <div class="service-body">
                        <h3 class="service-title"> <a href="https://demos.cpothemes.com/ascendant/service/web-development/">Web Development</a></h3>
                        <div class="service-content">
                          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                        </div>
                      </div>
                </div>
              </div>
              <div class="column col2">
                <div class="service">
                  <a href="https://demos.cpothemes.com/ascendant/service/premium-consulting/">	<div class="is-primary service-icon"><span class="lnr lnr-earth"></span></div>		</a>
                  <div class="service-body">
                    <h3 class="service-title">	<a href="https://demos.cpothemes.com/ascendant/service/premium-consulting/">Premium Consulting</a></h3>
                    <div class="service-content">
                      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div id="testimonials" class="section testimonials">
        <div class="container">	
          <div class=" section-heading testimonials-heading">
            <div class="section-title testimonials-title heading">What they say about us</div>
          </div>
          @php echo do_shortcode('[testimonials view=list style="three" orderby="rand" order="DESC" post_id="" thumb="large" limit="-1"]') @endphp
        </div>
      </div>
      <div id="clients" class="section clients">
        <div class="container">
            <div class=" section-heading clients-heading"><div class="section-title clients-title heading">Our Clients</div></div>
            @php echo do_shortcode('[sponsors category=clients size=full]')  @endphp
        </div>
      </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
