<div class="faq-section padtobo-40" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center ">
                <div class="col-12">
                    <span class="section-title-span">
                        {{ nova_get_setting_translate('faq_section_label') }}
                    </span>
                    <h2>
                        {{ nova_get_setting_translate('faq_section_title') }}
                    </h2>
                    <p>
                        {!! nova_get_setting_translate('faq_section_description') !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-9 col-lg-9">
                <div class="faq-one__content-box" itemscope itemtype="https://schema.org/FAQPage">
                    <div class="accrodion-grp" data-grp-name="faq-one-accrodion">
                        @foreach (isset($faqs) && count($faqs) > 0 ? $faqs : $generalFAQs as $item)
                            <!-- السؤال الأول -->
                            <div class="accrodion {{ $loop->first ? 'active' : '' }}" itemscope itemprop="mainEntity"
                                itemtype="https://schema.org/Question">
                                <div class="accrodion-title">
                                    <h4 itemprop="name">
                                        {{ $item['question'] }}
                                    </h4>
                                </div>
                                <div class="accrodion-content" itemscope itemprop="acceptedAnswer"
                                    itemtype="https://schema.org/Answer">
                                    <div class="inner">
                                        <p itemprop="text">
                                            {!! $item['answer'] !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>

            <div class="col-lg-3">
                <div class="side-blogs d-flex gap-3 flex-column align-items-stretch h-100">
                    <!-- Info Card 1 -->
                    @foreach (nova_get_setting('faq_service_items') as $item)
                        {{-- @php
                            dd($item);
                        @endphp --}}
                        <div class="card border-0  rounded-4 flex-fill faq-service-item">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 text-primary fs-4">
                                    {!! $item['icon'] !!}
                                </div>
                                <div class="side-blog-content">
                                    <h5 class="mb-1 fw-semibold">
                                        {{ $item['title'][LaravelLocalization::getCurrentLocale()] }}
                                    </h5>
                                    <p>
                                        {{ $item['description'][LaravelLocalization::getCurrentLocale()] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@section('schema')

<script type="application/ld+json">
    {!! $jsonLd !!}
</script> 
@endsection
