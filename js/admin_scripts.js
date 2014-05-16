jQuery(document).ready(function() {  
	jQuery('#user-select').change(function(){
		jQuery('.user-table').each(function(){
			if(!jQuery(this).hasClass('hide')) jQuery(this).addClass('hide');
		});
		
		jQuery('#user-' + jQuery(this).val()).removeClass('hide');
	});
});