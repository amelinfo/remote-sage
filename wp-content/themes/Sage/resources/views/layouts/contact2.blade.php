<!DOCTYPE html>
<html @php language_attributes() @endphp>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    <main id="main" class="site-main clr">
     @include('partials.header-banner') 

    <div class="wrap container" role="document">
        <section class="section">
            <div class="columns">
                <div class="column contact_description">
                    {{ the_field('contact_text')}}
                </div>
            </div>    
        </section>
        @php $address1 = get_field('address_1'); $address2 = get_field('address_2'); $address3 = get_field('address_3'); @endphp    
        @php $address =urlencode($address1.''.$address2.''.$address3); @endphp
        <section class="section">
            <div class="acf-map hidden">
                @php $location = Contacts1::location() @endphp
                <div class="marker" data-lat="{{ $location->lat }}" data-lng="{{ $location->lng }}" data-animation="{{ $location->animation }}" data-marker="{{ $location->marker }}" data-style="{{ $location->style }}"></div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="full-width-input">
                       {!! do_shortcode('[contact-form-7 id="272" title="Contact form 2"]') !!}
                    </div>
                </div>
                <div class="column">
                  @if ($address)
                    <iframe
                    width="600"
                    height="485"
                    frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAwtPbsy79IiUBtcPuUSQ1J9V47cFXWFZA&q={{$address}}" allowfullscreen>
                    </iframe>
                  @endif

                </div>
            </div>
        </section> 
    </div>
    </main>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp

    <script>
{{-- 
        function initMap() {
                var lat= jQuery('.marker').data('lat');
                var lng= jQuery('.marker').data('lng');
                var animation= jQuery('.marker').data('animation');
                var marker= jQuery('.marker').data('marker');
                var selectedStyle= jQuery('.marker').data('style');
                var style = null;
                switch(selectedStyle){
                  case 'default':
                  break;

                  case 'light':
                     style = 
                    [
                        {
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#444444"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#46bcec"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        }
                    ]
                  break;

                  case 'blue':
                  	//define the basic color of your map, plus a value for saturation and brightness
                  var	$main_color = '#2d313f',	$saturation= -20, $brightness= 5;
                  //we define here the style of the map
                   style=
                    [ 
                      {
                        //set saturation for the labels on the map
                        elementType: "labels",
                        stylers: [
                          {saturation: $saturation}
                        ]
                      },  
                        {	//poi stands for point of interest - don't show these lables on the map 
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [
                          {visibility: "off"}
                        ]
                      },
                      {
                        //don't show highways lables on the map
                            featureType: 'road.highway',
                            elementType: 'labels',
                            stylers: [
                                {visibility: "off"}
                            ]
                        }, 
                      { 	
                        //don't show local road lables on the map
                        featureType: "road.local", 
                        elementType: "labels.icon", 
                        stylers: [
                          {visibility: "off"} 
                        ] 
                      },
                      { 
                        //don't show arterial road lables on the map
                        featureType: "road.arterial", 
                        elementType: "labels.icon", 
                        stylers: [
                          {visibility: "off"}
                        ] 
                      },
                      {
                        //don't show road lables on the map
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [
                          {visibility: "off"}
                        ]
                      }, 
                      //style different elements on the map
                      { 
                        featureType: "transit", 
                        elementType: "geometry.fill", 
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      }, 
                      {
                        featureType: "poi",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "poi.government",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "poi.sport_complex",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "poi.attraction",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "poi.business",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "transit",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "transit.station",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "landscape",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                        
                      },
                      {
                        featureType: "road",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      },
                      {
                        featureType: "road.highway",
                        elementType: "geometry.fill",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      }, 
                      {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [
                          { hue: $main_color },
                          { visibility: "on" }, 
                          { lightness: $brightness }, 
                          { saturation: $saturation }
                        ]
                      }
                    ];
                  break;

                  case 'dark-aqua':
                  style=
                    [
                      {
                        stylers: [
                          { visibility: "off" }
                        ]
                      },
                      {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [
                          { visibility: "on" },
                          { color: "#000000" },
                          { lightness: 17 }
                        ]
                      },
                      {
                        featureType: "landscape",
                        elementType: "geometry",
                        stylers: [
                          { visibility: "on" },
                          { color: "#000000" },
                          { lightness: 20 }
                        ]
                      },
                      {
                        featureType: "landscape",
                        elementType: "labels",
                        stylers: [
                          { visibility: "on" },
                          { color: "#000000" },
                          { lightness: 16 }
                        ]
                      },
                      {
                        featureType: "road.highway",
                        elementType: "geometry.fill",
                        stylers: [
                          { visibility: "on" },
                          { color: "#4DBBE9" },
                          { lightness: 17 }
                        ]
                      },
                      {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [
                          { visibility: "on" },
                          { saturation: 36 },
                          { color : "#000000" },
                          { lightness : 16 }
                        ]
                      },
                      {
                        featureType: "road.highway",
                        elementType: "labels.icon",
                        stylers: [
                          { visibility: "on" }
                        ]
                      },
                      {
                        featureType: "road.arterial",
                        elementType: "geometry",
                        stylers: [
                          { visibility: "on" },
                          { color : "#000000" },
                          { lightness : 16 }
                        ]
                      },
                      {
                        featureType: "road.arterial",
                        elementType: "labels.text",
                        stylers: [
                          { visibility: "on" },
                          { color: "#000000" },
                          { lightness: 16 }
                        ]
                      },
                      {
                        featureType: "road.arterial",
                        elementType: "labels.text.fill",
                        stylers: [
                          { saturation: 36 },
                          { color : "#ffffff" },
                          { lightness : 40 }
                        ]
                      },
                      {
                        featureType: "road.local",
                        elementType: "geometry.fill",
                        stylers: [
                          { visibility: "on" },
                          { color: "#000000" },
                          { lightness: 17 }
                        ]
                      },
                      {
                        featureType: "administrative.locality",
                        elementType: "labels.text",
                        stylers: [
                          { visibility: "on" },
                          { color: "#000000" },
                          { lightness: 16 }
                        ]
                      },
                      {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [
                          { visibility: "on" },
                          { color: "#ffffff" },
                          { lightness: 40 }
                        ]
                      }
                    ];
                  break;

                  case 'night-driving':
                  style= 
                    [
                      {
                        "featureType": "all",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "saturation": 36
                            },
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 40
                            }
                        ]
                      },
                      {
                        "featureType": "all",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 16
                            }
                          ]
                      },
                      {
                        "featureType": "all",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                          ]
                      },
                      {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "lightness": 17
                            },
                            {
                                "weight": 1.2
                            }
                          ]
                      },
                      {
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#a6b7ff"
                            }
                          ]
                      },
                      {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "lightness": 20
                            },
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#021d2b"
                            }
                          ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "lightness": 21
                            },
                            {
                                "visibility": "off"
                            }
                          ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#ffffff"
                            }
                          ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                          ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#0a6949"
                            },
                            {
                                "lightness": 17
                            }
                          ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "lightness": 29
                            },
                            {
                                "weight": 0.2
                            },
                            {
                                "visibility": "off"
                            }
                          ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#ffffff"
                            }
                          ]
                      },
                      {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 18
                            }
                          ]
                      },
                      {
                        "featureType": "road.arterial",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#28649c"
                            }
                          ]
                      },
                      {
                        "featureType": "road.arterial",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                          ]
                      },
                      {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "lightness": 16
                            },
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#0d2946"
                            }
                          ]
                      },
                      {
                        "featureType": "transit",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#fffdfd"
                            }
                          ]
                      },
                      {
                        "featureType": "transit.line",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                          ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 17
                            }
                          ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#5c8ebc"
                            }
                          ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#000000"
                            }
                          ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#ffffff"
                            }
                          ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                      }
                    ]
                  break;
                  case 'forest':
                  style= 
                    [
                        {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
                        {
                          featureType: 'administrative',
                          elementType: 'geometry.stroke',
                          stylers: [{color: '#c9b2a6'}]
                        },
                        {
                          featureType: 'administrative.land_parcel',
                          elementType: 'geometry.stroke',
                          stylers: [{color: '#dcd2be'}]
                        },
                        {
                          featureType: 'administrative.land_parcel',
                          elementType: 'labels.text.fill',
                          stylers: [{color: '#ae9e90'}]
                        },
                        {
                          featureType: 'landscape.natural',
                          elementType: 'geometry',
                          stylers: [{color: '#dfd2ae'}]
                        },
                        {
                          featureType: 'poi',
                          elementType: 'geometry',
                          stylers: [{color: '#dfd2ae'}]
                        },
                        {
                          featureType: 'poi',
                          elementType: 'labels.text.fill',
                          stylers: [{color: '#93817c'}]
                        },
                        {
                          featureType: 'poi.park',
                          elementType: 'geometry.fill',
                          stylers: [{color: '#a5b076'}]
                        },
                        {
                          featureType: 'poi.park',
                          elementType: 'labels.text.fill',
                          stylers: [{color: '#447530'}]
                        },
                        {
                          featureType: 'road',
                          elementType: 'geometry',
                          stylers: [{color: '#f5f1e6'}]
                        },
                        {
                          featureType: 'road.arterial',
                          elementType: 'geometry',
                          stylers: [{color: '#fdfcf8'}]
                        },
                        {
                          featureType: 'road.highway',
                          elementType: 'geometry',
                          stylers: [{color: '#f8c967'}]
                        },
                        {
                          featureType: 'road.highway',
                          elementType: 'geometry.stroke',
                          stylers: [{color: '#e9bc62'}]
                        },
                        {
                          featureType: 'road.highway.controlled_access',
                          elementType: 'geometry',
                          stylers: [{color: '#e98d58'}]
                        },
                        {
                          featureType: 'road.highway.controlled_access',
                          elementType: 'geometry.stroke',
                          stylers: [{color: '#db8555'}]
                        },
                        {
                          featureType: 'road.local',
                          elementType: 'labels.text.fill',
                          stylers: [{color: '#806b63'}]
                        },
                        {
                          featureType: 'transit.line',
                          elementType: 'geometry',
                          stylers: [{color: '#dfd2ae'}]
                        },
                        {
                          featureType: 'transit.line',
                          elementType: 'labels.text.fill',
                          stylers: [{color: '#8f7d77'}]
                        },
                        {
                          featureType: 'transit.line',
                          elementType: 'labels.text.stroke',
                          stylers: [{color: '#ebe3cd'}]
                        },
                        {
                          featureType: 'transit.station',
                          elementType: 'geometry',
                          stylers: [{color: '#dfd2ae'}]
                        },
                        {
                          featureType: 'water',
                          elementType: 'geometry.fill',
                          stylers: [{color: '#b9d3c2'}]
                        },
                        {
                          featureType: 'water',
                          elementType: 'labels.text.fill',
                          stylers: [{color: '#92998d'}]
                        }
                    ]
                  break;
                }
                var zoom = 11;
                if(jQuery(window).width() < 769){
                  zoom = 7
                }
                var uluru = {lat: lat, lng: lng};
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: zoom,
                  center: uluru,
                  panControl: false,
                  //zoomControl: false,
                  mapTypeControl: false,
                  streetViewControl: false,
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
                  scrollwheel: false,
                  styles: style,
                });
                var anim='flase';
                if(animation) anim= google.maps.Animation.DROP
                marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: {lat: lat, lng: lng},
                icon: marker,
                });
                marker.addListener('click', toggleBounce);
        }
        function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }        --}}
    </script>
  </body>
</html>
