@include('home.partials.book_amazing_section')

@if (isset($faqs) && count($faqs) > 0 || isset($generalFAQs) && count($generalFAQs) > 0)
<div class="faq-section mt-5 " style="background-image: url(assets/images/travel-bg.jpg);background-color: #e4e4e4;">
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
            <div class="col-xl-8 col-lg-8">
                <div class="faq-one__content-box" itemscope itemtype="https://schema.org/FAQPage">
                    <div class="accrodion-grp" data-grp-name="faq-one-accrodion">
                        @foreach (isset($faqs) && count($faqs) > 0 ? $faqs : $generalFAQs as $item)
                            <div class="accrodion active" itemscope itemprop="mainEntity"
                                itemtype="https://schema.org/Question">
                                <div class="accrodion-title">
                                    <h4 itemprop="name">
                                        {{ $item->question }}
                                    </h4>
                                </div>
                                <div class="accrodion-content" itemscope itemprop="acceptedAnswer"
                                    itemtype="https://schema.org/Answer">
                                    <div class="inner">
                                        <p itemprop="text">
                                            {!! $item->answer !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="btn_bottom">
                        <div class="tailor-made d-flex justify-content-between align-items-center mt-3 gap-4">
                            <span class="line"></span>

                            <button class="theme-btn show-toggle"> {{ __('home.show_more') }} </button>
                            <button class="theme-btn show-toggle"> {{ __('home.show_less') }} </button>

                            <span class="line"></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="sidebar ">
                    <div class=" sidebar-content ">
                        <div class="sidebar-heading">
                            <p>
                                {{ __('home.have_a_question') }}
                            </p>
                            <p>
                                {{ __('home.contact_us') }}
                            </p>
                        </div>
                        <div class="tour-details-package-content">
                            @include('layout.partials.form_let_countact')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(isset($faqs) && count($faqs) > 0)
@section('schema')
    <script type="application/ld+json">
    {!! $jsonLd !!}
</script>
@endsection
@endif
@section('extraScriptsFaq')
    <script>
        const desc = document.querySelector('.descc');
        const btn = document.querySelector('.showMore-Btn');

        btn.addEventListener('click', () => {
            desc.classList.toggle('expanded');
            btn.textContent = desc.classList.contains('expanded') ? {{ __('home.showLess') }} : {{ __('home.showMore') }};
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.faq-one__content-box').forEach(box => {
                const accrodions = Array.from(box.querySelectorAll('.accrodion'));
                if (!accrodions.length) return;

                const initialCount = 4;
                const moreCount = 5;
                let visibleCount = initialCount;

                const parentBox = box.closest('.tailor-made') || document;
                const btnMore = parentBox.querySelector('.show-toggle:nth-of-type(1)');
                const btnLess = parentBox.querySelector('.show-toggle:nth-of-type(2)');

                btnMore.style.display = 'inline-block';
                btnLess.style.display = 'none';

                function update() {
                    accrodions.forEach((el, idx) => {
                        if (idx < visibleCount) {
                            el.classList.remove('js-hidden');
                        } else {
                            el.classList.add('js-hidden');
                        }
                    });

                    if (visibleCount >= accrodions.length) {
                        btnMore.style.display = 'none';
                        btnLess.style.display = 'inline-block';
                    } else if (visibleCount <= initialCount) {
                        btnMore.style.display = 'inline-block';
                        btnLess.style.display = 'none';
                    } else {
                        btnMore.style.display = 'inline-block';
                        btnLess.style.display = 'inline-block';
                    }
                }

                btnMore.addEventListener('click', function() {
                    visibleCount = Math.min(accrodions.length, visibleCount + moreCount);
                    update();
                });
                btnLess.addEventListener('click', function() {
                    visibleCount = Math.max(initialCount, visibleCount - moreCount);
                    box.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    update();
                });

                update();
            });
        });
    </script>
@endsection
