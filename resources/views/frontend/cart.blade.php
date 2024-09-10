@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')

<style>
      /* Simple modal styling */
      .modal {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 50;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
      }

      .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 8px;
        position: relative;
      }

      .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
      }

      .close:hover,
      .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
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


     <!-- header -->
     <section class="w-full py-10">
      <div class="max-w-screen-lg mx-auto px-2 flex flex-wrap">
        <!-- Cart Items Section -->
        <div class="w-full lg:w-2/3 mb-8 lg:mb-0 mt-3">
          <!-- Cart Item 1 -->
          <div
            class="cart_item shadow-lg bg-[#f2f2f2] p-4 flex items-center rounded-lg justify-between mb-1"
          >
            <!-- Image -->
            <div class="w-24 h-24">
              <img
                src="./images/product.png"
                alt="cart_image"
                class="w-full h-full object-cover"
              />
            </div>

            <!-- Title and Quantity -->
            <div class="ml-4">
              <h2 class="text-xl font-semibold">Product Title</h2>
              <!-- Quantity and Delete -->
              <div class="flex items-center mt-2">
                <label for="quantity" class="mr-2">Qty:</label>
                <input
                  type="number"
                  id="quantity"
                  name="quantity"
                  min="1"
                  value="1"
                  class="w-16 p-1 border rounded mr-4"
                />
                <button class="text-red-500 hover:text-red-700">Delete</button>
              </div>
            </div>

            <!-- Price -->
            <div class="text-lg font-semibold text-right">$199.99</div>
          </div>

          <!-- Cart Item 2 -->
          <div
            class="cart_item shadow-lg bg-[#f2f2f2] p-4 flex items-center rounded-lg justify-between"
          >
            <!-- Image -->
            <div class="w-24 h-24">
              <img
                src="./images/product.png"
                alt="cart_image"
                class="w-full h-full object-cover"
              />
            </div>

            <!-- Title and Quantity -->
            <div class="ml-4">
              <h2 class="text-xl font-semibold">Product Title</h2>
              <!-- Quantity and Delete -->
              <div class="flex items-center mt-2">
                <label for="quantity" class="mr-2">Qty:</label>
                <input
                  type="number"
                  id="quantity"
                  name="quantity"
                  min="1"
                  value="1"
                  class="w-16 p-1 border rounded mr-4"
                />
                <button class="text-red-500 hover:text-red-700">Delete</button>
              </div>
            </div>

            <!-- Price -->
            <div class="text-lg font-semibold text-right">$199.99</div>
          </div>

          <!-- Coupon Code and Checkout Bar -->
          <div
            class="flex items-center bg-[#f2f2f2] justify-between p-4 border-t mt-4 rounded-lg sm:flex-nowrap flex-wrap "
          >
            <div class="flex  items-center">
              <label for="coupon" class="mr-2">Coupon Code:</label>
              <input
                type="text"
                id="coupon"
                name="coupon"
                class="w-48 p-2 border rounded"
                placeholder="Enter coupon code"
              />
            </div>
            <a href="/checkout.html"
              class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mt-3 sm:mt-0 inline-block"
            >
              Proceed to Checkout
            </a>
          </div>
        </div>

        <!-- Address and Summary Section -->
        <div class="w-full lg:w-1/3 p-4 lg:pl-8">
          <!-- Address Section -->
          <div class="mb-8 bg-[#f2f2f2] p-3 shadow-lg relative">
            <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
            <button
              class="absolute top-3 right-3 text-blue-500 hover:text-blue-700"
              id="editAddressBtn"
            >
              Edit
            </button>
            <p class="border p-4 rounded">
              1234 Elm Street, Springfield, IL, 62704, USA
            </p>
          </div>

          <!-- Summary Section -->
          <div
            class="summary shadow-lg border-dotted border-2 p-4 rounded bg-[#f2f2f2]"
          >
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

            <!-- Summary Items -->
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between">
                <span>Subtotal:</span> <span>$399.98</span>
              </p>
            </div>
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between">
                <span>Shipping:</span> <span>$15.00</span>
              </p>
            </div>
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between">
                <span>Tax:</span> <span>$30.00</span>
              </p>
            </div>
            <div class="mb-2">
              <p class="flex justify-between">
                <span>Total:</span> <span>$444.98</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Address Edit Modal -->
    <div id="addressModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2 class="text-xl font-semibold mb-4">Edit Address</h2>

        <!-- Name and Phone -->
        <div class="flex flex-wrap -mx-2 mb-4">
          <div class="w-full md:w-1/2 px-2 mb-4">
            <label class="block mb-2" for="modal_name">Name</label>
            <input
              type="text"
              id="modal_name"
              class="w-full p-2 border rounded"
              placeholder="Enter your name"
            />
          </div>
          <div class="w-full md:w-1/2 px-2 mb-4">
            <label class="block mb-2" for="modal_phone">Phone</label>
            <input
              type="text"
              id="modal_phone"
              class="w-full p-2 border rounded"
              placeholder="Enter your phone number"
            />
          </div>
        </div>

        <!-- Division and District -->
        <div class="flex flex-wrap -mx-2 mb-4">
          <div class="w-full md:w-1/2 px-2 mb-4">
            <label class="block mb-2" for="modal_division">Division</label>
            <select id="modal_division" class="w-full p-2 border rounded">
              <option value="">Select Division</option>
              <!-- Add options for divisions -->
            </select>
          </div>
          <div class="w-full md:w-1/2 px-2 mb-4">
            <label class="block mb-2" for="modal_district">District</label>
            <select id="modal_district" class="w-full p-2 border rounded">
              <option value="">Select District</option>
              <!-- Add options for districts -->
            </select>
          </div>
        </div>

        <!-- Address Textarea -->
        <div class="mb-4">
          <label class="block mb-2" for="modal_address">Address</label>
          <textarea
            id="modal_address"
            class="w-full p-2 border rounded"
            rows="4"
            placeholder="Enter your address"
          ></textarea>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
          <button
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
            id="saveAddressBtn"
          >
            Save
          </button>
        </div>
      </div>
    </div>




   


@endsection