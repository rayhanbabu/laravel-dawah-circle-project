@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')


   <!-- banner -->
   <section class="banner px-3 mx-auto max-w-screen-lg mb-10">
        <button class="block bg-black border-0 uppercase text-white w-full px-3 py-2">
           Welcome to Altabanu
       </button>
       <p class="my-3 text-center">
            Committed to Bringing Unique Traditional Customized Bangladeshi Clothing
            and <br class="hidden sm:block" />
            Handcrafted Jewelry to Your Doorsteps
      </p>
      <img src="{{asset('frontend/images/banner.png')}}" alt="banner image" class="w-full h-auto" />
    </section>
    <!-- banner -->



    <!-- product -->
    <section class="max-w-screen-xl mx-auto px-2 border rounded">
      <div class="p-5 border-b-2">
        <h2 class="text-2xl font-semibold">Top Rated Products</h2>
      </div>

      <div class="products gap-4 grid mt-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

      @foreach($product as $row) 
      <div 
            class="product hover:shadow transition duration-300 hover:bg-gray-100 cursor-pointer border-2 border-[#D78D81] rounded p-2"
        >
        <a href="{{url('product_detail/'.$row->id)}}"> 
        <div class="flex justify-center">
          <img src="{{asset('/uploads/admin/'.$row->image)}}" alt="product" class="w-auto" style="height: 300px;" />
       </div>
        <h4 class="text-xl mt-2 font-bold"> {{ $row->product_name }} </h4>
          <div class="price flex items-center gap-3 my-3">
            <p class="line-through text-gray-400"> {{ $row->amount }} TK </p>
            <p> {{ $row->amount }} TK </p>
          </div>
          </a>

              <button class="bg-[#D78D81] hover:bg-red-400 transition duration-300 block w-full px-4 py-2 rounded-lg" >
                 Add to Cart
             </button>

       </div>
      @endforeach
      

        <!-- Repeat the above product div for other products -->
      </div>
    </section>
    <!-- product -->

    <!-- about -->
    <section class="about max-w-screen-xl mx-auto px-2 text-center py-8 my-10">
      <div class="-mt-12">
        <h3 class="uppercase font-bold text-2xl mb-5">About Altabanu</h3>
        <p class="mb-8">
          Since being established in 2020, Altabanu has been known for an
          unparalleled commitment to customer satisfaction. <br />
          It’s this standard of excellence that has provided the impetus for us
          to grow into the business we are today.
        </p>
        <p>
          We believe that the customer always comes first - and that means
          exceptional products and exceptional services. <br />
          Get in touch today to learn more about what we have to offer.
        </p>
        
      </div>
    </section>
    <!-- about -->
    <section
      class="service my-12 px-2 max-w-screen-xl mx-auto bg-[#FCF3F1] min-h-[30vh]"
    >
      <div class="text-center py-4 mb-5 border-b-2">
        <h1 class="text-3xl font-bold -mt-8">SERVICE</h1>
        <p>Exceding your experience</p>
      </div>
      <div class="p-5 flex flex-wrap md:flex-nowrap gap-5 border-b-2">
        <img src="{{asset('frontend/images/service1.png')}}" alt="service-image" />
        <div class="">
          <h3 class="font-bold text-2xl mb-4 capitalize">scheduled delivary</h3>
          <p>
            We want all of our customers to experience the impressive level of
            professionalism when working with Altabanu.com. All of our services,
            especially this one, exist to make your life easier and stress free.
            You can trust us to supply you with the best products, as well as
            top quality customer service.
          </p>
        </div>
      </div>
      <div class="p-5 flex flex-wrap md:flex-nowrap gap-5 border-b-2">
        <div class="">
          <h3 class="font-bold text-2xl mb-4 capitalize">scheduled delivary</h3>
          <p>
             We want all of our customers to experience the impressive level of
             professionalism when working with Altabanu.com. All of our services,
             especially this one, exist to make your life easier and stress free.
             You can trust us to supply you with the best products, as well as
             top quality customer service.
          </p>
        </div>
        <img src="{{asset('frontend/images/service-2.png')}}" alt="service-image" />
      </div>
    </section>
    <!--  -->
    <!-- contact -->
    <section
      class="mx-auto px-2 my-10 grid max-w-screen-xl grid-cols-1 gap-5 sm:grid-cols-2"
    >
      <div class="h-full md:h-[70vh]">
        <img
          src="{{asset('frontend/images/contact.jpg')}}"
          class="object-cover w-full h-full"
          alt="contact"
        />
      </div>
      <div class="flex flex-col">
        <h2 class="font-semibold uppercase text-center mb-5 text-2xl">
          get in touch
        </h2>
        <div class="md:max-w-[60%] mx-auto">
          <div class="flex gap-5 mx-auto mb-5">
            <input
              type="text"
              placeholder="Name"
              class="p-2 border-b-2 border-black w-full"
            /><input
              type="text"
              placeholder="Email"
              class="p-2 border-b-2 border-black w-full"
            />
          </div>
          <div class="mx-auto">
            <input
              type="text"
              placeholder="Subject"
              class="p-2 border-b-2 border-black mx-auto w-full"
            />
            <textarea
              name=""
              cols="12"
              rows="6"
              placeholder="Message"
              class="mt-5 w-full border-b-2 border-black"
              id=""
            ></textarea>
            <button
              class="bg-black border-0 py-2 px-4 text-lg capitalize text-white mt-5 w-full"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </section>
    <!-- contact -->



   


@endsection