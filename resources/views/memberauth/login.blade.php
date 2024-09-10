@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')


<div class="bg-gray-200 flex items-center justify-center min-h-[80vh]">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-900">Login</h2>
        <form method="POST" action="{{ url('/member/login_insert') }}">
           @csrf
          <div class="mb-4">
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Email</label
            >
            <input
              type="email"
              id="email"
              name="email"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              autocomplete="off" required
            />
          </div>
          <div class="mb-6">
            <label
              for="password"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Password</label
            >
            <input
              type="password"
              id="password"
              name="password"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              autocomplete="off" required
            />
          </div>

          @if(Session::has('fail'))
    <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
         {{ Session::get('fail') }}
   </div>
@endif

@if(Session::has('success'))
  <div style="background-color: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
    {{ Session::get('success') }}
  </div>
@endif

          <button
            type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium"
          >
            Login
          </button>
          <div class="mt-4 flex justify-between items-center">
            <a href="#" class="text-blue-500 text-sm hover:underline"
              >Forgot Password? </a
            >
            <a
              href="{{url('/member/register')}}"
              class="text-blue-500 text-sm hover:underline"
              >Not registered? Sign up</a
            >
          </div>
        </form>
      </div>
    </div>



@endsection