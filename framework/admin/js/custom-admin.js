jQuery(document).ready(function(){
	(function( $ ) { 

	// Update the admin options
    $('.tf-update-button').click(function (e) {
        $('#tf-js-options-form').submit();
        e.preventDefault();
    });

    // WordPress upload media
 	$('.tf-js-upload').on('click', function (e) {
 		var $this = $(this),
 			$option = $this.closest('.tf-option-content'),
 			$input = $('input', $option);

        wp.media.editor.send.attachment = function (props, attachment) {
            $input.val(attachment.url);
        }
        wp.media.editor.open(this);
      	e.preventDefault();
    });

    // WordPress preview image for upload
     $('.tf-js-preview').on('click', function (e) {
        var $this = $(this),
 			$option = $this.closest('.tf-option-content'),
 			$input = $('input', $option);

            imgSource = '<img src="' + $input.val() + '" />',
            imgPreview = $option.find('.preview-content-block .preview-content-container');

        $(imgPreview).empty();
        $(imgSource).appendTo(imgPreview);
         e.preventDefault();
    });

    $('.tf-remove-upload').on('click', function(e) {
    	e.preventDefault();

    	var $this = $(this),
    		$option = $this.closest('.tf-option-content'),
 			$input = $('input', $option);

 		$input.val('');
    })

    // WordPress Colorpicker
    $('.tf-js-color-picker').wpColorPicker();

    // Radio Images
    $('.tf-radio-images label').on('click', function() {
    	var $this = $(this);
    	$this.addClass('checked').siblings().removeClass('checked');
    });



		// // Add Sidebar 
		// $('.option-add-sidebar').on('click', function() {
		// 	var newSidebarName = $(this).parent().find('.option-sidebar-add-input').val();
		// 	var sidebarInput = $(this).data('input');
		// 	var $sidebarInput = $("#" + sidebarInput);

		// 	var newSidebarList = $sidebarInput.val();
		// 	newSidebarList = newSidebarList + ',' + newSidebarName;

		// 	$sidebarInput.val(newSidebarList);

		// 	var sidebarList = $sidebarInput.parent().find('ul');
		// 	sidebarList.append('<li data-sidebarname="' + newSidebarName + '">' + newSidebarName + '<a href="#" class="option-remove-sidebar">X</a></li>');
		// });

		// $('.option-remove-sidebar').on('click', function() {
		// 	var sidebarName = $(this).parent().data('sidebarname');		
		// 	var inputElement = $(this).closest('.options-left-section').find('input');
		// 	var elemToDelete = $(this);
		// 	var messagePosition = elemToDelete.parent().position();

		// 	$('.remove-message').css({
		// 		left: messagePosition.left,
		// 		top: messagePosition.top
		// 	}).fadeIn();

		// 	$('.remove-message').find('.remove-cancel').on('click', function() {
		// 		$(this).parent().hide();
		// 		return;
		// 	});

		// 	$('.remove-message').find('.remove-true').on('click', function() {
		// 		currentSidebars = inputElement.val();
		// 		currentSidebars = currentSidebars.replace(sidebarName,'');
		// 		inputElement.val(currentSidebars);
		// 		elemToDelete.parent().fadeOut(250, function() {
		// 			$(this).remove();
		// 		})

		// 		$(this).parent().hide();
		// 	});
		// });

	})( jQuery, window, document );
 });