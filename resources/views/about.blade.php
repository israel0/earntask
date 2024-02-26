@extends("layouts.landing_overview")

@section('content')
{{-- content --}}

    <!-- Repalced this too:jan02 -->
    <section class="pattern">
        <div
          class="grid grid-cols-1 lg:grid-cols-2 place-content-center gap-6 px-6 lg:px-20 py-[5rem] max-w-[1520px] mx-auto animate__animated animate__zoomIn"
        >
          <div class="flex flex-col gap-5 justify-center">
            <div class="flex flex-col gap-4">
              <h1
                class="text-xl lg:text-2xl text-[#fc8400] font-semibold uppercase"
              >
                Who we are?
              </h1>
              <h2 class="text-2xl lg:text-4xl font-extrabold text-[#283618]">
                Paulano Graceland — Built to Make a Difference
              </h2>
              <p class="text-gray-500 text-base lg:text-md leading-8">
                Paulano Graceland epitomizes a forward-thinking approach, blending
                African tourism, fashion, and real estate within a dynamic MLM
                venture.
              </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
              <div class="flex flex-col gap-3">
                <span class="p-3 bg-[#fc8400] font-extrabold text-white w-fit"
                  >01</span
                >
                <h2 class="text-2xl lg:text-4xl font-extrabold text-[#283618]">
                  Mission
                </h2>
                <p class="text-gray-500 text-base lg:text-md">
                  Empowering individuals while proudly preserving Africa's
                  cultural heritage across tourism, products, and heritage.
                </p>
              </div>
              <div class="flex flex-col gap-3">
                <span class="p-3 bg-[#fc8400] font-extrabold text-white w-fit"
                  >02</span
                >
                <h2 class="text-2xl lg:text-4xl font-extrabold text-[#283618]">
                  Vision
                </h2>
                <p class="text-gray-500 text-base lg:text-md">
                  Lead Africa's MLM realm by weaving consumers into the fabric of
                  authentic African experiences, fashion, and real estate ventures
                </p>
              </div>
              <div class="flex flex-col gap-3">
                <span class="p-3 bg-[#fc8400] font-extrabold text-white w-fit"
                  >03</span
                >
                <h2 class="text-2xl lg:text-4xl font-extrabold text-[#283618]">
                  Satisfaction
                </h2>
                <p class="text-gray-500 text-base lg:text-md">
                  100% customer satisfaction guaranteed
                </p>
              </div>
              <div class="flex flex-col gap-3">
                <span class="p-3 bg-[#fc8400] font-extrabold text-white w-fit"
                  >04</span
                >
                <h2 class="text-2xl lg:text-4xl font-extrabold text-[#283618]">
                  Approach
                </h2>
                <p class="text-gray-500 text-base lg:text-md">
                  Dynamic MLM venture
                </p>
              </div>
            </div>
          </div>
          <!-- Replaced the imgage with a gallery section:JAN02 -->
          <div class="h-full flex items-center justify-center">
            <img src="{{  asset("landing/images/img-mockup-export.png") }}" alt="mockup" class="lg:h-[80%]">
          </div>
        </div>
      </section>


      <section class="pattern">
        <div class="flex flex-col px-6 lg:px-20 pb-[8rem] gap-10 max-w-[1520px] mx-auto">
          <div class="flex flex-col lg:flex-row items-center w-full">
            <div class="basis-1/2 flex items-center justify-center">
              <img
                class="rounded-2xl hover:scale-105 duration-500 object-contain h-[400px]"
                src="{{  asset("landing/images/Authentic Kente 6 Yards Genuine Ghana Handwoven Kente Fabric and Kente Cloth African Fabric Af (3).jpg") }}"
                alt="cloth1"
              />
            </div>
            <div class="w-full basis-1/2 flex justify-center items-center mt-4 lg:mt-0">
              <p class="text-base lg:text-md text-gray-500 leading-8 lg:w-[70%]">
                At Paulano Graceland , we are passionate about textiles and
                fashion. As a leading fabric retail firm, we offer high-quality
                fabrics that are perfect for any project, whether you're a fashion
                designer, an interior decorator, or a DIY enthusiast.
              </p>
            </div>
          </div>
          <div class="flex flex-col lg:flex-row-reverse items-center">
            <div class="basis-1/2 flex items-center justify-center">
              <img
                class="rounded-2xl hover:scale-105 duration-500 object-contain h-[400px]"
                src="{{  asset("landing/images/Authentic Kente 2,4,6 & 12 yards Genuine Ghana handwoven Kente fabric and Kente Cloth African .jpg") }}"
                alt="cloth2"
              />
            </div>
            <div class="w-full basis-1/2 flex justify-center items-center mt-4 lg:mt-0">
              <p class="text-base lg:text-md text-gray-500 leading-8 lg:w-[70%]">
                Our team has a keen eye for design and a deep understanding of
                fashion trends, ensuring that we offer only the most stylish and
                on-trend fabrics. We have established strong relationships with
                reputable suppliers, allowing us to offer a wide range of fabrics
                in a variety of colors, textures, and patterns.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="pattern">
        <div
          class="w-full flex items-center justify-center px-6 lg:px-20 py-[5rem] lg:py-[10rem] max-w-[1520px] mx-auto"
        >
          <div class="basis-1/4 hidden lg:flex justify-center">
            <img src="{{  asset("landing/images/svgelement.svg") }}" alt="" />
          </div>
          <div
            class="lg:basis-1/2 flex flex-col gap-8 items-center text-center lg:w-[80%]"
          >
            <h1 class="text-2xl lg:text-4xl text-[#283618] font-extrabold">
              Join us Today!
            </h1>
            <p class="text-base lg:text-md text-gray-500">
              Join us in this transformative journey as we revolutionize Africa's
              MLM landscape while empowering local talent and preserving the
              continent's cultural richness. We look forward to discussing this
              exciting investment opportunity further.
            </p>
            <!-- replaced this button with a link tag -->
            <a
              href="plan.html"
              class="px-[10rem] py-4 bg-[#fc8400] hover:bg-[#fdaa4f] text-[#fefae0] text-base lg:text-md font-bold rounded-full"
            >
              Join us
            </a>
          </div>
          <div class="basis-1/4 hidden lg:flex justify-center">
            <img src="{{  asset("landing/images/svgelement2.svg") }}" alt="" />
          </div>
        </div>
      </section>

@endsection
