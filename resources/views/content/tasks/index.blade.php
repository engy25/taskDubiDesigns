@extends('layouts.layoutMaster')

@section('title', 'Tasks List - Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Tasks /</span> List
</h4>

<!-- Centered Add Task Button -->
<div class="d-flex justify-content-center mb-3">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- craeting task by modal --}}
  <a href="{{ route('tasks.create') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal" title="{{ trans('words.add') }}" style="width: 550px;">
    {{ trans('words.add') }}
  </a>




</div>
<br>
<div class="d-flex align-items-center">
  <!-- Search Form -->
  <form class="d-flex" id="searchForm">
    <input class="form-control me-2" type="search" id="search" name="search" placeholder="{{ trans('words.search') }}"
      aria-label="Search" style="width: 950px;">

    <!-- Select input for admin -->
    <select class="form-select me-2" id="adminId" name="adminId">
      <option value="">Select Admin Name </option>
      @foreach ($admins as $admin)
      <option value="{{ $admin->id }}">{{ $admin->fname }}</option>
      @endforeach
    </select>

    <!-- Select input for assigned user -->
    <select class="form-select me-2" id="assignedId" name="assignedId">
      <option value="">Select Assigned Name</option>
      @foreach ($assigneds as $assigned)
      <option value="{{ $assigned->id }}">{{ $assigned->fname }}</option>
      @endforeach
    </select>

   <!-- Input for date range -->
  <input class="form-control me-2" type="date" id="date" name="date">

  </form>
</div>
<br><br>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<div class="alert alert-success" style="display: none;" id="success1">

  Task Added Successfully
</div>

<div class="alert alert-success" style="display: none;" id="success2">
  Task Updated Successfully
</div>

<div class="alert alert-danger" style="display: none;" id="success3">
  Task Deleted Successfully
</div>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      @include('content.tasks.pagination_index')
    </div>
  </div>
</div>

@include('content.tasks.task_js')
@include('content.tasks.add_task_model')
{!! Toastr::message() !!}

@endsection

@section('custom-style')
<style>
  .checked {
    color: orange;
  }

  .card {
    width: 100%;
  }

  .export-pdf-card {
    width: 100%;
  }
</style>
@endsection
