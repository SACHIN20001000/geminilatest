@extends('admin.layouts.app')

@section('content')
<style>
  .chat-wrapper .chat-content .chat-body {
    overflow: auto;
    min-height: calc(87vh - 120px);
  }

  .load-more-messeges {
    background: #4660d9;
    top: 0;
    border: 1px solid #1e3bbf;
    color: #fff;
    font-weight: 4;
    padding: 4px 20px;
    border-radius: 50px;
    left: 15px;
    box-shadow: 1px 2px 3px rgba(0, 0, 0, .3);
    margin: 0px 0 20px 0;
  }

  .login,
  .image {
    min-height: auto !important;
  }

  .load-more-messages img {
    max-width: 29px;
    display: block;
    margin: 0 auto;
  }

  .active_chat {
    background: #f2f2f2;
  }

  ul#recent_contact>li {
    padding: 0 15px !important;
  }

  .unread {
    font-weight: bold;
    color: #000 !important;
  }

  #recent_contact .recent_short_m {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .cross-icon-delete {
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0.469rem 0.563rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #000;
    text-align: center;
    white-space: nowrap;
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 0.25rem;
    cursor: pointer;
  }

  #preview-image {
    position: absolute;
    bottom: 40px;
    color: #5271ff;
  }

  input#chat-files+label {
    position: absolute;
    top: 0;
    content: "";
    background: #fff url(/assets/icons/paperclip.svg) no-repeat;
    background-position: center;
    background-size: 50% 50%;
    width: 38px;
    height: 38px;
    left: 0px;
    z-index: 99;
    border-radius: 50%;
    border: 1px solid #e9ecef;
  }

  .chat-wrapper {
    height: calc(100vh - 60px - 102px);
  }

  @media (max-width: 991px) {
    .chat-wrapper {
      min-height: 100%;
    }
  }

  @media (max-width: 991px) {
    .chat-wrapper {
      height: 100%;
    }
  }

  @media (min-width: 992px) {
    .chat-wrapper .chat-aside {
      padding-right: 23px;
    }
  }

  .chat-wrapper .chat-aside .aside-body .tab-content .tab-pane {
    position: relative;
    max-height: calc(100vh - 60px);
  }

  .chat-wrapper .chat-aside .aside-body .tab-content .tab-pane .chat-list .chat-item a>div {
    padding-top: 11px;
    padding-bottom: 11px;
  }

  @media (max-width: 991px) {
    .chat-wrapper .chat-content {
      position: absolute;
      background: #fff;
      left: 0;
      bottom: -1px;
      top: 0;
      right: 0;
      display: none;
    }

    .chat-wrapper .chat-content.show {
      display: block;
    }
  }

  .chat-wrapper .chat-content .chat-header {
    padding: 0 10px;
  }

  .chat-wrapper .chat-content .chat-body {
    position: relative;
    max-height: calc(19vh - 60px);
    margin-top: 0px;
    margin-bottom: 58px;
  }

  @media (max-width: 767px) {
    .chat-wrapper .chat-content .chat-body {
      max-height: calc(100vh - 315px);
    }
  }

  @media (max-width: 991px) {
    .chat-wrapper .chat-content .chat-body {
      max-height: calc(100vh - 342px);
    }
  }

  .chat-wrapper .chat-content .chat-body .messages {
    padding: 0 10px;
    list-style-type: none;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    max-width: 80%;
    margin-bottom: 20px;
  }

  @media (max-width: 767px) {
    .chat-wrapper .chat-content .chat-body .messages .message-item {
      max-width: 95%;
    }
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item .content .bubble {
    position: relative;
    padding: 7px 15px;
    margin-bottom: 4px;
    width: -webkit-fit-content;
    width: -moz-fit-content;
    width: fit-content;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item .content span {
    font-size: 12px;
    color: #7987a1;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.friend img {
    -webkit-box-ordinal-group: 2;
    -ms-flex-order: 1;
    order: 1;
    margin-right: 15px;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.friend .content {
    -webkit-box-ordinal-group: 3;
    -ms-flex-order: 2;
    order: 2;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.friend .content .bubble {
    background: rgba(82, 113, 255, 0.1);
    border-radius: 0 5px 5px;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.friend .content .bubble::before {
    content: "";
    width: 0;
    height: 0;
    position: absolute;
    left: -10px;
    top: 0;
    border-top: 5px solid rgba(82, 113, 255, 0.1);
    border-bottom: 5px solid transparent;
    border-left: 5px solid transparent;
    border-right: 5px solid rgba(82, 113, 255, 0.1);
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.me {
    margin-left: auto;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.me img {
    -webkit-box-ordinal-group: 3;
    -ms-flex-order: 2;
    order: 2;
    margin-left: 15px;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.me .content {
    -webkit-box-ordinal-group: 2;
    -ms-flex-order: 1;
    order: 1;
    margin-left: auto;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.me .content .bubble {
    background: rgba(102, 209, 209, 0.1);
    border-radius: 5px 0 5px 5px;
    margin-left: auto;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.me .content .bubble::before {
    content: "";
    width: 0;
    height: 0;
    position: absolute;
    right: -10px;
    top: 0;
    border-top: 5px solid rgba(102, 209, 209, 0.1);
    border-bottom: 5px solid transparent;
    border-left: 5px solid rgba(102, 209, 209, 0.1);
    border-right: 5px solid transparent;
  }

  .chat-wrapper .chat-content .chat-body .messages .message-item.me .content span {
    text-align: right;
    display: block;
  }

  .chat-wrapper figure {
    position: relative;
  }

  .chat-wrapper figure .status {
    width: 11px;
    height: 11px;
    background: #7987a1;
    position: absolute;
    bottom: 0px;
    right: -2px;
    border-radius: 50%;
    border: 2px solid #fff;
  }

  .chat-wrapper figure .status.online {
    background: #05a34a;
  }

  .chat-wrapper figure .status.offline {
    background: #7987a1;
  }



  /* deppak css  */
  ul#user_search_results {
    height: 300px;
    overflow: scroll;
  }

  input#chat-files {
    opacity: 0;
  }

  .btn-chat {
    background: #ccc;
    padding: 0 !important;
  }

  .btn-chat:hover {
    background: #ccc;
  }

  input#chatForm {
    box-shadow: 0 0 10px rgb(0 0 0 / 25%);
    background: #fff !important;
  }

  .btn-chat img.text-muted {
    opacity: .5;
    padding-right: 3px;
  }

  div#chat_view {
    position: relative;
  }

  .chat-footer {
    position: absolute;
    width: 100%;
    bottom: 30px;
  }
</style>
<div class="row chat-wrapper">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row position-relative">
          <div class="col-lg-4 chat-aside border-end-lg">
            <div class="aside-content">
              <div class="aside-header">
                <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                  <div class="d-flex align-items-center">
                    <figure class="me-2 mb-0">
                      <img src="{{(isset(Auth()->user()->profile_photo_path) && !empty(Auth()->user()->profile_photo_path))? Auth()->user()->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-sm rounded-circle" alt="profile">
                      <div class="status online"></div>
                    </figure>
                    <div>
                      <h6>{{Auth()->user()->name}}</h6>
                    </div>
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="settings" data-bs-toggle="tooltip" title="Settings"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View Profile</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit Profile</span></a>
                    </div>
                  </div>
                </div>
                <div class="input-group">
                  <div class="input-group-text">
                    <i data-feather="search" class="icon-md cursor-pointer"></i>
                  </div>
                  <input type="text" name="search" class="form-control" id="searchForm" onkeyup="chatsEvent.getChatContact(this.value);" placeholder="Search here..." autocomplete="off">
                  <div class="cross-icon-delete" style="display: none;" onclick="chatsEvent.clearSearchBar();" id="cross_icon_delete">
                    <img class="text-muted" src="{{asset('assets/icons/cross.svg')}}">

                  </div>
                </div>
              </div>
              <div class="aside-body">

                <div class="tab-content mt-3" style="height:100%">
                  <div class="tab-pane fade show active" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                    <div id="contacts">

                    </div>
                  </div>
                  <div class="tab-pane fade" id="calls" role="tabpanel" aria-labelledby="calls-tab">
                    <p class="text-muted mb-1">Recent calls</p>
                    <ul class="list-unstyled chat-list px-1">
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status online"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">Jensen Combs</p>
                              <div class="d-flex align-items-center">
                                <i data-feather="arrow-up-right" class="icon-sm text-success me-1"></i>
                                <p class="text-muted tx-13">Today, 03:11 AM</p>
                              </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                              <i data-feather="phone-call" class="text-primary icon-md"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status offline"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">Leonardo Payne</p>
                              <div class="d-flex align-items-center">
                                <i data-feather="arrow-down-left" class="icon-sm text-success me-1"></i>
                                <p class="text-muted tx-13">Today, 11:41 AM</p>
                              </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                              <i data-feather="video" class="text-primary icon-md"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status offline"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">Carl Henson</p>
                              <div class="d-flex align-items-center">
                                <i data-feather="arrow-down-left" class="icon-sm text-danger me-1"></i>
                                <p class="text-muted tx-13">Today, 04:24 PM</p>
                              </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                              <i data-feather="phone-call" class="text-primary icon-md"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status online"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">Jensen Combs</p>
                              <div class="d-flex align-items-center">
                                <i data-feather="arrow-down-left" class="icon-sm text-danger me-1"></i>
                                <p class="text-muted tx-13">Today, 12:53 AM</p>
                              </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                              <i data-feather="video" class="text-primary icon-md"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status online"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">John Doe</p>
                              <div class="d-flex align-items-center">
                                <i data-feather="arrow-down-left" class="icon-sm text-success me-1"></i>
                                <p class="text-muted tx-13">Today, 01:42 AM</p>
                              </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                              <i data-feather="video" class="text-primary icon-md"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status offline"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">John Doe</p>
                              <div class="d-flex align-items-center">
                                <i data-feather="arrow-up-right" class="icon-sm text-success me-1"></i>
                                <p class="text-muted tx-13">Today, 12:01 AM</p>
                              </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                              <i data-feather="phone-call" class="text-primary icon-md"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="tab-pane fade" role="tabpanel" aria-labelledby="contacts-tab">
                    <p class="text-muted mb-1">Contacts</p>
                    <ul class="list-unstyled chat-list px-1">
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status offline"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">Amiah Burton</p>
                              <div class="d-flex align-items-center">
                                <p class="text-muted tx-13">Front-end Developer</p>
                              </div>
                            </div>
                            <div class="d-flex align-items-end text-body">
                              <i data-feather="message-square" class="icon-md text-primary me-2"></i>
                              <i data-feather="phone-call" class="icon-md text-primary me-2"></i>
                              <i data-feather="video" class="icon-md text-primary"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status online"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">John Doe</p>
                              <div class="d-flex align-items-center">
                                <p class="text-muted tx-13">Back-end Developer</p>
                              </div>
                            </div>
                            <div class="d-flex align-items-end text-body">
                              <i data-feather="message-square" class="icon-md text-primary me-2"></i>
                              <i data-feather="phone-call" class="icon-md text-primary me-2"></i>
                              <i data-feather="video" class="icon-md text-primary"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status offline"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">Yaretzi Mayo</p>
                              <div class="d-flex align-items-center">
                                <p class="text-muted tx-13">Fullstack Developer</p>
                              </div>
                            </div>
                            <div class="d-flex align-items-end text-body">
                              <i data-feather="message-square" class="icon-md text-primary me-2"></i>
                              <i data-feather="phone-call" class="icon-md text-primary me-2"></i>
                              <i data-feather="video" class="icon-md text-primary"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="chat-item pe-1">
                        <a href="javascript:;" class="d-flex align-items-center">
                          <figure class="mb-0 me-2">
                            <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                            <div class="status offline"></div>
                          </figure>
                          <div class="d-flex align-items-center justify-content-between flex-grow-1 border-bottom">
                            <div>
                              <p class="text-body">John Doe</p>
                              <div class="d-flex align-items-center">
                                <p class="text-muted tx-13">Front-end Developer</p>
                              </div>
                            </div>
                            <div class="d-flex align-items-end text-body">
                              <i data-feather="message-square" class="icon-md text-primary me-2"></i>
                              <i data-feather="phone-call" class="icon-md text-primary me-2"></i>
                              <i data-feather="video" class="icon-md text-primary"></i>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 chat-content" id="chat_view" style="background: azure;">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('custom-scripts')
<script src="{{ URL::asset('assets/js/whatsapp.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  /**
   * For Chat js functions
   * @param pusher id
   * @return functions
   */
  var chatsEvent;
  // var pusher = new Pusher('f761c654d192e599e6f0', {
  //             encrypted: true
  //           });
  var currentUserId = '{{Auth()->id()}}';
  var urlUser = "{{$_GET['user'] ?? ''}}";


  (function() {
    var currentPage = 1;
    var loding = false;
    var fechedAllrecords = false;
    chatsEvent = {
      initialize: function() {
        chatsEvent.getChatContact();
        chatsEvent.getLastMessage();

        chatsEvent.handlePusherEvent()
        if (urlUser.length > 0) {
          chatsEvent.clickChatContact(urlUser)

        }
      },
      handlePusherEvent() {
        // var channel = pusher.subscribe('chat_room_'+currentUserId);
        // Bind a function to a Event (the full Laravel class)
        // channel.bind('send', function(data) {
        // chatsEvent.displayPusherMessage(data); 


        // let message = data.data.message.substring(0, 30)+'...';

        // if(data.data.atttype  && data.data.atttype !='undefined'){
        //   message= 'file';
        // }
        // let count_message= $('.count_element').length;
        // let profile=data.data.from_user.profile_photo_path ?? 'https://via.placeholder.com/37x37';
        // if(count_message < 3){
        //   $(".prev_user_"+data.data.from_user.id).empty();

        //   $(".chat-append").prepend('<div class="prev_user_'+data.data.from_user.id+'"><div class="count_element"><a href="/apps/chat?user='+data.data.from_user.id+'" class="dropdown-item d-flex align-items-center px-1 py-2"><img src="'+profile+'" height="40px" width="40px" class="rounded-circle me-2"/><i class="icon-sm text-white" data-feather="gift"></i><div><p class="chat-notification fw-bold">'+data.data.from_user.name+'</p><span>'+message+' </span></div></div></a></div></div>');
        //   $( "div" ).removeClass( "indicators" ).addClass( "indicator" );
        // }
        // $('.view-chat').html('<a href="{{url("apps/chat")}}">View all</a>');

        // });



      },
      getChatContact(keyword = '') {
        if (keyword.length > 0) {
          $("#cross_icon_delete").show();
        } else {
          $("#cross_icon_delete").hide();

        }
        $.ajax({
          url: 'whatsapp-search?keyword=' + keyword,
          method: "POST",
          processData: false,
          contentType: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            $("#contacts").html(response);


          },

        });
      },
      clickChatContact(contact_id) {
        currentPage = 1;
        fechedAllrecords = false;
        loding = false;
        $(".chat-item").removeClass('active_chat');
        $("#recent_contact_" + contact_id).addClass('active_chat');
        $("#recent_contact_" + contact_id).removeClass('unread');
        $.ajax({
          url: 'whatsapp-chat-view?contact_id=' + contact_id,
          method: "POST",
          processData: false,
          contentType: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {


            $("#chat_view").html(response);

          },

        });
      },
      getLastMessage() {
        $.ajax({
          url: '{{route("lastMessagewhatsapp")}}',
          method: "GET",
          processData: false,
          contentType: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {

            $.each(response, function(index, value) {
              let profile = value.from_user.profile_photo_path ?? 'https://via.placeholder.com/37x37';
              let message = value.message.substring(0, 30) + '...';

              $(".chat-append").prepend('<div class="prev_user_' + value.from_user.id + '"><div class="count_element"><a href="/apps/chat?user=' + value.from_user.id + '" class="dropdown-item d-flex align-items-center px-1 py-2"><img src="' + profile + '" height="40px" width="40px" class="rounded-circle me-2"/><i class="icon-sm text-white" data-feather="gift"></i><div><p class="chat-notification fw-bold">' + value.from_user.name + '</p><span>' + message + ' </span></div></div></a></div></div>');
              $("div").removeClass("indicators").addClass("indicator");
              $('.view-chat').html('<a href="{{url("apps/chat")}}">View all</a>');
            });
            //  $("#chat_view").html(response);

          },

        });
      },
      loadMoreMesseges(contact_id) {
        if (loding == false && fechedAllrecords == false) {
          $("#load_more_messages_" + contact_id).show();
          loding = true;
          currentPage = currentPage + 1;
          $.ajax({
            url: 'whatsapp-chat-view?contact_id=' + contact_id + '&page=' + currentPage,
            method: "POST",
            processData: false,
            contentType: false,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

              if (!response) {

                $("#load_more_messages_" + contact_id).remove();
                fechedAllrecords = true;
              }
              loding = false;
              $("#chat_messages_" + contact_id).prepend(response);
              $("#load_more_messages_" + contact_id).hide();
              chatsEvent.scrollToBottom($(".chat-body").height());
            },

          });
        }

      },
      sendMessage(contact_id) {
        let message = $("#chatForm").val();
        let file = $('#chat-files')[0].files;

        if ((message) || (file)) {

          var chat_message = message.length > 0 ? message : '';
          let formData = new FormData();

          formData.append("to_user", contact_id);
          formData.append("message", message);
          formData.append("file", file[0]);

          console.log(formData);
          $("#chatForm").val('')
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
            success: function(response) {

              let name = response.data.toUserName ?? '';
              let message = response.data.message ?? '';
              let date = response.data.dateHumanReadable ?? '';
              let atttype = response.data.atttype ?? 'text';
              let recentMessage = response.data.message ?? '';
              let path = response.data.image ?? '';

              if (atttype != 'text') {
                recentMessage = atttype;
              }

              let profile = response.data.from_user.profile_photo_path ?? 'https://via.placeholder.com/37x37';
              let to_profile = response.data.to_user.profile_photo_path ?? 'https://via.placeholder.com/37x37';

              chatsEvent.appendRecent(name, contact_id, recentMessage, date, '', to_profile);
              chatsEvent.appendChat(type = 'me', chat_message, 'chat_messages_' + contact_id, 'Just now', '', path, atttype, profile);
              chatsEvent.scrollToBottom();

              $("#preview-image").css("display", "none");
            }

          });
        }
        return false;
      },
      appendChat(type = 'me', message = '', append_id, date = '', extra_class = '', path = '', atttype = '', profile = '') {

        if (atttype == 'text') {
          $("#" + append_id).append('<li class="message-item ' + type + ' ' + extra_class + '"><img src="' + profile + '" class="img-xs rounded-circle" alt="avatar"><div class="content"><div class="message"><div class="bubble"><p>' + message + '</p></div><span>' + date + '</span></div></div></li>');
        }
        if (atttype == 'image') {
          $("#" + append_id).append('<li class="message-item ' + type + ' ' + extra_class + '"><img src="' + profile + '" class="img-xs rounded-circle" alt="avatar"><div class="content"><div class="message"><div class="bubble"><a href="' + path + '" target="_blank"><img src="' + path + '" height="100px" width="100px"/></a></div><span>' + date + '</span></div></div></li>');
        }
        if (atttype == 'attachment') {
          $("#" + append_id).append('<li class="message-item ' + type + ' ' + extra_class + '"><img src="' + profile + '" class="img-xs rounded-circle" alt="avatar"><div class="content"><div class="message"><div class="bubble"><a href="' + path + '" target="_blank"">Attachment</a></div><span>' + date + '</span></div></div></li>');
        }

      },
      appendRecent(name = '', contact_id = '', message = '', date = '', extra_class = '', profile = '') {
        $("#recent_contact_" + contact_id).remove();
        $("#recent_contact").prepend('<li class="chat-item pe-1 ' + extra_class + '" id="recent_contact_' + contact_id + '"> <a href="javascript:;" class="d-flex align-items-center chatlistdetails"> <figure class="mb-0 me-2"> <img src="' + profile + '" class="img-xs rounded-circle" alt="user"> <div class="status online"></div> </figure> <div class="d-flex justify-content-between flex-grow-1 border-bottom" onclick="chatsEvent.clickChatContact(' + contact_id + ');"> <div> <p class="text-body fw-bolder user_detail">' + name + '</p> <p class="text-muted tx-13" id="recent_contact_m_' + contact_id + '">' + message + '</p>  </div> <div class="d-flex flex-column align-items-end"> <p class="text-muted tx-13 mb-1">' + date + '</p> </div> </div> </a> </li>');
      },
      displayPusherMessage(messageData) {

        let senderId = messageData.data.from_user_id;
        let senderName = messageData.data.from_user.name;

        let message = messageData.data.message;
        let time = messageData.data.dateHumanReadable;
        let atttype = messageData.data.atttype ?? 'text';
        let path = '';
        if ((messageData.data.atttype) && (messageData.data.atttype == 'image')) {
          path = message;
        }
        if ((messageData.data.atttype) && (messageData.data.atttype == 'attachment')) {
          path = message;
        }

        let profile = messageData.data.from_user.profile_photo_path ?? 'https://via.placeholder.com/37x37';
        let to_profile = messageData.data.from_user.profile_photo_path ?? 'https://via.placeholder.com/37x37';
        if ($("#chat_messages_" + senderId).length > 0) {

          chatsEvent.appendChat('friend', message, 'chat_messages_' + senderId, time, '', path, atttype, profile);
          chatsEvent.scrollToBottom();

        }
        let recentMessage = messageData.data.message ?? '';
        if (atttype != 'text') {
          recentMessage = atttype;
        }

        chatsEvent.appendRecent(senderName, senderId, recentMessage, time, 'unread', to_profile);

      },
      scrollToBottom(height = '') {
        var chat_body = document.getElementById("chat_body");
        if (height) {
          chat_body.scrollTop = height;
        } else {
          chat_body.scrollTop = chat_body.scrollHeight;
        }

      },
      clearSearchBar() {
        $("#searchForm").val('');
        $("#cross_icon_delete").hide();
        chatsEvent.getChatContact();

      }

    };
    chatsEvent.initialize();
  })();
  $(document).on("click", ".deleteRecord", function() {

    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    var message = $(this).data('confirm');
    swal({
        title: "Are you sure ??",
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

          $.ajax({
            url: id,
            type: 'DELETE',
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
              'X-CSRF-TOKEN': token
            },
            error: function(xhr) {
              swal("Oops! .. You Cannot delete this records!", {
                icon: "warning",
              });
            },
            success: function(response) {
              swal("Poof! Your Records has been deleted!", {
                icon: "success",
              });
              $('#datatable').DataTable().ajax.reload();
            }
          });
        }
      });

  });
</script>



@endpush