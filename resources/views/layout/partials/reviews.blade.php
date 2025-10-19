@if(count($customerReviews))
    <div class="achievement-area p-80 mt-50">
        <div class="container">
            <div class="row" style="margin-bottom: 25px">
                <div class="col-lg-12">
                    <div class="section_heading_seven">
                        <h2>{{nova_get_setting_translate('customer_reviews_title')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($customerReviews as $customerReview)
                    <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft  animated" data-wow-duration="1500ms"
                         data-wow-delay="0ms"
                         style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                        <iframe width="100%" height="315" src="{{$customerReview->video}}" title="{{ env('APP_NAME') }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                        </iframe>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
