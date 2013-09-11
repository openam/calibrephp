$(function() {

	$(".calibre-share").click(function(e) {

		var obj = $(this);
		var shareUrl = obj.data("share-url");

		// Prevent default (do not follow link)
		e.preventDefault();

		// Find share button
		var shareButton = obj.closest(".btn-group").children(".btn");
		var shareButtonIcon = shareButton.children("i");

		// Change icon to rotating refresh-icon
		shareButtonIcon.removeClass("icon-envelope").addClass("icon-refresh icon-spin");

		// Do AJAX request
		$.post(shareUrl, function(result)
		{
			// Change icon to check + stop rotating
			shareButtonIcon.removeClass("icon-refresh icon-spin").addClass("icon-ok");
		});
	});

});
