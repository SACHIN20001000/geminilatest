$(function() {
	'use strict';
  
  $(".chat_input").on("change keyup", function (e) {
	if($(this).val() != "") {
		$(".btn-chat").prop("disabled", false);
	} else {
		$(".btn-chat").prop("disabled", true);
	}
  });
	$(".btn-chat").on("click", function (e) {
	  send(1,$('#btn-chat').val());
	  $('#btn-chat').val();
  
  });
  function send(to_user, message)
  {
	  let formData = new FormData();
	  formData.append("to_user", to_user);
	  formData.append("message", message);
  
	  $.ajax({
		  url: 'whatsapp-send',
		  data: formData,
		  method: "POST",
		  dataType: "json",
		  processData: false,
		  contentType: false,
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		  beforeSend: function () {
			  
			 
		  },
		  success: function (response) {
			  
		  },
		  complete: function () {
			 
			  
		  }
	  });
  }
  });