@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')



<style>
      /* Optional: Add hover effects to user icon */
      .userIcon:hover {
        color: #555;
      }
     /* Container for size options */
.size-option {
  display: flex;
  align-items: center;
  border: 2px solid #ccc;
  border-radius: 8px;
  /* padding: 5px; */
  cursor: pointer;
  transition: border-color 0.3s, background-color 0.3s;
}

/* Hover effect */
.size-option:hover {
  border-color: #999;
}

/* Selected effect */
input[type="radio"]:checked + .size-label {
  background-color: #025ba4; /* Gray background */
  border-color: #333;
  color: #fff;
  font-weight: bold;
}

/* Hide the radio button */
input[type="radio"] {
  display: none;
}

/* Label for size */
.size-label {
  display: block;
  padding: 10px;
  border-radius: 8px;
  text-align: center;
  font-size: 16px;
  color: #333;
  transition: background-color 0.3s, border-color 0.3s;
}

      /* Dropdown positioning */
      #userDropdown {
        min-width: 150px;
        right: 0;
      }
      ul li a {
        text-wrap: nowrap;
      }
    </style>




<div
      class="max-w-screen-lg mx-auto mt-10 shadow-lg bg-white rounded-lg overflow-hidden"
    >
      <div class="grid md:grid-cols-3 grid-cols-1">
        <!-- Left Side: Product Image -->
        <div class="p-4">
          <img
            id="mainImage"
            src="{{asset('/uploads/admin/'.$product->image)}}"
            alt="Product Image"
            class="object-contain rounded-lg product-image"
          />
        </div>

        <!-- Right Side: Product Information -->
        <div class="p-4 flex gap-4 col-span-2">
          <!-- Small Images -->
          <div class="flex flex-col gap-3 mb-4">

          @foreach($product_slider as $row)
             <img
                src="{{ asset('/uploads/admin/'.$row->image) }}"
                alt="Product Image"
                class="w-16 h-16 object-cover rounded cursor-pointer"
                onclick="changeImage('{{ asset('/uploads/admin/'.$row->image) }}')"
              />
          @endforeach
           
          </div>
          <div class="flex flex-col items-start">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Product Title</h1>
            <div class="w-1/2">
              <div class="flex items-center gap-10 font-bold justify-between">
                <p>Price</p>
                <p>Quantity</p>
              </div>
              <div class="flex gap-10 items-center justify-between mt-3">
                <p>$67.44</p>
                <input
                     type="number"
                     value="1"
                     class="border-2 border-gray w-[50px]"
                     min="1"
                     step="1"
                   />
              </div>
            </div>
            <div class="mt-2">
              <h2 class="font-bold text-xl mb-2">Select Size</h2>
              <div class="flex items-center gap-3 my-5">
                <label class="size-option">
                  <input type="radio" name="size" value="XS" />
                  <span class="size-label">XS</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="S" />
                  <span class="size-label">S</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="M" />
                  <span class="size-label">M</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="L" />
                  <span class="size-label">L</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="XL" />
                  <span class="size-label">XL</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="XXL" />
                  <span class="size-label">XXL</span>
                </label>
              </div>
            </div>

            <div class="specification">
              <h2 class="text-xl mb-3 font-bold">Specification</h2>
              <div class="flex flex-col gap-3">
                <p>Product Type: Bed Sheet</p>
                <p>Fabrics: Twill Cotton</p>
                <p>Bed Sheet Size: 7.5 X 8 Feet</p>
                <p>Origin: Bangladesh</p>
              </div>
            </div>
            <button
              class="mt-3 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300"
            >
            <a href="./cart.html">

              Add to Cart
            </a>
            </button>
          </div>
        </div>
      </div>
    </div>





   


@endsection