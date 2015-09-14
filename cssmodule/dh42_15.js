$(document).ready(function() {



	// Change it to yours

	var affiliate_url = '001';

	var licontent  = '<li class="submenu_size  maintab" id="maintab-Dh42" data-submenu="99">';

			licontent += '<a style="background-color:#ff5450; color: white" href="javascript:void(0)" class="title">';

				licontent += '<span>Get PrestaShop Support</span>';

			licontent += '</a>';

		licontent += '</li>';



	$('#.menu').append(licontent);



	$('#maintab-Dh42 a').click(function(e) {

		e.preventDefault();

		if($('#dh42-support-container').length == 0)
			$('body').append('<div id="dh42-support-container" class="modal fade"><div class="modal-dialog" style="height:75%;width:75%""><iframe src="https://dh42.com/support/aff.php?aff='+affiliate_url+'&support=true&iframe=yes" width=100% height=100%></iframe><style>#main-header {display:none}</style></div></div>');

		$('#dh42-support-container').modal('show');



	});

});