@extends('layouts.payment')

@section('content')

<style>
    .mydrop {
        background: #100f1b;
    }

    .mydrop:hover {
        background: #ff8a00 !important;
    }

    .get {
        color: #e0e2e6;
    }
    .user-thumb {
    display: inline-block;
    height: 32px;
    width: 32px;
    line-height: 32px;
    color: #fff;
    border-radius: 50%;
    background: #52a846;
    text-align: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="main-content col-lg-8">
            @if (session('error') || session('success'))
            <p class="{{ session('error') ? 'error text-danger':'success text-success' }}">
                {{ session('error') ?? session('success') }}
            </p>
            @endif
            <div class="content-area bottom-course">
                <form method="POST" action="{{ route('create-payment') }}">
                    @csrf
                    <div class="input-item input-with-label col-lg-6 col-md-12">
                        <label class="input-item-label">Package</label>
                        <div class="select-wrapper">
                            <select class="input-bordered text-white" id="cat" required>
                                <option class="mydrop" value>Choose Package</option>
                                @foreach ($categories as $category)
                                <option class="mydrop" value="{{ $category->amount }}">{{ $category->name }}
                                    ({{ $category->duration }} Months)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="input-bordered" id="cat-amount" name="amount" value="" />

                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <span class="cl1">TOTAL</span>
                                    </span>
                                    <span class="text-white link-ucap h5" id="course-value">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 mt-3">
                        <button class="btn btn-sm btn-success">Enroll In Course</button>
                    </div>
                </form>
            </div>
            <br>
            <!-- .card -->
            <div class="content-area bottom-course mb-4">
                <h6 class="card-title card-title-sm caps">Account Information</h6>
                <span class="text-sm cl1"><em class="fa fa-check-circle text-success"></em> You are currently logged in
                    as <span class="text-success">{{ auth::user()->email }}</span>
                    <a class="cl1 ml-4" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                        {{ __('Log out') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </span>
            </div>
            <!-- .card -->
        </div>
        <!-- .col -->
        <div class="aside sidebar-right col-lg-4">
            {{-- <div class="bottom-course"> --}}
            <span class="get mb-4">Here's what you'll get...</span>
            <ul class="list-check mt-3">
                <li>Pattens of proven performance on how To Create A Highly Profitable Wealth Machine & Income Streams.</li>
                <li>How to structure your personal finances.</li>
                <li>How to become financially independent.</li>
                <li>How to build an Amazing Lifestyle.</li>
                <li>10X Powerful income streams.</li>
                <li>How to invest your wealth.</li>
            </ul>

            {{-- </div>z --}}
        </div>
        <!-- .col -->
    </div>
    <!-- .container -->
</div>

@endsection

@section('script')
<script>
    $('#cat').on('change', function() {
         let x =   $( "#cat option:selected" ).val();
         document.getElementById("course-value").innerHTML = '$'+x;
         document.getElementById("cat-amount").value = x;
        });
</script>

@endsection
