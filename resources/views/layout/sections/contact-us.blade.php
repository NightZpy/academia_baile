<section id="contact-us" class="ct-u-paddingTop60 section section_9" style="position: relative; float: none;">
    <div class="ct-u-sectionHeader text-center ct-u-paddingBottom20">
        <h2 class="ct-sectionTitle text-capitalize">Get In Touch <span class="ct-fw-300">with us</span></h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5 class="ct-titleBox text-uppercase">Contact Us</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <p class="ct-u-paddingTop30 ct-u-size16">We promise to get back to you in 48h or even less:</p>
                <form role="form" action="send-message" method="post" class="ct-u-paddingBottom80 contactForm validateIt" data-email-subject="Contact Form" data-show-errors="true">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="successMessage alert alert-success ct-u-marginTop30" style="display: none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Thank You!
                    </div>
                    <div class="errorMessage alert alert-danger ct-u-marginTop30" style="display: none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Ups! An error occured. Please try again later.
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="field[name]" placeholder="Your Name" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="email" class="form-control" name="field[email]" placeholder="Your Email" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="7" name="field[message]" placeholder="Your Message" required="required"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary btn-lg ct-u-marginTop30">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <div class="ct-googleMap ct-googlemapStyle ct-u-marginBoth50" data-location="Manhattan, NY 56789" data-height="445" data-zoom="2" data-snap-ignore="true" style="min-height: 445px; position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
            </div>
        </div>
    </div>
</section>