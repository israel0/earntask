<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paulano Grace</title>
    <link rel="shortcut icon" href="{{ asset("landing/images/logo.png") }}") }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset("landing/style.css") }}" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="{{ asset("landing/jquery.paroller.min.js") }}"></script>
    <script src="{{ asset("landing/jquery-3.1.1.min.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <header class="sticky top-0 z-10">
      <div
        class="flex flex-col lg:flex-row items-center justify-between w-full px-6 lg:px-20 py-2 max-w-[1480px] mx-auto bg-black shadow-md"
      >
        <div class="flex items-center justify-between w-full lg:w-[15%]">
          <a href="{{ route("landing") }}" class="flex items-center">
            <img
              class="w-[100px] lg:w-[120px]"
              src="{{ asset("landing/images/logo.png") }}") }}"
              alt="logo"
            />
          </a>
          <div class="switch lg:hidden">
            <input type="checkbox" id="checkbox" />
            <label for="checkbox" class="toggle">
              <div class="bars" id="bar1"></div>
              <div class="bars" id="bar2"></div>
              <div class="bars" id="bar3"></div>
            </label>
          </div>
        </div>

        <div>
          <ul
            class="menu text-[#fefae0] font-semibold capitalize hidden w-full lg:flex items-center text-sm gap-8"
          >
            <li>
              <a href="{{ route("landing") }}">home</a>
            </li>
            <li>
              <a href="{{ route("about") }}">about us</a>
            </li>
            <li>
              <a href="{{ route("plan")}}">compensation plan</a>
            </li>
            <li>
              <a href="{{ route("invest")}}">invest</a>
            </li>
            <li>
              <a href="{{ route("help")}}">contact us</a>
            </li>
            <div class="flex items-center gap-4">
              <a href="{{ route("login") }}">
                <button class="button">Sign in</button>
              </a>
              <a href="{{ route("register") }}">
                <button class="button2">Create account</button>
              </a>
            </div>
          </ul>
          <ul
            id="mobile_menu"
            class="mobile hidden text-gray-200 font-semibold capitalize flex lg:hidden flex-col items-center justify-center gap- text-base py-[1rem] w-[80vw] h-[100svh] animate__animated animate__slideInRight"
          >
            <li>
              <a href="{{ route("landing") }}">home</a>
            </li>
            <li>
              <a href="{{ route("about") }}">about us</a>
            </li>
            <li>
              <a href="{{ route("plan") }}">compensation plan</a>
            </li>
            <li>
              <a href="{{ route("invest") }}">invest</a>
            </li>
            <li>
              <a href="{{ route("help") }}">contact us</a>
            </li>
            <div class="flex flex-col items-center gap-6 w-full">
              <a href="{{ route("login") }}">
                <button class="button w-[60vw] lg:w-[0]">Sign in</button>
              </a>
              <a href="{{ route("register") }}">
                <button class="button2 w-[60vw] lg:w-[0]">
                  Create account
                </button>
              </a>
            </div>
          </ul>
        </div>
      </div>
    </header>

      @yield("content")

    <footer>
      <div class="bg-black px-6 lg:px-10 py-[4rem] max-w-[1480px] mx-auto">
        <div
          class="flex flex-col lg:flex-row lg:justify-between gap-8 lg:gap-0 flex-wrap"
        >
          <a href={{ route("landing") }}">
            <img
              class="w-[150px] lg:w-[180px]"
              src="{{ asset("landing/images/logo.png") }}"
              alt="logo"
            />
          </a>

          <div class="flex flex-col gap-4">
            <h1 class="uppercase text-[#fc8400] text-md font-bold">Company</h1>
            <ul class="capitalize flex flex-col gap-2 text-sm text-[#fefae0]">
              <li>
                <a href="{{ route("about") }}">about</a>
              </li>
              <li>
                <a href="{{ route("help") }}" target="_blank">contact us</a>
              </li>
              <li>
                <a href="https://eu.docworkspace.com/d/sINr3pIhn9cXMrAY" target="_blank">policy</a>
              </li>
            </ul>
          </div>

          <div class="flex flex-col gap-4">
            <h1 class="uppercase text-[#fc8400] text-md font-bold">
              Quick links
            </h1>
            <ul class="capitalize flex flex-col gap-2 text-sm text-[#fefae0]">
              <li>
                <a href="{{ route("plan") }}">compensation plan</a>
              </li>
              <li>
                <a href="{{ route("invest") }}">Invest in paulano graceland</a>
              </li>
              <li>
                <a href="{{ route("login") }}">login to dashboard</a>
              </li>
              <li>
                <a href="{{ route("register") }}">register now</a>
              </li>
            </ul>
          </div>

          <div class="flex flex-col gap-4">
            <h1 class="uppercase text-[#fc8400] text-md font-bold">
              Contact us
            </h1>
            <ul class="capitalize flex flex-col gap-2 text-sm text-[#fefae0]">
              <li>
                <a href="mailto:support@paulano.com">support@paulano.com</a>
              </li>
              <li>
                <a href="tel:+2348064791719">+234 80 6479 1719</a>
              </li>
              <li>
                <address>24 Ekololu, Surulere Lagos State</address>
              </li>
            </ul>
          </div>

          <div class="flex flex-col gap-4">
            <h1 class="uppercase text-[#fc8400] text-md font-bold">
              Social media
            </h1>
            <ul class="capitalize flex flex-col gap-2 text-sm text-[#fefae0]">
              <li>
                <a
                  href="https://www.instagram.com/everything_pgland/"
                  target="_blank"
                >
                  <i class="bi bi-instagram"></i>
                  <span>Instagram</span>
                </a>
              </li>
              <li>
                <a
                  href="https://wa.me/2348066780133"
                  target="_blank"
                >
                  <i class="bi bi-whatsapp"></i>
                  <span>+234 80 6678 0133</span>
                </a>
                <li>
                  <a
                    href="https://wa.me/2349151601046"
                    target="_blank"
                  >
                    <i class="bi bi-whatsapp"></i>
                    <span>+234 91 5160 1046</span>
                  </a>
                </li>
              </li>
              <li>
                <a
                  href="https://www.facebook.com/profile.php?id=61554287084432"
                  target="_blank"
                >
                  <i class="bi bi-facebook"></i>
                  <span>Facebook</span>
                </a>
              </li>
            </ul>
          </div>

          <div class="flex flex-col gap-4 text-[#fefae0] max-w-[400px]">
            <h1 class="uppercase text-[#fc8400] text-md font-bold">
              NewsLetter
            </h1>
            <span class=""
              >Subscribe to our newsletter to get all our news in your
              inbox.</span
            >
            <div class="input-group">
              <input
                type="email"
                class="input"
                id="Email"
                name="Email"
                placeholder="name@email.com"
                autocomplete="off"
              />
              <button class="bg-[#fc8400] p-3 rounded-r-xl">
                Subscribe
              </button>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="{{ asset("landing/app.js") }}"></script>
    <script>
      const swiper = new Swiper(".swiper", {
        // Optional parameters
        direction: "horizontal",
        loop: true,
        autoplay: {
          delay: 3000,
        },

        // If we need pagination
        pagination: {
          el: ".swiper-pagination",
        },

        // Navigation arrows
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },

        // And if we need scrollbar
        scrollbar: {
          el: ".swiper-scrollbar",
        },
      });

      const planArray = [
        {
          id: 1,
          name: "Bronze plan",
          amount: 15000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn over N300,000 in level",
            "Stage and stepout bonuses in this 2 by 2 matrix",
          ],
        },
        {
          id: 2,
          name: "Silver plan",
          amount: 25000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn over N800,000 in level",
            "Stage and stepout bonuses in this 2 by 2 matrix",
          ],
        },
        {
          id: 3,
          name: "Gold plan",
          amount: 50000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn over N1,200,000 in level",
            "Stage and stepout bonuses in this 2 by 2 matrix",
          ],
        },
        {
          id: 4,
          name: "Platinum plan",
          amount: 100000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn over N500,000,000 in level",
            "Stage and stepout bonuses in this 2 by 2 matrix",
          ],
        },
        {
          id: 5,
          name: "VIP plan",
          amount: 200000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn amazing cash bonuses plus a car worth 8 million naira",
            "5 months allowance worth N200,000 monthly",
          ],
        },
        {
          id: 6,
          name: "VIP 2 plan",
          amount: 500000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn amazing cash bonuses plus a Jeep worth 10 million naira",
            "10 months allowance worth N200,000 monthly",
          ],
        },
        {
          id: 7,
          name: "VIP 3 plan",
          amount: 1000000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn amazing cash bonuses plus a car worth 15 million naira",
            "Cash support of N2 Million naira",
          ],
        },
        {
          id: 8,
          name: "VIP 4 plan",
          amount: 2000000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn amazing cash bonuses plus a car worth 25 million naira",
            "Cash support of N5 Million naira",
          ],
        },
      ];

      const myplanContainer = document.getElementById("myplan");
      const myplanHTML = planArray
        .map(
          (obj) => `
    <div class="cards__inner">
    <div class="cards__card card">
      <p class="card__heading">${obj.name}</p>
      <p class="card__price">${new Intl.NumberFormat("en-NG", {
        style: "currency",
        currency: "NGN",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
      }).format(obj.amount)}</p>
      <ul class="card_bullets flow" role="list">
        ${obj.lists
          .map(
            (list) => `<li class="capitalize">${list}</li>
          `
          )
          .join("")}
      </ul>
      <a class="card__cta cta" href="{{ route("register") }}">Get Started</a>
    </div>
    <div class="overlay cards__inner"></div>
  </div>
`
        )
        .join("");

      myplanContainer.innerHTML = myplanHTML;
    </script>
  </body>
</html>
