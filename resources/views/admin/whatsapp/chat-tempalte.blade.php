@extends('admin.layouts.app')

@section('content')
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
                      <img src="{{ url('https://via.placeholder.com/43x43') }}" class="img-sm rounded-circle" alt="profile">
                      <div class="status online"></div>
                    </figure>
                    <div>
                      <h6>Amiah Burton</h6>
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
                <form class="search-form">
                  <div class="input-group">
                    <div class="input-group-text">
                      <i data-feather="search" class="icon-md cursor-pointer"></i>
                    </div>
                    <input type="text" class="form-control" id="searchForm" placeholder="Search here...">
                  </div>
                </form>
              </div>
              <div class="aside-body">

                <div class="tab-content mt-3">
                  <div class="tab-pane fade show active" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                    <div>
                      <p class="text-muted mb-1">Recent chats</p>
                      <ul class="list-unstyled chat-list px-1">
                        <li class="chat-item pe-1">
                          <a href="javascript:;" class="d-flex align-items-center">
                            <figure class="mb-0 me-2">
                              <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
                              <div class="status online"></div>
                            </figure>
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body fw-bolder">John Doe</p>
                                <p class="text-muted tx-13">Hi, How are you?</p>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">4:32 PM</p>
                                <div class="badge rounded-pill bg-primary ms-auto">5</div>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body fw-bolder">Carl Henson</p>
                                <div class="d-flex align-items-center">
                                  <i data-feather="image" class="text-muted icon-md mb-2px"></i>
                                  <p class="text-muted ms-1">Photo</p>
                                </div>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">05:24 PM</p>
                                <div class="badge rounded-pill bg-danger ms-auto">3</div>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body">John Doe</p>
                                <p class="text-muted tx-13">Hi, How are you?</p>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">Yesterday</p>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body">Jensen Combs</p>
                                <div class="d-flex align-items-center">
                                  <i data-feather="video" class="text-muted icon-md mb-2px"></i>
                                  <p class="text-muted ms-1">Video</p>
                                </div>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">2 days ago</p>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body">Yaretzi Mayo</p>
                                <p class="text-muted tx-13">Hi, How are you?</p>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">4 week ago</p>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body fw-bolder">John Doe</p>
                                <p class="text-muted tx-13">Hi, How are you?</p>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">4:32 PM</p>
                                <div class="badge rounded-pill bg-primary ms-auto">5</div>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body fw-bolder">Leonardo Payne</p>
                                <div class="d-flex align-items-center">
                                  <i data-feather="image" class="text-muted icon-md mb-2px"></i>
                                  <p class="text-muted ms-1">Photo</p>
                                </div>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">6:11 PM</p>
                                <div class="badge rounded-pill bg-danger ms-auto">3</div>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body">John Doe</p>
                                <p class="text-muted tx-13">Hi, How are you?</p>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">Yesterday</p>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body">Leonardo Payne</p>
                                <div class="d-flex align-items-center">
                                  <i data-feather="video" class="text-muted icon-md mb-2px"></i>
                                  <p class="text-muted ms-1">Video</p>
                                </div>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">2 days ago</p>
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
                            <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                              <div>
                                <p class="text-body">John Doe</p>
                                <p class="text-muted tx-13">Hi, How are you?</p>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">4 week ago</p>
                              </div>
                            </div>
                          </a>
                        </li>
                      </ul>
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
                  <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
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
          <div class="col-lg-8 chat-content">
            <div class="chat-header border-bottom pb-2">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <i data-feather="corner-up-left" id="backToChatList" class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                  <figure class="mb-0 me-2">
                    <img src="{{ url('https://via.placeholder.com/43x43') }}" class="img-sm rounded-circle" alt="image">
                    <div class="status online"></div>
                    <div class="status online"></div>
                  </figure>
                  <div>
                    <p>Mariana Zenha</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="chat-body">
              <ul class="messages">
                <li class="message-item friend">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                      </div>
                      <span>8:12 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item me">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                      </div>
                    </div>
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum.</p>
                      </div>
                      <span>8:13 PM</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- Submit and file attachment-->
            <div class="chat-footer d-flex">
              <form class="search-form flex-grow-1 me-2" id="message-form" method="POST" action="" enctype="multipart/form-data">
                <div class="input-group">
                  <button type="file" name="file" accept="image/*, .txt, .rar, .zip" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Attatch files">
                    <i data-feather="paperclip" class="text-muted"></i>
                  </button>
                  <input type="text" name="message" class="form-control rounded-pill" id="chatForm" placeholder="Type a message">
                  <button type="button" class="btn btn-primary btn-icon rounded-circle ms-2">
                    <i data-feather="send"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('custom-scripts')
