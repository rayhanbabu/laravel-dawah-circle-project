<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Altabanu</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    /> -->
    <link rel="stylesheet" href="{{asset('frontend/dist/indext.css')}}" />
    <script src="{{asset('dashboardfornt/js/sweetalert.min.js')}}"></script>
    <style>
      .about {
        background: linear-gradient(180deg, #fae3ef, #fde7e7, #f0e8f9);
      }
      /* Optional: Add hover effects to user icon */
      .userIcon:hover {
        color: #555;
      }
      
      /* Dropdown positioning */
      #userDropdown {
        min-width: 150px;
        right: 0;
      }
    </style>
  </head>
  <body>
   <!-- header -->
   <header class="shadow">
    <div class="shadow">
      <div class="topHeader max-w-screen-xl mx-auto py-5">
        <ul
        class="flex overflow-x-auto items-center gap-5 justify-center md:justify-start text-nowrap"

        >
          <li><a href="/">Home</a></li>
          @foreach(category() as $row)
             <li><a href="{{url('category/'.$row->id)}}">{{ $row->category_name}}</a></li>
         @endforeach

        </ul>
      </div>
    </div>
    <div
      class="max-w-screen-xl mx-auto flex  py-3 justify-between px-2"
    >
      <a
        href="{{url('/')}}"
        class="logo w-full basis-1/2 md:w-auto flex justify-center md:justify-start"
      >
        <img src="{{asset('frontend/images/logo.png')}}" alt="logo" class="h-10" />
      </a>

      <div
        class="search w-full md:w-auto hidden sm:flex basis-full justify-center items-center mt-3 mx-5 md:mx-0 order-3 md:order-none md:mt-0"
      >
        <input
          type="text"
          placeholder="Search for Style, Collections & more"
          class="border-black border-2 px-3 py-2 rounded-l-lg w-full md:w-auto"
        />
        <button
          class="bg-black text-white px-3 py-2 border-2 border-black rounded-r-lg"
        >
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>

      <div
        class="icons w-full md:w-auto flex items-center justify-center md:justify-end text-xl gap-4 mt-3 md:mt-0 relative basis-1/2"
      >
        <i class="fa-brands fa-whatsapp"></i>

       
        @if(member_info() && member_info()['email'])
        
        <p class="userIcon cursor-pointer" onclick="toggleDropdown()" style="font-size: 14px;">
    <i class="fa-solid fa-circle-user"></i>
    {{ member_info()['name'] }}
</p>

        @else
    
    <a href="{{url('/member/login')}}">
        <p> 
          <i class="fa-solid fa-circle-user"></i>
             login
        </p>
     </a>
      
      
        @endif
        <!-- <i class="fa-regular fa-heart"></i> -->
        <a href="./cart.html">
          <i class="fa-solid fa-bag-shopping"></i>
          <sup class="font-bold rounded-full">0</sup>
        </a>

        <!-- Dropdown Menu -->
        <div
          id="userDropdown"
          class="absolute right-0 top-[169%] bg-white border border-gray-300 rounded-lg shadow-lg hidden"
        >
          <ul class="py-0">
            <li>
              <a href="/profile" class="block px-2 py-1 hover:bg-gray-100"
                >Profile</a
              >
            </li>
            <li>
              <a href="/orders" class="block px-2 py-1 hover:bg-gray-100"
                >Orders</a
              >
            </li>
            <li>
              <a href="{{url('/member/logout')}}" class="block px-2 py-1 hover:bg-gray-100"
                >Logout</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div
      class="search w-[90vw] md:w-auto sm:hidden flex justify-center items-center mt-3 mx-5 md:mt-0 mb-3"
    >
      <input
        type="text"
        placeholder="Search for Style, Collections & more"
        class="border-black border-2 px-3 py-2 rounded-l-lg w-full md:w-auto"
      />
      <button
        class="bg-black text-white px-3 py-2 border-2 border-black rounded-r-lg"
      >
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </div>
  </header>


  <!-- header -->
    <!-- header -->


    @yield('homecontent')




    <!-- Footer -->
