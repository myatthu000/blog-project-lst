@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="">
            <div class="">
                <div class="col-6">
                    <form class="border w-50 px-2 py-3" action="{{ route('user.change') }}" method="post">
                        @csrf
                        @method('post')
                        <h5>Change Password</h5>
                        <div class="my-3">
                            <label for="password" class="form-label d-block">New Password</label>
                            <input type="hidden" name="password" class="form-control">
                            <input type="password" name="password" class="form-control">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="">
                            <button class="btn btn-outline-success rounded-0 btn-sm">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    </div>

        <script>
            // function a() {
                // confirm("Are You sure !")
            // }
        </script>

@endsection