<script src="{{ asset('assets/js/chat.js') }}"></script>
<script type="text/javascript">
  $(function() {
    let pusher = new Pusher($("#pusher_app_key").val(), {
      cluster: $("#pusher_cluster").val(),
      encrypted: true
    });

    let channel = pusher.subscribe('chat');


    // on click on any chat btn render the chat box


    // on close chat close the chat box but don't remove it from the dom
    $(".close-chat").on("click", function(e) {

      $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
    });
  });
  $(".btn-chat").on("click", function(e) {
    send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val(), null);

  });
  $(".chat_input").on("change keyup", function(e) {
    if ($(this).val() != "") {
      $(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
    } else {
      $(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
    }
  });

  $(".chat-area").on("scroll", function(e) {
    if (noMoreMessages) {
      return;
    }
    let st = $(this).scrollTop();

    if (st < lastScrollTop) {
      scrollEvery += 1;

      if (scrollEvery % 10 == 0) {
        fetchOldMessages($(this).parents(".chat-opened").find(".to_user_id").val(), $(this).find(".msg_container:first-child").attr("data-message-id"), (response) => {
          noMoreMessages = response.no_more_messages;

          if (noMoreMessages) {
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

  function openChatBox(user_id, username, callback) {

    if ($("#chat_box_" + user_id).length == 0) {

      let cloned = $("#chat_box").clone(true);

      // change cloned box id
      cloned.attr("id", "chat_box_" + user_id);

      cloned.find(".chat-user").text(username);

      cloned.find(".btn-chat").attr("data-to-user", user_id);

      cloned.find(".to_user_id").val(user_id);

      $("#chat-overlay").append(cloned);
    }

    $("#chat_box_" + user_id).show();

    if (callback) {
      callback();
    }
  }

  function send(to_user, message, file) {
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
      beforeSend: function() {
        if (chat_area.find(".loader").length == 0) {
          chat_area.append(loaderHtml());
        }
      },
      success: function(response) {
        displaySenderMessage(response.message);
      },
      complete: function() {
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
  function getMessageSenderHtml(message) {
    return `
     <img src="` + base_url + '/images/user-avatar.png' + `" width="50" height="50" class="img-responsive">
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
  function getMessageReceiverHtml(message) {
    return `
     <img src="` + base_url + '/images/user-avatar.png' + `" width="50" height="50" class="img-xs rounded-circle">
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
  function cloneChatBox(user_id, username, callback) {
    if ($("#chat_box_" + user_id).length == 0) {

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
  function loadLatestMessages(container, user_id) {
    let chat_area = container.find(".chat-area");

    chat_area.html("");

    $.ajax({
      url: base_url + "/load-latest-messages",
      data: {
        user_id: user_id,
        _token: $("meta[name='csrf-token']").attr("content")
      },
      method: "GET",
      dataType: "json",
      beforeSend: function() {
        if (chat_area.find(".loader").length == 0) {
          chat_area.html(loaderHtml());
        }
      },
      success: function(response) {
        if (response.state == 1) {
          response.messages.map(function(val, index) {
            $(val).appendTo(chat_area);
          });
        }
      },
      complete: function() {
        chat_area.find(".loader").remove();
      }
    });
  }
</script>
@endpush