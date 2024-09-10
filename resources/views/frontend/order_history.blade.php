@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')

<style>
    /* General Styles */
    .modal {
      display: none;
    }

    .modal.show {
      display: flex;
    }

    @media (max-width: 768px) {
      .modal-content {
        width: 90%;
      }

      th,
      td {
        font-size: 0.9rem;
        padding: 0.5rem;
      }

      .max-w-screen-xl {
        padding: 1rem;
      }

      .p-2 {
        padding: 0.5rem;
      }

      .lg\:flex-row {
        flex-direction: column;
      }

      .lg\:items-center {
        align-items: flex-start;
      }

      .lg\:space-x-4 {
        margin: 0;
      }

      .lg\:w-auto {
        width: 100%;
      }

      .lg\:mb-0 {
        margin-bottom: 1rem;
      }

      .lg\:space-y-0 {
        margin-top: 1rem;
      }
    }
   
      .userIcon:hover {
        color: #555;
      }
      
      /* Dropdown positioning */
      #userDropdown {
        min-width: 150px;
        right: 0;
      }
  </style>

<div class="max-w-screen-xl mx-auto my-10 px-3 py-6 bg-white border-2 border-black shadow-lg">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row justify-between items-center border-b-2 pb-4 mb-4 border-gray-300">
      <h1 class="text-2xl font-semibold mb-4 lg:mb-0">Order History</h1>
      <div class="flex flex-col lg:flex-row items-start lg:items-center space-y-4 lg:space-y-0 lg:space-x-4 w-full lg:w-auto">
        <input type="text" placeholder="Search orders" class="p-2 border rounded w-full lg:w-auto" />
        <select class="p-2 border rounded w-full lg:w-auto">
          <option value="latest">Sort by Latest</option>
          <option value="oldest">Sort by Oldest</option>
          <option value="amount">Sort by Amount</option>
        </select>
      </div>
    </div>

    <!-- Order Table -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-gray-200">
            <th class="border-b py-2 px-4">Date & Time</th>
            <th class="border-b py-2 px-4">Product Item</th>
            <th class="border-b py-2 px-4">Total Amount</th>
            <th class="border-b py-2 px-4">Shipping Amount</th>
            <th class="border-b py-2 px-4">Net Amount</th>
            <th class="border-b py-2 px-4">Status</th>
            <th class="border-b py-2 px-4">Product View</th>
          </tr>
        </thead>
        <tbody>
          <!-- Sample Row 1 -->
          <tr>
            <td class="p-2 border-b text-center">2024-08-20 14:30</td>
            <td class="p-2 border-b text-center">Product 1</td>
            <td class="p-2 border-b text-center">$100.00</td>
            <td class="p-2 border-b text-center">$10.00</td>
            <td class="p-2 border-b text-center">$110.00</td>
            <td class="p-2 border-b text-center"><span class="bg-yellow-500 text-white px-2 py-1 rounded">Pending</span></td>
            <td class="p-2 border-b text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="openModal('modal1')">View</button></td>
          </tr>
          <!-- Sample Row 2 -->
          <tr>
            <td class="p-2 border-b text-center">2024-08-19 09:15</td>
            <td class="p-2 border-b text-center">Product 2</td>
            <td class="p-2 border-b text-center">$200.00</td>
            <td class="p-2 border-b text-center">$15.00</td>
            <td class="p-2 border-b text-center">$215.00</td>
            <td class="p-2 border-b text-center"><span class="bg-green-500 text-white px-2 py-1 rounded">Completed</span></td>
            <td class="p-2 border-b text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="openModal('modal2')">View</button></td>
          </tr>
          <!-- Sample Row 3 -->
          <tr>
            <td class="p-2 border-b text-center">2024-08-18 11:45</td>
            <td class="p-2 border-b text-center">Product 3</td>
            <td class="p-2 border-b text-center">$150.00</td>
            <td class="p-2 border-b text-center">$20.00</td>
            <td class="p-2 border-b text-center">$170.00</td>
            <td class="p-2 border-b text-center"><span class="bg-red-500 text-white px-2 py-1 rounded">Cancelled</span></td>
            <td class="p-2 border-b text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="openModal('modal3')">View</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modals -->
  <div id="modal1" class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="modal-content bg-white p-6 rounded-lg w-full md:w-8/12 max-w-4xl mx-auto relative">
      <button onclick="closeModal('modal1')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
      <h2 class="text-xl font-semibold mb-4">Order Details</h2>
      <div class="overflow-x-auto">
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-gray-200">
              <th class="border-b py-2 px-4">Image</th>
              <th class="border-b py-2 px-4">Product Name</th>
              <th class="border-b py-2 px-4">Quantity</th>
              <th class="border-b py-2 px-4">Price per Product</th>
              <th class="border-b py-2 px-4">Total Price</th>
            </tr>
          </thead>
          <tbody>
            <!-- Sample Product Row 1 -->
            <tr>
              <td class="p-2 border-b text-center"><img src="https://via.placeholder.com/100" alt="Product Image" class="w-24 h-24 object-cover mx-auto" /></td>
              <td class="p-2 border-b text-center">Product 1</td>
              <td class="p-2 border-b text-center">1</td>
              <td class="p-2 border-b text-center">$100.00</td>
              <td class="p-2 border-b text-center">$100.00</td>
            </tr>
            <!-- Sample Product Row 2 -->
            <tr>
              <td class="p-2 border-b text-center"><img src="https://via.placeholder.com/100" alt="Product Image" class="w-24 h-24 object-cover mx-auto" /></td>
              <td class="p-2 border-b text-center">Product 2</td>
              <td class="p-2 border-b text-center">2</td>
              <td class="p-2 border-b text-center">$75.00</td>
              <td class="p-2 border-b text-center">$150.00</td>
            </tr>
            <!-- Sample Product Row 3 -->
            <tr>
              <td class="p-2 border-b text-center"><img src="https://via.placeholder.com/100" alt="Product Image" class="w-24 h-24 object-cover mx-auto" /></td>
              <td class="p-2 border-b text-center">Product 3</td>
              <td class="p-2 border-b text-center">3</td>
              <td class="p-2 border-b text-center">$50.00</td>
              <td class="p-2 border-b text-center">$150.00</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <script>
    function openModal(modalId) {
      document.getElementById(modalId).classList.add('show');
    }

    function closeModal(modalId) {
      document.getElementById(modalId).classList.remove('show');
    }
  </script>

@endsection