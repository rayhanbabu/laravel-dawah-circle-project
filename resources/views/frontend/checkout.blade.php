@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')


  <!-- header -->
  <section class="w-full py-10">
      <div class="max-w-screen-lg mx-auto px-2 flex flex-wrap">
        <!-- Left Side: Shipping Address and Payment Method -->
        <div class="w-full lg:w-2/3 mb-8 lg:mb-0 ">
          <!-- Shipping Address Section -->
          <div class="mb-8 border shadow-xl p-3 rounded">
            <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
            <!-- Pick up your parcel from -->
            <div class="mb-4">
              <label class="block mb-2">Pick up your parcel from:</label>
              <div class="flex items-center mb-4">
                <label class="radio-custom">
                  <input type="radio" name="pickup" value="home">
                  <span class="radio-label">Home</span>
                </label>
                <label class="radio-custom ml-4">
                  <input type="radio" name="pickup" value="office">
                  <span class="radio-label">Office</span>
                </label>
              </div>
            </div>
  
            <!-- Name and Phone -->
            <div class="flex flex-wrap -mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
                <label class="block mb-2" for="name">Name</label>
                <input type="text" id="name" class="w-full p-2 border rounded" placeholder="Enter your name">
              </div>
              <div class="w-full md:w-1/2 px-2 mb-4">
                <label class="block mb-2" for="phone">Phone</label>
                <input type="text" id="phone" class="w-full p-2 border rounded" placeholder="Enter your phone number">
              </div>
            </div>
  
            <!-- City and Area -->
            <div class="flex flex-wrap -mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
                <label class="block mb-2" for="city">City</label>
                <input type="text" id="city" class="w-full p-2 border rounded" placeholder="Enter your city">
              </div>
              <div class="w-full md:w-1/2 px-2 mb-4">
                <label class="block mb-2" for="area">Area</label>
                <input type="text" id="area" class="w-full p-2 border rounded" placeholder="Enter your area">
              </div>
            </div>
  
            <!-- Address -->
            <div class="mb-4">
              <label class="block mb-2" for="address">Address</label>
              <textarea id="address" class="w-full p-2 border rounded" rows="4" placeholder="Enter your address"></textarea>
            </div>
          </div>
  
          <!-- Payment Method Section -->
          <div class="mb-8 border rounded p-3 shadow-xl">
            <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
            <div class="flex flex-col gap-4">
              <!-- Cash on Delivery -->
              <label class="radio-custom flex items-center p-4 border rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                <input type="radio" name="payment" value="cod">
                <span class="radio-label flex items-center">
                  <i class="fa-solid fa-money-bill-wave text-green-500 text-2xl mx-4"></i>
                  <span class="text-lg font-medium">Cash on Delivery</span>
                </span>
              </label>
  
              <!-- Credit/Debit Card -->
              <label class="radio-custom flex items-center p-4 border rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                <input type="radio" name="payment" value="card">
                <span class="radio-label flex items-center">
                  <i class="fa-solid fa-credit-card text-blue-500 text-2xl mx-4"></i>
                  <span class="text-lg font-medium">Credit/Debit Card</span>
                </span>
              </label>
  
              <!-- Other Payment Methods -->
              <label class="radio-custom flex items-center p-4 border rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                <input type="radio" name="payment" value="others">
                <span class="radio-label flex items-center">
                  <i class="fa-solid fa-wallet text-purple-500 text-2xl mx-4"></i>
                  <!-- <span class="text-lg font-medium">Other Payment Methods</span> -->
                  <img src="https://flexiguy.com/assets/FOOTER-aamarPay.png" alt="payment-method" class="w-[90%]">
                </span>
              </label>
            </div>
          </div>
  
          <!-- Confirm Order Button -->
          <div class="mt-4">
            <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">
              Confirm Order
            </button>
          </div>
        </div>
  
        <!-- Right Side: Checkout Summary -->
        <div class="w-full lg:w-1/3 p-4 lg:pl-8">
          <div class="summary border p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Checkout Summary</h2>
            <!-- Summary Items -->
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between"><span>Subtotal:</span> <span>$399.98</span></p>
            </div>
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between"><span>Shipping:</span> <span>$15.00</span></p>
            </div>
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between"><span>Tax:</span> <span>$30.00</span></p>
            </div>
            <div class="mb-2">
              <p class="flex justify-between"><span>Total:</span> <span>$444.98</span></p>
            </div>
          </div>
        </div>
      </div>
    </section>

   


@endsection