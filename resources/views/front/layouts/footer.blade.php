<footer class="footer-section section bg-image" data-bg="{{ asset('front/assets/images/bg/footer-bg.jpg')}}">

    <!--Footer Top start-->
    <div class="footer-top section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-85 pb-lg-65 pb-md-60 pb-sm-50 pb-xs-40">
        <div class="container">
            <div class="row">

                <!--Footer Widget start-->
                <div class="footer-widget col-lg-4 col-md-6 col-sm-6 col-12 mb-30">
                    <div class="footer-logo align-items-center d-flex">
                        <a href="/"><img class="front-footer-logo" src="{{getLogoUrl()}}" alt=""></a>
                        <h4 class="text-white">{{ getAppName() }}</h4>
                    </div>
                    <p> Our mission is to provide the best renovation service at an reasonable price without sacrificing quality. You will be satisfy with our work knowing we take the necessary steps to meet your needs and get the job done right</p>
                </div>
                <!--Footer Widget end-->

                <!--Footer Widget start-->
                <div class="footer-widget col-lg-4 col-md-6 col-sm-6 col-12 mb-30">
                    <h4 class="title"><span class="text">{{ getAppName() }} Office</span></h4>
                    <ul>
                        <li><i class="fa fa-map-marker"></i><span>{{ getAddress() }},{{ getCity() }}, {{ getState() }},{{ getCountry() }}.</span></li>
                        <li><i class="fa fa-phone"></i><span><a href="#"> {{ getPhone() }}</a></span></li>
                        <li><i class="fa fa-envelope-o"></i><span><a href="#">{{ getEmail() }}</a></span></li>
                        <li><i class="fa fa-clock-o"></i><span><a href="#"> Mon - Sat: 9:00AM - 9:00PM</a></span></li>
                    </ul>
                </div>
                <!--Footer Widget end-->
            </div>
        </div>
    </div>
    <!--Footer Top end-->

    <!--Footer bottom start-->
    <div class="footer-bottom section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright text-center">
                        <p>Copyright &copy;2023 <a href="/">{{getAppName()}}.</a> Made with <i class="fa fa-heart"></i> by Amish Yadav.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer bottom end-->

</footer>
