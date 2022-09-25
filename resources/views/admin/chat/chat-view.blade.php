        @if($pagination)
         @foreach($messages as $message)
      
                @if($message->from_user==$user->id)

                 <li class="message-item friend">
                  <img src="{{(isset($message->fromUser->profile_photo_path) && !empty($message->fromUser->profile_photo_path))? $message->fromUser->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>{{$message->message}}</p>
                      </div>
                      <span>{{$message->created_at->diffForHumans()}}</span>
                    </div>
                  </div>
                </li>
                @else
                <li class="message-item me">
                  <img src="{{(isset($message->fromUser->profile_photo_path) && !empty($message->fromUser->profile_photo_path))? $message->fromUser->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    
                    <div class="message">
                      <div class="bubble">
                        <p>{{$message->message}}</p>
                      </div>
                      <span>{{$message->created_at->diffForHumans()}}</span>
                    </div>
                  </div>
                </li>
                @endif
                @endforeach
        @else
        <div class="chat-header border-bottom pb-2">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <i data-feather="corner-up-left" id="backToChatList" class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                  <figure class="mb-0 me-2">
                    <img src="{{(isset($user->profile_photo_path) && !empty($user->profile_photo_path))? $user->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-sm rounded-circle" alt="image">
                    <div class="status online"></div>
                    <div class="status online"></div>
                  </figure>
                  <div>
                    <p id= "chat_box_name">{{$user->name}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="chat-body" id="chat_body">

            <div class="load-more-messages" id="load_more_messages_{{$user->id}}" style="display: none;">
              <img src="{{asset('assets/images/loading-gif.gif')}}">
            </div>
              <ul class="messages" id="chat_messages_{{$user->id}}">
                @foreach($messages as $message)
           
                @if($message->from_user==$user->id)
                 <li class="message-item friend">
                  <img src="{{(isset($message->fromUser->profile_photo_path) && !empty($message->fromUser->profile_photo_path))? $message->fromUser->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                      @if($message->is_image == 1)
                      <a href="{{$message->message}}" target="_blank"> <img src="{{$message->message}}" alt="" srcset="" height="100px" width="100px"></a>
                          @elseif($message->is_attachment == 1)
                         <a href="{{$message->message}}" target="_blank">Attachment </a>
                          @else

                          <p>{{$message->message}}</p>
                          @endif
                      </div>
                      <span>{{$message->created_at->diffForHumans()}}</span>
                    </div>
                  </div>
                </li>
                @else
                <li class="message-item me">
                  <img src="{{(isset($message->fromUser->profile_photo_path) && !empty($message->fromUser->profile_photo_path))? $message->fromUser->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    
                    <div class="message">
                      <div class="bubble">
                        @if($message->is_image == 1)
                           <a href="{{$message->message}}" target="_blank"> <img src="{{$message->message}}" alt="" srcset="" height="100px" width="100px"></a>
                          @elseif($message->is_attachment == 1)
                          <a href="{{$message->message}}" target="_blank">Attachment </a>
                          @else

                          <p>{{$message->message}}</p>
                          @endif
                      </div>
                      <span>{{$message->created_at->diffForHumans()}}</span>
                    </div>
                  </div>
                </li>
                @endif
                @endforeach
              </ul>
            </div>
            
            <!-- Submit and file attachment-->
            <div class="chat-footer d-flex">
              <form class="search-form flex-grow-1 me-2" onsubmit="return chatsEvent.sendMessage({{$user->id}})"  method="POST"  enctype="multipart/form-data">
                <div class="input-group">
                   <p id="preview-image" ></p>
                  <div class="position-relative">
                    <input type="file" name="file" id="chat-files" accept="image/*, .txt, .rar, .zip" class="btn border btn-icon rounded-circle me-2 image" data-bs-toggle="tooltip" title="Attatch files" >
                    <label for="chat-files"></label>
                  </div>
                  <input type="text" name="message" class="form-control rounded-pill" autocomplete="off" id="chatForm" placeholder="Type a message">
                 
                  <button type="button" class="btn btn-primary btn-icon rounded-circle ms-2 btn-chat" onclick="chatsEvent.sendMessage({{$user->id}});">
                    <img class="text-muted" src="{{asset('assets/icons/send.svg')}}">
                  </button>
                </div>
              </form>
            </div>
            <script type="text/javascript">
              var chat_body = document.getElementById("chat_body");
              chat_body.scrollTop = chat_body.scrollHeight;


                    $('.chat-body').on('scroll', function() {
                    let div = $(this).get(0);
                    if(div.scrollTop==0)
                    {
                      chatsEvent.loadMoreMesseges({{$user->id}});
                    }
                });
                $('.image').change(function(){
               file=   $('.image')[0].files[0].name;
        
                $('#preview-image').text(file);
          
         
                 });

            </script>
            @endif