<table id="data-table2" class="table border p-0 text-nowrap mb-0">
  <thead class="tabel-row-heading text-dark">
    <tr style="background:#f4f5f7">

      <th class="fw-semibold border-bottom">{{ trans('words.title') }}</th>
      <th class="fw-semibold border-bottom">{{ trans('words.description') }}</th>
      <th class="fw-semibold border-bottom">{{ trans('words.assignedName') }}</th>
      <th class="fw-semibold border-bottom">{{ trans('words.adminName') }}</th>
      <th class="fw-semibold border-bottom">Actions</th>


    </tr>
  </thead>
  <tbody>
    @foreach($tasks as $task)
    <tr>

      <td>
        <span class="text-dark fs-13 fw-semibold">{{ $task->title }}</span>
      </td>

      <td>
        <span class="text-dark fs-13 fw-semibold">{{ $task->description }} </span>
      </td>

      <td>
        <span class="text-dark fs-13 fw-semibold">{{ $task->assignedBy->fname }} </span>
      </td>

      <td>
        <span class="text-dark fs-13 fw-semibold">{{ $task->assignedTo->fname }} </span>
      </td>



      <td class="center align-middle">
        <div class="btn-group">
          <a href="{{ route('tasks.show', ['task' => $task->id]) }}" class="btn btn-success" title="Task Details">
            Show Task
          </a>&nbsp;


        </div>
      </td>

    </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4 d-flex justify-content-center">
  @if ($tasks->lastPage() > 1)
  {{ $tasks->links('pagination.simple-bootstrap-4') }}
  @endif
</div>
</div>
</div>
</div>
