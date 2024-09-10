@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')




    <!-- product -->
    <section class="max-w-screen-xl mx-auto px-2 border rounded">
      <div class="p-5 border-b-2">
        <h2 class="text-2xl font-semibold">{{$category->category_name}}</h2>
      </div>


      <div
        class="products gap-4 grid mt-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
      >


      @foreach($category_product as $row)
       
      <div 
          class="product hover:shadow transition duration-300 hover:bg-gray-100 cursor-pointer border-2 border-[#D78D81] rounded p-2"
        >
        <a href="{{url('/product_detail/'.$row->id)}}"> 
        <div class="flex justify-center">
          <img src="{{asset('/uploads/admin/'.$row->image)}}" alt="product" class="w-auto" style="height: 300px;" />
       </div>
        <h4 class="text-xl mt-2 font-bold"> {{ $row->product_name }} </h4>
          <div class="price flex items-center gap-3 my-3">
            <p class="line-through text-gray-400"> {{ $row->amount }} TK </p>
            <p> {{ $row->amount }} TK </p>
          </div>
          </a>
           <button
              class="bg-[#D78D81] hover:bg-red-400 transition duration-300 block w-full px-4 py-2 rounded-lg"
           >
              Add to Cart
            </button>
       </div>
      @endforeach
      

        <!-- Repeat the above product div for other products -->
      </div>
    </section>
    <!-- product -->

  



   


@endsection