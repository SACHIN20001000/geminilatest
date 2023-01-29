@if(count($users)>0)
<p class="text-muted mb-1">Search Results</p>
<ul class="list-unstyled chat-list px-1" id="user_search_results">

@foreach($users as $user)
@if(!$contacts->contains('contact_id',$user->id))

<li class="chat-item pe-1" onclick="chatsEvent.clickChatContact({{$user->id}});">
  <a href="javascript:;" class="d-flex align-items-center chatlistdetails">
    <figure class="mb-0 me-2">
      <img src="{{(isset($user->profile_photo_path) && !empty($user->profile_photo_path))? $user->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
      <div class="status online"></div>
    </figure>
    <div class="d-flex justify-content-between flex-grow-1 border-bottom">
      <div>
        <p class="text-body fw-bolder user_detail" id="{{$user->id}}">{{$user->name}}</p>
        <p class="text-muted tx-13"></p>
      </div>
      <div class="d-flex flex-column align-items-end">
        <p class="text-muted tx-13 mb-1"></p>
        <div class="badge rounded-pill bg-primary ms-auto notification" style="display:none;">0</div>
      </div>
    </div>
  </a>
</li>
@endif

@endforeach

</ul>

@elseif($keyword)

<p class="text-muted mb-1"></p>
@endif
@if(count($contacts) > 0)
<p class="text-muted mb-1">Recent chats</p>
<ul class="list-unstyled chat-list px-1" id="recent_contact">

@foreach($contacts as $contact)

<li class="chat-item pe-1" id="recent_contact_{{$contact->contact_id}}">
  <a href="javascript:;" class="d-flex align-items-center chatlistdetails">
    <figure class="mb-0 me-2">
      <img src="{{(isset($contact->user->profile_photo_path) && !empty($contact->user->profile_photo_path))? $contact->user->profile_photo_path : url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="user">
      <div class="status online"></div>
    </figure>
    <div class="d-flex justify-content-between flex-grow-1 border-bottom" onclick="chatsEvent.clickChatContact({{$contact->contact_id}});">
      <div>
        <p class="text-body fw-bolder user_detail">{{$contact->user->name}}</p>
        @php
        $message = App\Models\Message::getLastMessege(Auth()->User()->id,$contact->contact_id);
        @endphp
      
        @if((isset($message->is_attachment)) && ($message->is_attachment == 1))
        <p class="text-muted tx-13 recent_short_m" id="recent_contact_m_{{$contact->contact_id}}">attachment</p>
        @elseif((isset($message->is_image)) && ($message->is_image == 1))
        <p class="text-muted tx-13 recent_short_m" id="recent_contact_m_{{$contact->contact_id}}">image</p>
        @else
        <p class="text-muted tx-13 recent_short_m" id="recent_contact_m_{{$contact->contact_id}}">{{$message->message ?? null}}</p>
        @endif
      </div>
      <div class="d-flex flex-column align-items-end">
        <p class="text-muted tx-13 mb-1">{{isset($$message) ? $message->created_at->diffForHumans() : null}}</p>
        <div class="badge rounded-pill bg-primary ms-auto notification" style="display:none;">0</div>
      </div>
    </div>
  </a>
</li>

@endforeach

</ul>

@endif

