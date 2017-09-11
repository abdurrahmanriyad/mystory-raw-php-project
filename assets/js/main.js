$("document").ready(function () {
    $('#login').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '4%', // Starting top style attribute
        endingTop: '10%', // Ending top style attribute
    });

    $('select').material_select();

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });

    $('.story_block .upvote button').each(function () {
        $(this).on('click', function() {
           var userId = $(this).attr('data-userId');
           var storyId = $(this).attr('data-storyId');
           var activateElem = $(this).closest('div.like');
           storyLike($(this).next(),activateElem ,userId,storyId);
        });
    });


    $('.single_answer_content .upvote button').each(function () {
        $(this).on('click', function() {
           var userId = $(this).attr('data-userId');
           var storyId = $(this).attr('data-storyId');
           var commentId = $(this).attr('data-commentId');
           var activateElem = $(this).closest('li.like');
           commentLike($(this).next(),activateElem ,userId,storyId, commentId);
        });
    });

    $('.reply .upvote button').each(function () {
        $(this).on('click', function() {
            var userId = $(this).attr('data-userId');
            var storyId = $(this).attr('data-storyId');
            var commentId = $(this).attr('data-commentId');
            var replyId = $(this).attr('data-replyId');
            var activateElem = $(this).closest('li.like');
            replyLike($(this).next(),activateElem ,userId, storyId, commentId, replyId);
        });
    });


});

function storyLike(element, activateElem, userId, storyId) {
    $.ajax({
        type: "POST",
        url: "http://localhost:8888/mystory/api/like/story/"+storyId,
        headers: {
            'Authorization': 123
        },
        data: {
            "userId" : userId
        },
        dataType: "json",
        success: function(result){
            element.text(result.likeCount);
            if (result.liked) {
                if (!activateElem.hasClass('liked')) {
                    activateElem.addClass('liked')
                }
            } else {
                if (activateElem.hasClass('liked')) {
                    activateElem.removeClass('liked')
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //alert(xhr.status);
            //alert(thrownError);
        }

    });
}

function commentLike(element, activateElem, userId, storyId, commentId) {
    $.ajax({
        type: "POST",
        url: "http://localhost:8888/mystory/api/like/comment/"+commentId,
        headers: {
            'Authorization': 123
        },
        data: {
            "userId" : userId,
            "storyId": storyId
        },
        dataType: "json",
        success: function(result){
            element.text(result.likeCount);
            if (result.liked) {
                if (!activateElem.hasClass('liked')) {
                    activateElem.addClass('liked')
                }
            } else {
                if (activateElem.hasClass('liked')) {
                    activateElem.removeClass('liked')
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //alert(xhr.status);
            //alert(thrownError);
        }

    });
}

function replyLike(element, activateElem, userId, storyId, commentId, replyId) {
    $.ajax({
        type: "POST",
        url: "http://localhost:8888/mystory/api/like/reply/"+replyId,
        headers: {
            'Authorization': 123
        },
        data: {
            "userId" : userId,
            "storyId": storyId,
            "commentId": commentId
        },
        dataType: "json",
        success: function(result){
            element.text(result.likeCount);
            if (result.liked) {
                if (!activateElem.hasClass('liked')) {
                    activateElem.addClass('liked')
                }
            } else {
                if (activateElem.hasClass('liked')) {
                    activateElem.removeClass('liked')
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //alert(xhr.status);
            //alert(thrownError);
        }

    });
}


function updateValue(element, value) {
    element.text(value);
}