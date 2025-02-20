
@extends('backend.layouts.master')

@section('title')
Create Contact Groups - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Contact Groups Create</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.groups.index') }}">Contact Group</a></li>
                    <li><span>Contact Group</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Create Contact Groups</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.groups.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Group Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Group Name" required>
                            </div>
                        </div>

                        
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="password">Comments</label>
                                <textarea  name="comments" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-6 col-sm-6" required>
                                <label for="username">Status</label>
                               <select name="status" id="group" class="form-control">
                                 @foreach ($status as $key => $val)
                                       <option value="{{ $key }}">{{ $val }}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Groups</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection
