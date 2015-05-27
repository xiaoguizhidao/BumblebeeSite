	$(window).load(function() {
		  $('#slider').nivoSlider ({
				effect:'random', 
				slices:15,
				boxCols: 8,
				boxRows: 8,				
				animSpeed:600,
				pauseTime:8000,
				startSlide:0, //Set starting Slide (0 index)
				directionNav:false, //Next & Prev
				directionNavHide:true, //Only show on hover
				controlNav:true, //1,2,3...
				controlNavThumbs:false, //Use thumbnails for Control Nav
				controlNavThumbsFromRel:false, //Use image rel for thumbs
				controlNavThumbsSearch: '.jpg', //Replace this with...
				controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
				keyboardNav:true, //Use left & right arrows
				pauseOnHover:true, //Stop animation while hovering
				manualAdvance:false, //Force manual transitions
				captionOpacity:0.8, //Universal caption opacity
				beforeChange: function(){},
				afterChange: function(){},
				slideshowEnd: function(){}, //Triggers after all slides have been shown
				prevText: 'Prev',
				nextText: 'Next'
			});
		});