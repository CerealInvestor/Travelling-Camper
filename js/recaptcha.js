// when form is submit
$(document).on('submit', '.commentForm', function(event){

    // we stoped it
    event.preventDefault();
    
    var messageUser = $('#messageUseressageUser').val();
    var messageText = $("#messageText").val();
    var pageType = $("#pageType").val();
    var postId = $("#postId").val();
    var slug = $("#slug").val();
    // needs for recaptacha ready
    grecaptcha.ready(function() {
        // do request for recaptcha token
        // response is promise with passed token
        grecaptcha.execute('6Lc-t1QhAAAAAENc0r9rr-nJ9We6GZEG0Lk9rdwB', {action: 'create_comment'}).then(function(token) {
            // add token to form
            $('#commentForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $.post("../_requests/recaptcha.php",{
                	messageUser: messageUser, 
                	messageText: messageText,
                	pageType: pageType,
                	postId: postId,
                	slug: slug, 
                	token: token
                }, function(result) {
                        console.log(result);
                        if(result.success) {
                                alert('Thanks for posting comment.')
                        } else {
                                alert('You are spammer ! Get the out.')
                        }
                });
        });;
    });
});