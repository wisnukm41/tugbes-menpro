@extends('layouts.user')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
            <li class="item-link"><span>Contact us</span></li>
        </ul>
    </div>
    <div class="row">
        <div class=" main-content-area">
            <div class="wrap-contacts ">
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-box contact-form">
                        <h2 class="box-title">Leave a Message</h2>
                        <form action="{{route('user-storeMessages')}}" method="post" name="frm-contact">
                            @csrf
                            <label for="name">Name<span>*</span></label>
                            <input type="text" id="name" name="name" required>

                            <label for="email">Email<span>*</span></label>
                            <input type="email" id="email" name="email" required>

                            <label for="phone">Number Phone</label>
                            <input type="text" id="phone" name="contact" >

                            <label for="title">Subject<span>*</span></label>
                            <input type="text" id="title" name="title" required>

                            <label for="comment">Comment<span>*</span></label>
                            <textarea name="description" id="comment" required></textarea>

                            <input type="submit" value="Submit" >
                            
                        </form>
                    </div>
                </div>
            </div>
        </div><!--end main products area-->

    </div><!--end row-->
@endsection