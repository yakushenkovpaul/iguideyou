(function($){
	"use strict";
	$(document).ready(function(){

		/*accordion panel*/
		$('body').on('click','.admin-panel-head', function(){
			if($(this).closest('.admin-panel-wrap').hasClass('show')){
				$('.admin-panel-wrap').removeClass('show');
			}
			else{
				$('.admin-panel-wrap').removeClass('show');
				$(this).closest('.admin-panel-wrap').addClass('show');
			}
		});


	});


})(jQuery);