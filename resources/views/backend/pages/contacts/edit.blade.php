
@extends('backend.layouts.master')

@section('title')
Contacts Edit - Admin Panel
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
                <h4 class="page-title pull-left">Contacts Edit</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.contacts.index') }}">Live Contacts</a></li>
                    <li><span>Edit Contacts - {{ $admin->name }}</span></li>
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
                    <h4 class="header-title">Edit Contacts - {{ $admin->name }}</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.contacts.update', $admin->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $admin->name }}" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="email">Country Code</label>
                                <input type="number" class="form-control" id="code" name="code" placeholder="Enter Country Code" value="{{ $admin->code }}" required>
                            </div>

                             <div class="form-group col-md-4 col-sm-12">
                                <label for="number">Phone Number</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ $admin->phone }}" required>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="password">Has WhatsApp</label>
                                <select name="whatsapp" id="whatsapp" class="form-control" required>
                                  <option selected value="{{ $admin->whatsapp }}">{{ strtoupper($admin->whatsapp) }}</option>
                                  <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6" required>
                                <label for="username">Group</label>
                               <select name="groups" id="groups" class="form-control">
                                  @foreach ($groups as $group)
                                      <option value="{{ $group->id}}" @if($group->id == $admin->group) selected @endif>{{ $group->name  }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Contact</button>
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