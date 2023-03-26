<?php

namespace App\Http\Controllers\API\V1\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageSeenRequest;
use App\Models\MessageSeen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageSeenController extends Controller
{

    public function seen(MessageSeenRequest $request)
    {
        $id_messages = $request->validated('id_messages');
        $current_user_id = auth()->user()->id_user;
        $data = [];

        DB::beginTransaction();
        try {
            // prepare data
            foreach ($id_messages as $id_message){
                $data[] = [
                    'id_message' => $id_message,
                    'id_user' => $current_user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            MessageSeen::insertOrIgnore($data);
            DB::commit();
            APIResponse('data inserted', 200, true)->send();
        } catch (\Exception $exception){
            DB::rollBack();
            Log::error('something went wrong in ' . __METHOD__, [$exception]);
            APIResponse('something went wrong..', 500)->send();
        }
    }

}
