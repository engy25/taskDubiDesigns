@extends('layouts.layoutMaster')

@section('title', 'Roles - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('content')





<div class="d-flex justify-content-between align-items-center">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Role /</span> List
    <br>
  </h4>

  <div class="d-flex align-items-center">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <a href="{{ route('roles.create') }}" class="btn btn-primary me-2" data-bs-toggle="modal"
      data-bs-target="#addRoleModal" title="{{ trans('words.add') }}">
      {{ trans('words.add') }}
    </a>

    <form class="d-flex" id="searchForm">
      <input class="form-control me-2" type="search" id="search" name="search" placeholder="{{ trans('words.search') }}"
        aria-label="Search" style="width: 950px;">

    </form>


  </div>
</div>






<div class="alert alert-success" style="display: none;" id="success1">

  Role Added Successfully
</div>



<div class="alert alert-success" style="display: none;" id="success2">
  Role Updated Successfully
</div>

<div class="alert alert-danger" style="display: none;" id="success3">
  Role Deleted Successfully
</div>

<div class="alert alert-warning" style="display: none;" id="success5">
  This Role Is Used You Canoot Update It .
</div>

@include('content.role.pagination_index')

@include('content.role.role_js')
@include('content.role.update')
@include('content.role.add_role_model')

{!! Toastr::message() !!}



@endsection
