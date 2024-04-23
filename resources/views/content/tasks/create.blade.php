<!-- create.blade.php -->
@extends('layouts.layoutMaster')

@section('title', 'Create Task')

@section('vendor-style')
<!-- Include your vendor styles here -->
@endsection

@section('page-style')
<!-- Include your page-specific styles here -->
@endsection

@section('vendor-script')
<!-- Include your vendor scripts here -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page-script')

<style>
  [required]:invalid+label::after {
    content: ' *';
    color: red;
  }
</style>


@endsection

<div class="alert alert-success" style="display: none;" id="success">

  User Added Successfully
</div>
@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Add New Task</h4>
  </div>
  <div class="card-body">

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form method="post" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
      @csrf


      {{-- Admins --}}
      <div class="mb-3">
        <select class="form-control" id="adminNameId" name="adminNameId" >
          <option >Select Admins:</option>
          @foreach($admins as $admin)
          <option value="{{ $admin->id }}">{{ $admin->fname }}</option>
          @endforeach
        </select>
      </div>

       {{-- assignedNameId --}}
      <div class="mb-3">
        <select class="form-control" id="assignedNameId" name="assignedNameId" >
          <option >Select Assigned Name:</option>
          @foreach($assigneds as $assigned)
          <option value="{{ $assigned->id }}">{{ $assigned->fname }}</option>
          @endforeach
        </select>
      </div>

        {{-- Title --}}
      <div class="mb-3">
        <label for="title" class="form-label">Title </label>
        <input type="text" class="form-control required" id="title" name="title" required>
      </div>


          {{-- Description --}}
          <div class="mb-3">
            <label for="description">Description</label>
            <textarea type="text" class="form-control" id="description" name="description" style="resize:none;"
          required></textarea>

          </div>



      <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
  </div>
</div>
</div>
</div>

@endsection