<footer class="text-black mt-10 py-10" style="background: #f2f2f2">
  <div class="max-w-screen-xl mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <!-- 1st Column: Logo and Text -->
      <div>
        <img src="{{asset('frontend/images/logo.png')}}" alt="Logo" class="mb-4" />
        <p class="text-gray-900">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
      </div>

      <!-- 2nd Column: Social Icons -->
      <div class="flex flex-col">
        <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
        <div class="flex space-x-4">
          <a
            href="#"
            class="text-gray-900 hover:text-white transition duration-300"
          >
            <svg
              class="w-6 h-6"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M22 12.07c0-5.3-4.3-9.6-9.6-9.6S2.8 6.77 2.8 12.07c0 5.1 4.3 9.5 9.6 9.5 5.3 0 9.6-4.4 9.6-9.5zm-9.6 6.6c-1.8 0-3.4-1.5-3.4-3.4 0-1.8 1.5-3.4 3.4-3.4 1.8 0 3.4 1.5 3.4 3.4 0 1.9-1.6 3.4-3.4 3.4zm0-5.8c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5zm6.8 2.2c-.1-.5-.3-1-.6-1.4-.6-.6-1.3-1-2.2-1.2-.7-.2-1.3-.1-1.9.1-.5.3-.9.8-1.2 1.3-.1-.1-.2-.2-.3-.3-.4-.5-.9-.8-1.5-1-1.1-.3-2.2-.1-3.2.5-.3.2-.6.5-.9.9-.6.9-.7 2.1-.2 3.1.6.9 1.6 1.4 2.6 1.6.7.1 1.4 0 2-.3.8-.3 1.5-.8 2.1-1.5.5.5 1.1.8 1.7 1 1.5.5 3.2.2 4.4-1 .2-.3.4-.6.5-1 .1-.5.1-1.1.1-1.7z"
              />
            </svg>
          </a>
          <a
            href="#"
            class="text-gray-900 hover:text-white transition duration-300"
          >
            <svg
              class="w-6 h-6"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M23.1 2.9c-1.3 0-2.5.4-3.5 1.2-1-.7-2.2-1.2-3.5-1.2-3 0-5.5 2.5-5.5 5.5 0 1.7.7 3.3 1.8 4.5-1.3-.1-2.5-.4-3.5-1.1-.2.5-.3 1-.3 1.5 0 2.1 1.5 3.8 3.5 4.1-.4.1-.8.2-1.3.2-.3 0-.7-.1-1-.1.7 2.2 2.7 3.8 5 3.8 3 0 5.5-2.5 5.5-5.5s-2.5-5.5-5.5-5.5zm-6.4 8.5h-2.4v-6.6h2.4v6.6zm-1.2-7.4c-.8 0-1.5.7-1.5 1.5s.7 1.5 1.5 1.5 1.5-.7 1.5-1.5-.7-1.5-1.5-1.5zm6.7 7.4h-2.4v-3.6c0-.9-.1-1.6-.4-2.2-.3-.6-.8-1-1.4-1.3-.7-.3-1.4-.4-2.3-.4-1.7 0-3.3.7-4.5 1.9-.8.8-1.3 1.9-1.5 3.1-.2 1.4-.3 2.9-.3 4.3v2.6h-2.4v-2.6c0-1.6.2-3.2.6-4.7.4-1.4 1.1-2.8 2.1-3.8 1.1-1 2.5-1.7 4-2.1.4-.1.9-.2 1.4-.2s.9.1 1.4.2c1.5.4 2.9 1.1 4.1 2.1 1.2 1 1.9 2.3 2.3 3.8.4 1.5.5 3.1.5 4.7v2.6z"
              />
            </svg>
          </a>
        </div>
      </div>

      <!-- 3rd Column: Contact Us -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
        <p class="text-gray-900 mb-2">
          123 Main Street,<br />
          City, State, 12345
        </p>
        <p class="text-gray-900 mb-2">Phone: (123) 456-7890</p>
        <p class="text-gray-900">Email: contact@example.com</p>
      </div>

      <!-- 4th Column: Let Us Help You -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Let Us Help You</h3>
        <ul class="list-disc pl-5 text-gray-900 space-y-2">
          <li>
            <a href="#" class="hover:text-white transition duration-300"
              >Shipping Information</a
            >
          </li>
          <li>
            <a href="#" class="hover:text-white transition duration-300"
              >Returns & Exchanges</a
            >
          </li>
          <li>
            <a href="#" class="hover:text-white transition duration-300">FAQs</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <hr class="my-10" />

  <div class="max-w-screen-xl mx-auto p-4">
    <!-- Latest Ethnic Collection -->
    <!-- NEW ARRIVAL -->
    
  <!-- BOTTOM SECTION -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Support -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left">
      <i class="fas fa-headset text-3xl mb-2"></i> <!-- Support Icon -->
      <h3 class="text-lg font-semibold mb-2">24/7 Support</h3>
      <p class="text-gray-900">We're here to help you anytime, anywhere.</p>
    </div>

    <!-- Free Shipping -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left">
      <i class="fas fa-shipping-fast text-3xl mb-2"></i> <!-- Shipping Icon -->
      <h3 class="text-lg font-semibold mb-2">Free Shipping</h3>
      <p class="text-gray-900">Enjoy free shipping on all orders.</p>
    </div>

    <!-- Easy Return -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left">
      <i class="fas fa-undo-alt text-3xl mb-2"></i> <!-- Return Icon -->
      <h3 class="text-lg font-semibold mb-2">Easy Return</h3>
      <p class="text-gray-900">Hassle-free returns within 30 days.</p>
    </div>

    <!-- Custom Fit -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left">
      <i class="fas fa-ruler-combined text-3xl mb-2"></i> <!-- Custom Fit Icon -->
      <h3 class="text-lg font-semibold mb-2">Custom Fit</h3>
      <p class="text-gray-900">Tailored to fit your style and needs.</p>
    </div>
  </div>
  </div>
</footer>

    <!-- script -->
     <script src="{{asset('frontend/dist/main.js')}}"></script>
    <script
      src="https://kit.fontawesome.com/f66fcf2f19.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
