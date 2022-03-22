@extends('admin.sidebar.sidebar')
@section('title','Reset Password')
@section('pageName','Reset Password')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Reset Password
        </h2>
    </div>
    <form method="POST" action="{{ route('change.password') }}">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-4">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label>Current Password</label>
                        <input type="password" class="input w-full border mt-2" name="current_password"
                               placeholder="Input current password">
                        @error('current_password')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>New Password</label>
                        <input type="password" class="input w-full border mt-2" name="new_password"
                               placeholder="Enter new password">
                        @error('new_password')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Confirm New Password</label>
                        <input type="password" class="input w-full border mt-2" name="confirm_password"
                               placeholder="Enter confirm password">
                        @error('confirm_password')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </div>
    </form>
@endsection


