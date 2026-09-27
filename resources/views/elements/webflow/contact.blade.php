<section class="relative">
    <div class="container mx-auto">
      <div class="grid items-start justify-start gap-8 md:grid-cols-2 md:gap-16">
        <div class="flex flex-col gap-4 md:gap-8">
          <div class="flex items-center justify-start gap-8">
              <div class="*:w-12 *:h-auto">
                  @include('elements.icon.discussion-question')
              </div>
              <h2>Vous avez un projet ou souhaitez en savoir plus ?</h2>
          </div>
          <p>Envoyez-moi un message grâce à ce formulaire et je vous répondrai dans les plus brefs délais.</p>
        </div>
        <div>
          <x-contact-form />
        </div>
      </div>
    </div>
  </section>
