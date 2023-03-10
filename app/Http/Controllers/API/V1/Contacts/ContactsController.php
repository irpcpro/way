<?php

namespace App\Http\Controllers\API\V1\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\ContactsAddRequest;
use App\Http\Requests\Contacts\ContactsDeleteRequest;
use App\Http\Requests\Contacts\ContactUpdateRequest;
use App\Http\Resources\V1\ContactUser\ContactUserInfoResource;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    public function list(Request $request)
    {
        $current_user = auth()->user();
        $contacts = $current_user->contacts()->get();
        $contacts = ContactUserInfoResource::collection($contacts);
        $contacts = $contacts->toArray($request);

        $response = APIResponse('contacts list received.', 200, true);
        $response = $response->setData($contacts);
        $response->send();
    }

    public function add(ContactsAddRequest $request)
    {
        // get variables
        $contact_user_id = $request->validated('id_user');
        $contact_user_mobile = $request->validated('mobile');
        $contact_user_name = $request->validated('name');

        $current_user = auth()->user();

        // check if user id is not for current user
        if($current_user->id_user == $contact_user_id)
            APIResponse("user can't add himself to contact list.", 422)->send();

        // check if user is already added
        if($current_user->contacts()->where('contact_user_id', $contact_user_id)->exists())
            APIResponse("this user is already added.", 200)->send();

        // get the user which is added
        $get_user = User::where('id_user', $contact_user_id)->first();

        // check if mobile and user_id is for the same user
        if($contact_user_mobile != null && $get_user->mobile != $contact_user_mobile)
            APIResponse('the mobile number you entered is not for this user id.', 422)->send();

        // add user to contact list
        $created_contact = $current_user->contacts()->create([
            'contact_user_id' => $contact_user_id,
            'contact_user_mobile' => $contact_user_mobile != null,
            'contact_user_name' => $contact_user_name,
        ]);

        // get user info who added
        $user_added = new ContactUserInfoResource($created_contact);
        $user_added = $user_added->toArray($request);

        // response
        APIResponse('user added to contact list.', 200, true)->setData($user_added)->send();
    }

    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        // get variables
        $name = $request->validated('name');
        $mobile = $request->validated('mobile');

        if($mobile != null && $mobile !== $contact->user_contact->mobile)
            APIResponse('mobile is not for this user.', 422)->send();

        // update contact
        $contact->update([
            'contact_user_name' => $name,
            'contact_user_mobile' => $mobile != null,
        ]);

        // make model data
        $contact = new ContactUserInfoResource($contact);
        $contact = $contact->toArray($request);

        // response
        APIResponse('contact successfully updated.', 200, true)->setData($contact)->send();
    }

    public function delete(ContactsDeleteRequest $request, Contact $contact)
    {
        // add user to contact list
        $contact->delete();

        // response
        APIResponse('user successfully deleted from contact list.', 200, true)->send();
    }

}
