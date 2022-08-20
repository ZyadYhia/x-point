@extends('web.layout')
@section('title')
Contact
@endsection
@section('main')
    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- contact form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        <h4>Send A Message</h4>
                        <form>
                            <input class="input" type="text" name="name" placeholder="Name">
                            <input class="input" type="email" name="email" placeholder="Email">
                            <input class="input" type="text" name="subject" placeholder="Subject">
                            <textarea class="input" name="message" placeholder="Enter your Message"></textarea>
                            <button class="main-button icon-button pull-right">Send Message</button>
                        </form>
                    </div>
                </div>
                <!-- /contact form -->

                <!-- contact information -->
                <div class="col-md-5 col-md-offset-1">
                    <h4>Contact Information</h4>
                    <ul class="contact-details">
                        <li><i class="fa fa-envelope"></i>{{ $contact->email }}</li>
                        <li><i class="fa fa-phone"></i>{{ $contact->mobile }}</li>
                    </ul>

                </div>
                <!-- contact information -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
