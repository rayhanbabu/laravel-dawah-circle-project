@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('event_registration','active')
@section('homecontent')

<div class="container mt-5 shadow p-4 rounded">
    <h5 style="margin:0px;" class="text-center">ঢাবি সীরাত মাহফিল ও পুরস্কার বিতরণী-২০২৪</h5>

    <p class="text-center"> <b>  স্থান: টিএসসি, ঢাকা বিশ্ববিদ্যালয়
             তারিখঃ ২১ সেপ্টেম্বর,
             ব্যাপ্তিঃ সারাদিন ব্যাপি   </b> </p>
    <p style="font-size: 14px;"> TSC অডিটরিয়ামে সিটের জন্য রেজিস্ট্রেশন ফী ১০০ টাকা। অডিটোরিয়ামের 
        সিট পূর্ণ হয়ে গেলে আর অডিটেরিমের জন্য রেজিস্ট্রেশন করতে পারবেন না। 
        বাকিদের ফ্রি রেজিস্ট্রেশন আবশ্যক। তাদের জন্য টিএসসি মাঠ ও গেমসরুমে ব্যবস্থা করা হয়েছে ।
         রেজিস্ট্রেশন সম্পন্ন হলে ইমেইলের মাধ্যমে আপনাকে কনফার্ম করা হবে।
          প্রোগামের দিন টিএসসিতে প্রবেশের সময় কনফার্মেশন ইমেইল দেখিয়ে 
          গেইট পাস টোকেন নিয়ে ঢুকতে হবে। রেজিষ্ট্রেশন সংক্রান্ত যেকোনো সমস্যায় আমাদের পেজে ম্যাসেজ করুন
           <a target="_blank" href="https://www.facebook.com/dudcbd"> Click here</a>
</p>

@if ($errors->any())
          <div class="alert alert-danger">
             <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
           </div>
       @endif

            @if(Session::has('fail'))
                <div  class="alert alert-danger"> {{Session::get('fail')}}</div>
            @endif
                           
             @if(Session::has('success'))
                   <div  class="alert alert-success"> {{Session::get('success')}}</div>
             @endif
    <form method="POST" action="{{ url('event/event_registration') }}">
    @csrf
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Enter your name" required>
            </div>

            <div class="col-sm-6 mb-3">
                <label for="registration" class="form-label"> DU Registration Number</label>
                <input type="text" class="form-control" value="{{ old('registration') }}" id="registration" name="registration"
                 placeholder="Enter registration number"
                 pattern="\d{10}" 
                 maxlength="10" 
                 title="Please enter a valid 10-digit registration number"
                 required />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="phone" value="{{ old('phone') }}"  maxlength="11"  pattern="[0][1][3 7 6 5 8 9][0-9]{8}" title="
                Please select Valid mobile number" class="form-control" id="phone" placeholder="Enter your phone number" required>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-6 mb-3">
    <label for="department" class="form-label">Department Name</label>
    <select class="form-select" id="department" name="department" required>
        <option value="" {{ old('department') == '' ? 'selected' : '' }}>Select Department</option>
        @foreach(department() as $row)
            <option value="{{ $row->department_name }}" {{ old('department') == $row->department_name ? 'selected' : '' }}>
                {{ $row->department_name }}
            </option>
        @endforeach
    </select>
    </div>

           <div class="col-sm-6 mb-3">
    <label for="address" class="form-label">Hall Name</label>
    <select class="form-select" id="address" name="address" required>
        <option value="" {{ old('address') == '' ? 'selected' : '' }}>Select Hall</option>
        @foreach(hall() as $row)
            <option value="{{ $row->hall_name }}" {{ old('address') == $row->hall_name ? 'selected' : '' }}>
                {{ $row->hall_name }}
            </option>
        @endforeach
    </select>
</div>

     </div>


        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                   <select class="form-select" id="gender" name="gender" required>
                      <option value="" {{ old('gender') == '' ? 'selected' : '' }}>Select gender</option>
                      <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                      <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                  </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label for="session" class="form-label">Current Year</label>
                <select class="form-select" id="passing_year" name="passing_year" required>
                      <option value="" {{ old('passing_year') == '' ? 'selected' : '' }}>Select Current Year</option>
                      <option value="1st Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 1st Year </option>
                      <option value="2nd Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 2nd Year </option>
                      <option value="3rd Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 3rd Year </option>
                      <option value="4th Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 4th Year </option>
                      <option value="MS" {{ old('passing_year') == '' ? 'selected' : '' }}> MS </option>
                      <option value="Honors Pass" {{ old('passing_year') == '' ? 'selected' : '' }}> Honors Pass </option>
                      <option value="Masters Pass " {{ old('passing_year') == '' ? 'selected' : '' }}> Masters Pass  </option>
                    </select>
        </div>
   </div>



   <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="gender" class="form-label">Resident at Hall</label>
                   <select class="form-select" id="resident" name="resident" required>
                      <option value="" {{ old('resident') == '' ? 'selected' : '' }}>Select Resident</option>
                      <option value="Yes" {{ old('resident') == 'Yes' ? 'selected' : '' }}>Yes</option>
                      <option value="No" {{ old('resident') == 'No' ? 'selected' : '' }}>No</option>
                  </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label for="session" class="form-label">Registration Type</label>
                <select class="form-select" id="registration_type" name="registration_type" required>
                      <option value="" {{ old('registration_type') == '' ? 'selected' : '' }}>Select Registration Type</option>
                      <option value="Free" {{ old('registration_type') == 'Free' ? 'selected' : '' }}>  Free Registration  </option>
               </select>
        </div>
   </div>



       



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
  



@endsection

