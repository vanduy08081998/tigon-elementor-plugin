( function( $ ) {

  var GalleryPopupHandler = function( $scope, $ ) {
  		//console.log($scope);

		var $selector = $scope.find('.wp-block-gallery'),
        galleryItem = $selector.find('.wp-block-image img');

        galleryItem.on('click',function(e) {
          var img_url = $(this).attr('src');
          $(this).magnificPopup({
            type: 'image',
            items: {
              src: img_url
            },
            gallery:{
              enabled:true
            }
          });
        });


  };

  $( window ).on( 'elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction( 'frontend/element_ready/th-post-content.default', GalleryPopupHandler );

  });

} )( jQuery );
