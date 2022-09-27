<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\ChatContact;
use App\Lib\PusherFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user1 = Auth()->User();

        $users = Message::where("from_user", "=", $user1->id)->pluck("user_id");

        $username = User::whereIn("id", $users)->get();

        return view("admin.chat.chat", compact("username"));
    }

    /**
     * For sending messages
     * @param to_user required
     * @param message required
     * @return Json data 
     */

    public function postSendMessage(Request $request)
    {

        if (!$request->to_user && (!$request->message || !$request->file)) {
            return;
        }

        $extension = ['jpg', 'png', 'jpeg'];

        if ($request->hasFile('file')) {
            $file = $request->file->extension();
            $path =  Storage::disk('do_spaces')->putFile('uploads', request()->file, 'public');
            $imageName = Storage::disk('do_spaces')->url($path);

            $message = new Message();
            $message->from_user = Auth::user()->id;
            $message->user_id = $request->to_user;
            $message->message = $imageName;
            if (in_array($file, $extension)) {
                $message->is_image = 1;
            } else {

                $message->is_attachment = 1;
            }
            $message->save();
            if (in_array($file, $extension)) {

                $message->image = $imageName;
                $message->atttype = 'image';
            } else {
                $message->atttype = 'attachment';
                $message->image = $imageName;
            }
        }
        if ($request->message) {
            $message = new Message();
            $message->from_user = Auth::user()->id;
            $message->user_id = $request->to_user;
            $message->message = $request->message;
            $message->save();
        }

        $contactUser = ChatContact::firstOrNew([
            "user_id" => Auth::user()->id,
            "contact_id" => $request->to_user,
        ]);
        $contactUser->updated_at = now();
        $contactUser->save();

        $currentUser = ChatContact::updateOrCreate([
            "contact_id" => Auth::user()->id,
            "user_id" => $request->to_user,
        ]);
        $contactUser->updated_at = now();
        $currentUser->save();

        // prepare some data to send with the response
        $message->dateTimeStr = date(
            "Y-m-dTH:i",
            strtotime($message->created_at->toDateTimeString())
        );
        $message->dateHumanReadable = $message->created_at->diffForHumans();
        $message->fromUserName = $message->fromUser->name;
        $message->from_user_id = Auth::user()->id;
        $message->toUserName = $message->toUser->name;
        $message->to_user_id = $request->to_user;
        $message->is_image = $message->is_image;
        $message->is_attachment = $message->is_attachment;

        $message->to_user_id = $request->to_user;

        // PusherFactory::make()->trigger(
        //     "chat_room_" . $request->to_user,
        //     "send",
        //     ["data" => $message]
        // );
        return response()->json(["state" => 1, "data" => $message]);
    }


    /**
     * For search users
     * @param keyword required
     * @return Html view using ajax 
     */
    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input("search");
        $user_id = Auth::user()->id;

        $keyword = $request->keyword ?? "";
        $users = [];
        if ($keyword) {
            $users = User::with("roles")
                ->where("name", "like", "%" . $keyword . "%")
                ->where("id", "!=", $user_id)
                ->get();
        }

        $contacts = User::with("contacts", "roles")
            ->whereHas("contacts", function ($query) use ($user_id) {
                $query->where("user_id", $user_id);
            })
            ->where("name", "like", "%" . $keyword . "%")
            ->where("id", "!=", $user_id)
            ->get()
            ->sortBy("contacts.updated_at");

        $contacts = ChatContact::with("user", "user.roles")
            ->whereHas("user", function ($query) use ($keyword, $user_id) {
                $query->where("name", "like", "%" . $keyword . "%");
                $query->where("id", "!=", $user_id);
            })
            ->where("user_id", $user_id)
            ->orderBy("updated_at", "DESC")
            ->get();


        return view(
            "admin.chat.chatcontacts",
            compact("users", "contacts", "keyword")
        );
    }

    /**
     * For Chat view
     * @param contact_id required
     * @return Html chat view using ajax 
     */
    public function chatView(Request $request)
    {
        $user = User::where("id", $request->contact_id)
            ->with("messages")
            ->first();
        Message::with('toUser','fromUser')->where("user_id", $request->contact_id)->get();

        $pagination = false;
        if ($request->page && $request->page > 1) {
            $pagination = true;
        }
        $contact_id = $request->contact_id;
        $user_id = Auth()->User()->id;
        $data = Message::with('toUser','fromUser')->where(function ($query) use ($contact_id) {
            $query
                ->where("from_user", "=", $contact_id)
                ->orWhere("user_id", "=", $contact_id);
        })->where(function ($query) use ($user_id) {
            $query
                ->where("user_id", "=", $user_id)
                ->orWhere("from_user", "=", $user_id);
        });

        $messages = $data->orderBy("created_at", "DESC")->paginate(15);
        $messages = $messages->sortBy("id");
        return view(
            "admin.chat.chat-view",
            compact("user", "messages", "pagination")
        );
    }
    public function lastMessage(){
        $message = Message::with('fromUser')->where('user_id', auth()->user()->id)->latest()->take(3)->get()->unique('from_user');;
     
        return $message;
    }
}
