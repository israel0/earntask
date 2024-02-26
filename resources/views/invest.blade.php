@extends("layouts.landing_overview")

@section('content')
   {{-- content --}}

   <main>
    <div class="flex items-center h-[50vh] lg:h-[70svh] bg-[url('{{ ("landing/images/slider2.jpg") }}')] bg-cover bg-center bg-no-repeat max-w-[1480px] mx-auto animate__animated animate__slideInLeft"
    >
      <div class="w-full text-white px-3 lg:px-10">
        <h1 class="text-3xl lg:text-4xl font-extrabold mb-4">
          Forging a <span class="text-[#fc8400]">Pan African</span> Future
        </h1>
        <p class="text-md lg:text-xl lg:w-[40%] text-[#fefae0]">
          We are excited to present a unique and promising investment
          opportunity with Paulano Graceland, a visionary enterprise
          positioned to transform Africa's multi-level marketing landscape.
        </p>
        <a href="register.html" class="contactButton mt-10 text-base lg:text-xl">
          Get started
          <div class="iconButton">
            <svg
              height="24"
              width="24"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M0 0h24v24H0z" fill="none"></path>
              <path
                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                fill="currentColor"
              ></path>
            </svg>
          </div>
        </a>
      </div>
    </div>
  </main>

  <section>
    <div
      class="flex flex-col items-center justify-center text-center gap-6 min-h-screen px-3 py-[4rem] w-full pattern max-w-[1480px] mx-auto"
    >
      <h1 class="text-2xl lg:text-4xl font-extrabold text-[#283618]">
        Business Concept
      </h1>
      <p
        class="text-gray-500 text-base lg:text-md lg:w-[70%] leading-8"
      >
        Paulano Graceland epitomizes a forward-thinking approach, blending
        African tourism, fashion, and real estate within a dynamic MLM
        venture. Our mission extends beyond product sales; we aim to empower
        local artisans and showcase Africa's richness through cultural
        empowerment.ashion designer, an interior decorator, or a DIY
        enthusiast.
      </p>

      <div class="flex flex-col gap-8 px-0 lg:px-10 py-[4rem] lg:py-[8rem]">
        <div class="flex flex-col gap-6 lg:gap-0 lg:flex-row items-center w-full">
          <div class="basis-1/2 flex items-center justify-center">
            <img
              class="rounded-2xl hover:scale-95 duration-500 object-cover h-[400px] w-[500px]"
              src="{{ asset("landing/images/A Detour to the MarketSteemit.jpg") }}"
              alt=""
            />
          </div>
          <div
            class="w-full basis-1/2 flex flex-col gap-3 justify-center items-center"
          >
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#283618]">
              Business Model
            </h1>
            <p class="text-base lg:text-md text-gray-500 leading-8">
              Our robust binary compensation plan empowers distributors,
              rewarding their sales prowess. Our offerings encompass curated
              tourism plans, cutting-edge e-commerce showcasing African
              fashion, exclusive real estate ventures, and an array of
              indigenous products.
            </p>
          </div>
        </div>
        <div class="flex flex-col gap-6 lg:gap-0 lg:flex-row-reverse items-center">
          <div class="basis-1/2 flex items-center justify-center">
            <img
              class="rounded-2xl hover:scale-95 duration-500 object-cover h-[400px] w-[500px]"
              src="{{ asset("landing/images/Authentic Kente 2,4,6 & 12 yards Genuine Ghana handwoven Kente fabric and Kente Cloth African .jpg") }}"
              alt=""
            />
          </div>
          <div
            class="w-full basis-1/2 flex flex-col gap-3 justify-center items-center"
          >
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#283618]">
              Vision and Mission
            </h1>
            <p class="text-base lg:text-md text-gray-500 leading-8 wd-[70%]">
              Our audacious vision is to lead Africa's MLM realm by weaving
              consumers into the fabric of authentic African experiences,
              fashion, and real estate ventures. Our mission revolves around
              empowering individuals while proudly preserving Africa's
              cultural heritage across tourism, products, and heritage.s.
            </p>
          </div>
        </div>
        <div class="flex flex-col gap-6 lg:gap-0 lg:flex-row items-center w-full">
          <div class="basis-1/2 flex items-center justify-center">
            <img
              class="rounded-2xl hover:scale-95 duration-500 object-cover h-[400px] w-[500px]"
              src="{{ asset("landing/images/African Fabric Retailer,Wholesaler and Manufacturer from New YorkOnline Fabric Store (1).jpg") }}"
              alt=""
            />
          </div>
          <div
            class="w-full basis-1/2 flex flex-col gap-3 justify-center items-center"
          >
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#283618]">
              Team
            </h1>
            <p class="text-base lg:text-md text-gray-500 leading-8 wd-[70%]">
              Paulano Graceland is led by a visionary leadership team
              overseeing operations, marketing, finance, sales, technology,
              and customer support. Our functional teams ensure the seamless
              execution of our vision.
            </p>
          </div>
        </div>
        <div class="flex flex-col gap-6 lg:gap-0 lg:flex-row-reverse items-center">
          <div class="basis-1/2 flex items-center justify-center">
            <img
              class="rounded-2xl hover:scale-95 duration-500 object-cover h-[400px] w-[500px]"
              src="{{ asset("landing/images/Fancy African Fabric by the Yard, Metallic Kente Ankara Print, Dressmaking, Cotton Quilting, S.jpg") }}"
              alt="image4"
            />
          </div>
          <div
            class="w-full basis-1/2 flex flex-col gap-3 justify-center items-center"
          >
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#283618]">
              Go-to-market Strategy
            </h1>
            <p class="text-base lg:text-base text-gray-500 leading-8 wd-[70%]">
              Our strategy includes a robust online presence, leveraging
              social media, content marketing, and strategic partnerships with
              influencers. We're also actively engaging in referralships and
              event participation.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div
      class="w-full flex items-center justify-center px-3 lg:px-10 pb-[5rem] lg:pb-[10rem] pattern max-w-[1480px] mx-auto"
    >
      <div class="basis-1/4 hidden lg:flex justify-center">
        <img src="{{ asset("landing/images/svgelement.svg") }}" alt="" />
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
        <a
          href="register.html"
          class="px-[10rem] py-4 bg-[#fc8400] hover:bg-[#fdaa4f] text-[#fefae0] text-sm lg:text-md font-bold rounded-full"
        >
          Join us
        </a>
      </div>
      <div class="basis-1/4 hidden lg:flex justify-center">
        <img src="{{ asset("landing/images/svgelement2.svg") }}" alt="" />
      </div>
    </div>
  </section>

@endsection
