var formObject = {
	urlRemove : '/mod/remove.php',
	run : function() {
		formObject.removeTrigger($('.removeConfirm'));
		formObject.remove($('.remove'));
		formObject.cancel($('.cancel'));
	},
	removeTrigger : function(obj) {
		obj.live('click', function() {
			$(this).parent().prev('.confirm').fadeIn(200);
			return false;
		});
	},
	remove : function(obj) {
		obj.live('click', function() {
			var thisParent = $(this).parent('.confirm').parent('.comment');
			var thisId = $(this).attr('data-id');
			jQuery.post(formObject.urlRemove, { id : thisId }, function(data) {
				if (!data.error) {
					thisParent.fadeOut(200, function() {
						if (data.posts > 0) {
							$(this).remove();
						} else {
							$(this).replaceWith($('<p>There are currently no comments.</p>').hide().fadeIn(200));
						}
					});
				}
			}, 'json');
			return false;
		});
	},
	cancel : function(obj) {
		obj.live('click', function() {
			$(this).parent('.confirm').fadeOut(200);
			return false;
		});
	}
};
$(function() {
	formObject.run();
});










