<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatsappMessage;
use App\Models\User;
use App\Models\WhatsappChatContact;
use App\Lib\PusherFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Traits\WhatsappApi;

class WhatsappChatsController extends Controller
{
    use WhatsappApi;
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user1 = Auth()->User();

        $users = WhatsappMessage::where("from_user", "=", $user1->id)->pluck("user_id");

        $username = User::whereIn("id", $users)->get();

        return view("admin.whatsapp.chat", compact("username"));
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
        $user = User::find($request->to_user);
        if (!empty($user->phone)) {
            $data = rawurlencode(strip_tags($request->message));
            $texturl = env("WHATSAPP_URL", "https://bulkchatbot.co.in/api/send.php").'?number=' . $user->phone . '&type=text&message=' . $data . '&instance_id='.env("WHATSAPP_INSTANCE", "63B293D6D4019").'&access_token='.env("WHATSAPP_TOKEN", "d947472c111c73ec8b4187b3dad025a2");
            $this->sendMessage($texturl);
        }

        $extension = ['jpg', 'png', 'jpeg'];

        if ($request->hasFile('file')) {
            $file = $request->file->extension();
            $imageName = $request->file('file')->getClientOriginalName();
            $request->file->move(public_path('/file'), $imageName);
            if (!empty($user->phone)) {
                $fileurls = url('file',  $imageName);

                $media = '&media_url=' . $fileurls . '&filename=' . $fileurls;
                $type = '&type=media';
                $messagefile = rawurlencode(strip_tags($imageName));
                $url = env("WHATSAPP_URL", "https://bulkchatbot.co.in/api/send.php").'?number=' . $user->phone . $type . $media . '&message=' . $messagefile . '&instance_id='.env("WHATSAPP_INSTANCE", "63B293D6D4019").'&access_token='.env("WHATSAPP_TOKEN", "d947472c111c73ec8b4187b3dad025a2");

                $this->sendFileMessage($url);
            }


            $message = new WhatsappMessage();
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
            $message = new WhatsappMessage();
            $message->from_user = Auth::user()->id;
            $message->user_id = $request->to_user;
            $message->message = $request->message;
            $message->save();
        }

        $contactUser = WhatsappChatContact::firstOrNew([
            "user_id" => Auth::user()->id,
            "contact_id" => $request->to_user,
        ]);
        $contactUser->updated_at = now();
        $contactUser->save();

        $currentUser = WhatsappChatContact::updateOrCreate([
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

        $contacts = User::with("whatsappContacts", "roles")
            ->whereHas("whatsappContacts", function ($query) use ($user_id) {
                $query->where("user_id", $user_id);
            })
            ->where("name", "like", "%" . $keyword . "%")
            ->where("id", "!=", $user_id)

            ->get()
            ->sortBy("whatsappContacts.updated_at");

        $contacts = WhatsappChatContact::with("user", "user.roles")
            ->whereHas("user", function ($query) use ($keyword, $user_id) {
                $query->where("name", "like", "%" . $keyword . "%");
                $query->where("id", "!=", $user_id);
            })
            ->where("user_id", $user_id)
            ->orderBy("updated_at", "DESC")
            ->get();


        return view(
            "admin.whatsapp.chatcontacts",
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
            ->with("whatsappMessages")
            ->first();
        WhatsappMessage::with('toUser', 'fromUser')->where("user_id", $request->contact_id)->get();

        $pagination = false;
        if ($request->page && $request->page > 1) {
            $pagination = true;
        }
        $contact_id = $request->contact_id;
        $user_id = Auth()->User()->id;
        $data = WhatsappMessage::with('toUser', 'fromUser')->where(function ($query) use ($contact_id) {
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
            "admin.whatsapp.chat-view",
            compact("user", "messages", "pagination")
        );
    }
    public function lastMessageWhatapp()
    {

        $message = WhatsappMessage::with('fromUser')->where('user_id', auth()->user()->id)->latest()->take(3)->get()->unique('from_user');;

        return $message;
    }
}
