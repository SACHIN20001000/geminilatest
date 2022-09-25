$(function () {
    let pusher = new Pusher($("#pusher_app_key").val(), {
         cluster: $("#pusher_cluster").val(),
         encrypted: true
     });
 
     let channel = pusher.subscribe('chat');
 
 
     // on click on any chat btn render the chat box

 
    // on close chat close the chat box but don't remove it from the dom
    $(".close-chat").on("click", function (e) {
 
        $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
    });
 });
 $(".btn-chat").on("click", function (e) {
    send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val(), null);

});
$(".chat_input").on("change keyup", function (e) {
    if($(this).val() != "") {
        $(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
    } else {
        $(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
    }
});

$(".chat-area").on("scroll", function (e) {
    if(noMoreMessages) {
        return;
    }
    let st = $(this).scrollTop();

    if(st < lastScrollTop) {
        scrollEvery += 1;

        if(scrollEvery % 10 == 0) {
            fetchOldMessages($(this).parents(".chat-opened").find(".to_user_id").val(), $(this).find(".msg_container:first-child").attr("data-message-id"), (response) => {
                noMoreMessages = response.no_more_messages;

                if(noMoreMessages) {
                    let chatArea = $(this).parents(".chat-opened").find(".chat-area");
                    chatArea.prepend(noMoreTemplate());

                    setTimeout(() => {
                        chatArea.find(".no-more-messages").remove();
                    }, 1500);

                }
            });
        }
    }

    lastScrollTop = st;

});

// here listen for pusher events
setTimeout(() => {
    let current_user_id = $("#current_user").val();
    window.Echo.private(`chat-message.${current_user_id}`)
        .listen('.message.sent', (e) => {
            displayReceiverMessage(e.message);
        });
}, 200);

function openChatBox(user_id, username, callback)
{

    if($("#chat_box_" + user_id).length == 0) {

        let cloned = $("#chat_box").clone(true);

        // change cloned box id
        cloned.attr("id", "chat_box_" + user_id);

        cloned.find(".chat-user").text(username);

        cloned.find(".btn-chat").attr("data-to-user", user_id);

        cloned.find(".to_user_id").val(user_id);

        $("#chat-overlay").append(cloned);
    }

    $("#chat_box_" + user_id).show();

    if(callback) {
        callback();
    }
}

function send(to_user, message, file)
{
    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    let formData = new FormData();
    formData.append("to_user", to_user);
    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("message", message);
    formData.append("image", file);


    $.ajax({
        url: window.base_url + "/send",
        data: formData,
        method: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.append(loaderHtml());
            }
        },
        success: function (response) {
            displaySenderMessage(response.message);
        },
        complete: function () {
            chat_area.find(".loader").remove();
            chat_box.find(".btn-chat").prop("disabled", true);
            chat_box.find(".chat_input").val("");
            //chat_area.animate({scrollTop: chat_area.offset().top + chat_area.outerHeight(true)}, 800, 'swing');
        }
    });
}
 
 /**
  * loaderHtml
  *
  * @returns {string}
  */
 function loaderHtml() {
     return '<i class="glyphicon glyphicon-refresh loader"></i>';
 }
 
 /**
  * getMessageSenderHtml
  *
  * this is the message template for the sender
  *
  * @param message
  * @returns {string}
  */
 function getMessageSenderHtml(message)
 {
     return `
     <img src="` + base_url +  '/images/user-avatar.png' + `" width="50" height="50" class="img-responsive">
        <div class="content">
                    <div class="message">
                    <div class="bubble">
                        <p>${message.content}</p>
                      </div> 
                      <span>${message.fromUserName} • ${message.dateHumanReadable}</span>   
                      </div>
                      </div>     
                `;
 }
 
 /**
  * getMessageReceiverHtml
  *
  * this is the message template for the receiver
  *
  * @param message
  * @returns {string}
  */
 function getMessageReceiverHtml(message)
 {
     return `
     <img src="` + base_url +  '/images/user-avatar.png' + `" width="50" height="50" class="img-xs rounded-circle">
    <div class="content" data-message-id="${message.id}">
     <div class="message">
       <div class="bubble">
       <p>${message.content}</p>
       <span>${message.fromUserName}  • ${message.dateHumanReadable} </span>
       
       </div>
       </div>
       </div>
            
     `;
 }
 
 
 /**
  * cloneChatBox
  *
  * this helper function make a copy of the html chat box depending on receiver user
  * then append it to 'chat-overlay' div
  *
  * @param user_id
  * @param username
  * @param callback
  */
 function cloneChatBox(user_id, username, callback)
 {
     if($("#chat_box_" + user_id).length == 0) {
 
         let cloned = $("#chat_box").clone(true);
 
         // change cloned box id
         cloned.attr("id", "chat_box_" + user_id);
 
         cloned.find(".chat-user").text(username);
 
         cloned.find(".btn-chat").attr("data-to-user", user_id);
 
         cloned.find("#to_user_id").val(user_id);
 
         $("#chat-overlay").append(cloned);
     }
 
     callback();
 }
 
 /**
  * loadLatestMessages
  *
  * this function called on load to fetch the latest messages
  *
  * @param container
  * @param user_id
  */
 function loadLatestMessages(container, user_id)
 {
     let chat_area = container.find(".chat-area");
 
     chat_area.html("");
 
     $.ajax({
         url: base_url + "/load-latest-messages",
         data: {user_id: user_id, _token: $("meta[name='csrf-token']").attr("content")},
         method: "GET",
         dataType: "json",
         beforeSend: function () {
             if(chat_area.find(".loader").length  == 0) {
                 chat_area.html(loaderHtml());
             }
         },
         success: function (response) {
             if(response.state == 1) {
                 response.messages.map(function (val, index) {
                     $(val).appendTo(chat_area);
                 });
             }
         },
         complete: function () {
             chat_area.find(".loader").remove();
         }
     });
 }