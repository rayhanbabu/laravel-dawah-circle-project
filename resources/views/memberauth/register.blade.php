@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')


<div class="bg-gray-200 flex items-center justify-center min-h-[80vh]">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-900">Registration</h2>
    <form method="POST" action="{{ url('member/register_insert') }}">
    @csrf

      <!-- Full Name -->
      <div class="mb-4">
        <label for="member_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
        <input
          type="text"
          id="name"
          name="name"
          class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
          required
        />
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
          required
        />
      </div>

      <div class="mb-6 relative">
  <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
  <input
    type="password"
    id="password"
    name="password"
    class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
    required
  />
  <span class="absolute inset-y-2 right-2 flex items-center">
    <i class="fas fa-eye cursor-pointer text-gray-500" id="togglePassword"></i>
  </span>
</div>


      <!-- Confirm Password -->
      <div class="mb-6 relative">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
        <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
          required
        />
        <span class="absolute inset-y-0 right-3 flex items-center">
          <i class="fas fa-eye cursor-pointer text-gray-500" id="toggleConfirmPassword"></i>
        </span>
      </div>

 @if ($errors->any())
    <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;" role="alert">
     <ul style="margin-top: 0.5rem; list-style-type: disc; padding-left: 1rem;">
       @foreach ($errors->all() as $error)
        <li style="color: #b91c1c;">{{ $error }}</li>
       @endforeach
     </ul>
    </div>
  @endif
      <!-- Submit Button -->
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium"
      >
        Register
      </button>

      <!-- Links -->
      <div class="mt-4 flex justify-between items-center">
        <a href="#" class="text-blue-500 text-sm hover:underline">Forgot Password?</a>
        <a href="{{url('/member/login')}}" class="text-blue-500 text-sm hover:underline">Already registered? Login</a>
      </div>
    </form>
  </div>
</div>

<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Password Toggle Script -->
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');
  const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
  const confirmPassword = document.querySelector('#password_confirmation');

  togglePassword.addEventListener('click', function () {
    // Toggle the type attribute for password
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the eye icon
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });

  toggleConfirmPassword.addEventListener('click', function () {
    // Toggle the type attribute for confirm password
    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPassword.setAttribute('type', type);

    // Toggle the eye icon
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
</script>


@endsection