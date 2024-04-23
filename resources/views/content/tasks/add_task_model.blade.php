<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <form action="" method="POST" id="addTaskForm">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addModalLabel">Add Task</h1>
          <button type="button" class="btn-close close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errMsgContainer mb-3"></div>

          {{-- Admin Name --}}
          <div class="mb-3">
            <label for="adminName">Admin Name </label>
            <select name="adminName" class="form-control" id="adminName">
              @foreach($admins as $admin)
                <option value="{{ $admin->id }}">{{ $admin->fname }}</option>
              @endforeach
            </select>
            <span class="text-danger error-message" id="error_adminName"></span>
          </div>

          {{-- Assigned Name --}}
          <div class="mb-3">
            <label for="assignedName">Assigned Name </label>
            <select name="assignedName" class="form-control" id="assignedName">
              @foreach($assigneds as $assigned)
                <option value="{{ $assigned->id }}">{{ $assigned->fname }}</option>
              @endforeach
            </select>
            <span class="text-danger error-message" id="error_assignedName"></span>
          </div>

          {{-- Title --}}
          <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title">
            <span class="text-danger error-message" id="error_title"></span>
          </div>




          {{-- Description --}}
          <div class="mb-3">
            <label for="description">Description</label>
            <textarea type="text" class="form-control" id="description" name="description" style="resize:none;"
          required></textarea>
            <span class="text-danger error-message" id="error_description"></span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_task">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>
