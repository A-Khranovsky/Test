<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;

class ApiTaskController
{
    public function commonAction(Request $request)
    {
        try {
            $user = User::where('email', '=', $request->get('user')['UserName'])->first();
            if (is_null($user)) {
                throw new Exception('User not found');
            }
            switch ($request->get('action')) {
                case 'add' :
                {
                    if (!Task::Create([
                        'text' => $request->get('item')['text'],
                        'user_id' => $user->id
                    ])) {
                        throw new Exception('Can not create record');
                    }
                    return response('ToDo task successfully added to user ' . $user->name, 200);
                }
                case 'delete' :
                {
                    $id = $request->get('item')['id'];
                    if (!$task = Task::find($id)) {
                        throw new Exception('Can not delete record with id = ' . $id);
                    }
                    $task->delete();
                    return response('Task id = ' . $id . ' successfully deleted', 200);
                }
                case 'update' :
                {
                    $id = $request->get('item')['id'];
                    if (!Task::where('id', '=', $id)
                        ->update(
                            [
                                'text' => $request->get('item')['text'],
                                'user_id' => $user->id
                            ])) {
                        throw new Exception('Can not update record with id = ' . $id);
                    }
                    return response('ToDo task id = ' . $id . ' successfully updated', 200);
                }
                default :
                    throw new Exception('wrong action');
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}


//{
//
//    "user": {
//    "name": "john doe",
//"UserName": "johndoe@gmail.com"
//},
//"action": "add", // delete // update
//"item": {
//    "id": 1,
//"text": "todo item"
//}
//}
