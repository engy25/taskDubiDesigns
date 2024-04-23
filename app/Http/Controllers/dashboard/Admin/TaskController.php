<?php

namespace App\Http\Controllers\dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dash\Admin\StoreTaskRequest;
use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Models\{Task, User};
use App\Helpers\Helpers;
use App\Jobs\UpdateStatistics;
class TaskController extends Controller
{
  public $helper;
  public function __construct()
  {
    $this->helper = new Helpers();


  }
  /**
   * Display a listing of the tasks.
   */
  public function index()
  {
    $tasks = Task::latest()->paginate(PAGINATION_COUNT);

    $admins = User::role("Admin")->get();
    $assigneds = User::role("User")->get();

    return view("content.tasks.index", compact("tasks", "admins", "assigneds"));
  }


  public function show(Task $task)
  {
    return view("content.tasks.show", compact("task"));
  }


  /**paginate the tasks */
  public function paginationTask(Request $request)
  {

    $tasks = Task::latest()->paginate(PAGINATION_COUNT);

    return view("content.tasks.pagination_index", compact("tasks"))->render();

  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    //
    $admins = User::role("Admin")->get();
    $assigneds = User::role("User")->get();
    return view("content.tasks.create", compact("admins", "assigneds"));

  }


  public function store(StoreTaskRequest $request)
  {
    $assignedNameId=$request->assignedNameId;
      // Create a new task
      $task = Task::create([
          "title" => $request->title,
          "description" => $request->description,
          "assigned_by_id" => $request->adminNameId,
          "assigned_to_id" => $assignedNameId
      ]);


      if ($request->has('is_modal')) {
          return $this->respondForModal($task,$assignedNameId);
      } else {
          return $this->respondForWeb($task,$assignedNameId);
      }
  }

  /**
   * Update or create the statistic record. if job of the update not exist
   *
   * @param int $userId
   * @return void
   */
  protected function updateOrCreateStatistic($userId)
  {
      $statistic = Statistic::where('user_id', $userId)->first();

      if ($statistic) {
          $statistic->increment('task_count');
      } else {
          Statistic::create([
              'user_id' => $userId,
              'task_count' => 1
          ]);
      }
  }

  /**
   * Respond to the request for modal.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondForModal($task,$assignedNameId)
  {
      if ($task) {

         // Update or create the statistic record
        // $this->updateOrCreateStatistic($assignedNameId);


            // Dispatch the job to update the Statistics table
         UpdateStatistics::dispatch($assignedNameId);
          return response()->json([
              "status" => true,
              "message" => "Task Added Successfully"
          ]);
      } else {
          return response()->json([
              "status" => false,
              "message" => "Failed to add Task"
          ], 500);
      }
  }


  /**
   * Respond to the request for web.
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  protected function respondForWeb($task,$assignedNameId)
  {
      if ($task) {
       // Update or create the statistic record
        // $this->updateOrCreateStatistic($assignedNameId);

            // Dispatch the job to update the Statistics table
         UpdateStatistics::dispatch($assignedNameId);
          return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
      } else {
          return redirect()->route('tasks.create')->with('error', 'Failed to create task.');
      }
  }





  /**
   * search for Order
   */
  public function searchTask(Request $request)
  {

    $searchString = '%' . $request->search_string . '%';
    $adminId = $request->adminId;
    $assignedId = $request->assignedId;
    $date = $request->date;

    $tasks = Task::when($request->search_string, function ($q) use ($searchString) {
      $q->where("title", 'like', $searchString)
        ->orWhere('description', 'like', $searchString);

    })->when($request->adminId, function ($q) use ($adminId) {
      $q->where("assigned_by_id", $adminId);

    })->when($request->assignedId, function ($q) use ($assignedId) {
      $q->where("assigned_to_id", $assignedId);

    })->when($request->date, function ($q) use ($date) {
      // Use whereDate to filter based on the date part only
      $q->whereDate("created_at", $date);



    })->latest()->paginate(PAGINATION_COUNT);

    if ($tasks->count() > 0) {

      return view("content.tasks.pagination_index", compact("tasks"))->render();
    } else {
      return response()->json([
        "status" => 'nothing_found',
      ]);
    }
  }




  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Task $task)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function destroy(Task $task)
  {
    //
  }




}
