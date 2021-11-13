<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;

class ApiController extends Controller
{

    public function readAllTodos()
    {
        $array         = ['error' => ''];
        $array['list'] = Todo::all();

        return $array;
    }

    public function readTodo()
    {
    }

    public function updateTodo()
    {
    }

    public function createTodo(Request $request)
    {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3']
        ]);

        if ($validator->fails()) {
            return $array['error'] = $validator->messages();
        }

        $todo        = new Todo();
        $todo->title = $request->input('title');
        $todo->save();

        return $array;
    }

    public function deleteTodo()
    {
    }
}
