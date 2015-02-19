
function initForumLike() {

	// Remove Existing Handlers
    $('.likeAnchor').off("click");
    $('.unlikeAnchor').off("click");

    // Handle Click on a Like Button
    $('.forumLikeAnchor').on("click", function(event) {

        event.preventDefault();

        // Get ClassName and Id from Anchor
        arr = $(this).attr('id').split("-", 2); // Split: Object_1-LikeLink 
        arr = arr[0].split("_", 2); // Split: Object_1
        className = arr[0];
        id = arr[1];

        // Build Like Url
        url = "";
        if ($(this).hasClass('unlike')) {
            url = forumUnlikeUrl.replace('-className-', className);
            url = url.replace('-id-', id);
        } else if ($(this).hasClass('like')) {
            url = forumLikeUrl.replace('-className-', className);
            url = url.replace('-id-', id);
        } else {
            alert("Error: Invalid Like Anchor!");
            return;
        }


        // Execute Like
        data = {};
        data[csrfName] = csrfValue;
        
        $.ajax({
            dataType: "json",
            type: 'POST',
            data: data,
            url: url
        }).done(function(data) {

            // Switch Links
            if (data.currentUserLiked) {
                $('#' + className + "_" + id + "-UnlikeLink").show();
                $('#' + className + "_" + id + "-LikeLink").hide();
            } else {
                $('#' + className + "_" + id + "-UnlikeLink").hide();
                $('#' + className + "_" + id + "-LikeLink").show();
            }

            updateForumLikeCounters(className, id, data.likeCounter);

        });

    });

}

/**
 * Updates the Like Counters
 * 
 * This function will be called by ShowLikesWidget.
 * 
 * @param {type} className
 * @param {type} id
 * @param {type} count
 * @returns {undefined} 
 */
function updateForumLikeCounters(className, id, count) {
	$('.' + className + "_" + id + "-LikeCount").hide();
	if (count > 0)
    	$('.' + className + "_" + id + "-LikeCount").show();
	$('.' + className + "_" + id + "-LikeCount").html('(' + count + ')');
}
