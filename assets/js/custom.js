$(function() {
	$('#select').on('change', function() {
		var val = $(this).val();
		var sub = $('#sub-selects');
		$('option', sub).filter(function(){
			if (
				$(this).attr('data-group') === val
			 || $(this).attr('data-group') === 'SHOW'
				) {
				$(this).show();
			} else {
				$(this).hide();
			}

		});
	});
	$('#select').trigger('change');
});