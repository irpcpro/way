<?php

namespace App\Http\Resources\V1\UserInfo;

use App\Http\Resources\V1\Avatar\AvatarResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfo extends JsonResource
{

    public bool $user_is_current_user = false;
    public null|string $request_mobile = null;

    public function __construct(User $resource, null|string $request_mobile = null)
    {
        parent::__construct($resource);
        $this->current_user = auth()->user();
        if($this->resource->id == $this->current_user->id)
            $this->user_is_current_user = true;

        $this->request_mobile = $request_mobile;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username?? null,
            'gender' => $this->gender?->value,
            'gender_name' => strtolower($this->gender?->name),
            'avatar' => new AvatarResource($this->avatar),
        ];

        // if user is current_user, show name and mobile
        if($this->user_is_current_user){
            $data['mobile'] = $this->mobile;
            $data['name'] = $this->name;
        }else{
            // if not, get current_user contact where user is exists on
            $current_user_contact = $this->current_user->contacts()->where('contact_user_id', $this->id)->first();
            // get the contacts of user where current_user is exists on
            $user_contacts = $this->contacts()->where('contact_user_id', $this->current_user->id)->first();

            // if user has current_user in his contact with mobile, show mobile
            if($user_contacts !== null && $user_contacts->contact_user_mobile)
                $data['mobile'] = $this->mobile;

            // if current_user has user in his contact, show details of contact
            if($current_user_contact !== null){
                // if current_user save user with another name, show that
                if($current_user_contact->contact_user_name != null)
                    $data['name'] = $current_user_contact->contact_user_name;

                // if current_user has user's mobile, show mobile
                if($current_user_contact->contact_user_mobile)
                    $data['mobile'] = $this->mobile;
            }
        }

        // if in constructor mobile is not null and is equal to user's mobile, show mobile
        if($this->request_mobile != null && $this->request_mobile == $this->mobile)
            $data['mobile'] = $this->mobile;

        return $data;
    }
}
