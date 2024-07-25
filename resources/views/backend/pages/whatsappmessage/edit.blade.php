
@extends('backend.layouts.master')

@section('title')
Whatsapp Messages Edit - Admin Panel
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
                <h4 class="page-title pull-left">Whatsapp Message Edit</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.whatsappmessage.index') }}">Test Contacts</a></li>
                    <li><span>Edit Message - {{ $admin->title }}</span></li>
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
                    <h4 class="header-title">Edit Message - {{ $admin->title }}</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.whatsappmessage.update', $admin->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ $admin->title }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control">{{ $admin->message }}</textarea>
                            </div>
                            <div class="form-group col-md-6 col-sm-6" required>
                                <label for="username">Status</label>
                               <select name="status" id="status" class="form-control">
                                 @foreach ($status as $key => $val)
                                      <option value="{{ $key }}" @if($key == $admin->status) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Message</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection