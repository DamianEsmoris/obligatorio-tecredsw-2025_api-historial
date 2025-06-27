<?php

namespace App\Http\Controllers;

use App\Models\TaskHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskHistoryController extends Controller
{
    private function validateData(Array $data) {
        $validation = Validator::make($data, [
            'task_id' => 'required|integer',
            'title' => 'required',
            'author_id' => 'required|integer',
            'completeness' => 'integer|min:0|max:100',
            'start_date' => 'date_format:Y-m-d H:i:s',
            'due_date' => 'date_format:Y-m-d H:i:s'
        ]);
        $validationFailed = $validation->fails();
        return [$validationFailed, $validationFailed ? $validation->errors() : null];
    }

    public function Create(Request $request) {
        [$validationFailed, $validationErrors] = $this->validateData($request->all());
        if ($validationFailed)
            return response($validationErrors, 401);

        $task = new TaskHistory();
        $task->task_id = $request->post('task_id');
        $task->title = $request->post('title');
        $task->completeness = $request->post('completeness') ?? null;
        $task->author_id = $request->post('author_id');
        $task->start_date = $request->post('start_date');
        $task->due_date = $request->post('due_date');
        $task->save();

        return $task;
    }

    public function GetAll(Request $request) {
        return TaskHistory::All();
    }

    public function Get(Request $request, int $id) {
        return TaskHistory::findOrFail($id);
    }
}
