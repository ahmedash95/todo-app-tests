<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Notifications\TodoPostToTwitter;
use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = $request->user()->todos->groupBy('status');

        return view('home', [
            'pending' => $todos['pending'] ?? [],
            'done' => $todos['done'] ?? [],
        ]);
    }

    public function store(StoreTodoRequest $request)
    {
        $request->user()->todos()->create($request->validated());

        return redirect()->route('todo.index');
    }

    public function update(Request $request, $id)
    {
        $todo = $request->user()->todos()->findOrFail($id);
        $todo->update(['status' => $todo->status == Todo::STATUS_PENDING ? Todo::STATUS_DONE : Todo::STATUS_PENDING]);
        if ($request->has('twitter')) {
            $request->user()->notify(new TodoPostToTwitter($todo));
        }

        return redirect()->route('todo.index');
    }

    public function destroy(Request $request, $id)
    {
        $request->user()->todos()->findOrFail($id)->delete();

        return redirect()->route('todo.index');
    }
}
