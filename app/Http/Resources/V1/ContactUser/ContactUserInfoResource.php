<?php

namespace App\Http\Resources\V1\ContactUser;

use App\Http\Resources\V1\Avatar\AvatarResource;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function auth;
use const USERNAME_ANONYMOUS;

class ContactUserInfoResource extends JsonResource
{

    public function __construct(Contact $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $current_user = auth()->user();

        // check show mobile conditions
        $_mobile = null;
        $get_contact_user = User::where('id_user', $this->contact_user_id)->first();

        if($this->contact_user_mobile){
            $_mobile = $get_contact_user->mobile;
        }else{
            $condition_2 = $this->whereHas('contact_contacts', function($query) use ($current_user){
                $query->where([
                    ['contact_user_id', '=', $current_user->id_user],
                    ['contact_user_mobile', '=', true]
                ]);
            })->exists();
            if($condition_2)
                $_mobile = $get_contact_user->mobile;
        }

        $_name = $this->contact_user_name != null ? $this->contact_user_name : $get_contact_user->name;

        $gender = $get_contact_user->gender?->name;
        $data = [
            'id_contact' => $this->id_contact,
            'id_user' => $get_contact_user->id_user,
            'name' => $_name,
            'username' => $get_contact_user->username?? null,
            'gender' => $get_contact_user->gender?->value,
            'gender_name' => $gender ? strtolower($gender) : null,
            'avatar' => new AvatarResource($get_contact_user->avatar),
        ];

        // show mobile for user
        if($_mobile != null)
            $data['mobile'] = $_mobile;

        return $data;
    }
}
