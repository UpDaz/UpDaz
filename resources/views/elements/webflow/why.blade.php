<section id="opquast" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col-reverse gap-16 sm:gap-0 sm:flex-row ">
            <div
                class="flex flex-col items-start justify-start gap-8 border-gray sm:w-3/4 sm:pr-8 sm:py-8 md:pr-16 md:py-16 sm:border-r sm:border-t-0 sm:text-left">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <h2 class="text-3xl sm:text-4xl">
                        Pourquoi choisir Webflow ?
                    </h2>
                    <div class="w-24 sm:w-12">
                        @include('elements.icon.check-list')
                    </div>
                </div>
                <p class="leading-relaxed text-md">
                    Webflow simplifie la création de sites professionnels sans compétences techniques. Son interface
                    visuelle intuitive permet de concevoir des designs sur mesure, tout en profitant de performances
                    dignes des meilleurs CMS.
                </p>
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <h2 class="text-3xl sm:text-4xl">
                        Pour quels types de sites ?
                    </h2>
                    <div class="w-24 sm:w-12">
                        @include('elements.icon.www')
                    </div>
                </div>
                <p class="leading-relaxed text-md">
                    Webflow s’adapte à vos besoins :<br/>
                    <ul>
                        <li><b>Landing page / Site vitrine</b> → Idéal pour présenter un service ou un produit</li>
                        <li><b>Site CMS</b> → Gérez vos contenus dynamiquement (articles, actualités…)</li>
                        <li><b>E-commerce</b> → Vendez en ligne simplement</li>
                    </ul>
                </p>
            </div>
            <div class="max-w-full sm:pl-8 lg:px-12 md:w-1/4 sm:pt-8 md:pt-16">
                <div class="sticky sm:top-24">
                    <div class="relative mx-8 md:mx-0">
                        <img src="{{ asset('img/logos/webflow.svg') }}" class="w-full bg-white" alt="Logo Webflow">
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 top-0 bg-gradient-to-r  ">
                        </div>
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 bottom-0 bg-gradient-to-r  ">
                        </div>
                        <div data-element="line-vertical"
                            class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 left-0 bg-gradient-to-b  ">
                        </div>
                        <div data-element="line-vertical"
                            class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 right-0 bg-gradient-to-b  ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
