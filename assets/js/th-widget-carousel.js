( function( $ ) {

  var SwiperSliderHandler = function( $scope, $ ) {
  		//console.log($scope);

		var $selector = $scope.find('.swiper-container'),
				$dataSwiper  = $selector.data('swiper'),
				newSwiper = new Swiper($selector, $dataSwiper);

  };

  $( window ).on( 'elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction( 'frontend/element_ready/th-slides.default', SwiperSliderHandler );

  });

} )( jQuery );
