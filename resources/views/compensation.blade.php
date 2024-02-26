<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Compensation plans</title>
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
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <header class="sticky top-0 z-10 bg-black">
      <div
        class="flex flex-col lg:flex-row items-center justify-between w-full px-6 lg:px-20 py-2 max-w-[1520px] mx-auto shadow-md"
      >
        <div class="flex items-center justify-between w-full lg:w-[15%]">
          <a href="{{ route("landing") }}" class="flex items-center">
            <img
              class="w-[100px] lg:w-[120px]"
              src="{{ asset("landing/images/logo.png") }}"
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
              <a href="{{ route("plan") }}">compensation plan</a>
            </li>
            <li>
              <a href="{{ route("invest") }}">invest</a>
            </li>
            <li>
              <a href="{{ route("help") }}">contact us</a>
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
    <!-- The Modal -->
    <div id="modal" class="w-[90%] lg:w-[30%]">
      <span class="close" onclick="closeModal()">&times;</span>
      <!-- <h2 id="modalTitle"></h2>
      <p id="modalContent"></p> -->
      <div class="text-center flex flex-col items-center justify-center p-4">
        <div>
          <h1 id="modalplan" class="text-xl lg:text-2xl font-semibold mb-2 text-[#fc8400]"></h1>
          <span id="modalPrice" class="text-base lg:text-md font-semibold"></span>
        </div>
        <div class="grid grid-cols-2 gap-5 mt-3">
          <div
            class="p-2 text-center flex flex-col items-center justify-center"
          >
            <span class="text-md lg:text-xl font-semibold text-[#283618]">Feeder</span>
            <img
              loading="lazy"
              src="{{ asset("landing/images/matrix.png") }}"
              alt=""
              class="object-contain object-center"
            />
            <div class="flex flex-col capitalize">
              <p class="text-sm font-semibold text-gray-800">step out bonus = <span id="feeder_one"></span></p>
              <p class="text-sm font-semibold text-gray-800">stage bonus = <span id="feeder_two"></span></p>
            </div>
          </div>
          <div
            class="p-2 text-center flex flex-col items-center justify-center"
          >
            <span class="text-md lg:text-xl font-semibold text-[#283618]">Stage 1</span>
            <img
              loading="lazy"
              src="{{ asset("landing/images/matrix.png") }}"
              alt=""
              class="object-contain object-center"
            />
            <div class="flex flex-col capitalize">
              <p class="text-sm font-semibold text-gray-800">step out bonus = <span id="stage1_one"></span></p>
              <p class="text-sm font-semibold text-gray-800">stage bonus = <span id="stage1_two"></span></p>
            </div>
          </div>
          <div
            class="p-2 text-center flex flex-col items-center justify-center"
          >
            <span class="text-md lg:text-xl font-semibold text-[#283618]">Stage 2</span>
            <img
              loading="lazy"
              src="{{ asset("landing/images/matrix.png") }}"
              alt=""
              class="object-contain object-center"
            />
            <div class="flex flex-col capitalize">
              <p class="text-sm font-semibold text-gray-800">step out bonus = <span id="stage2_one"></span></p>
              <p class="text-sm font-semibold text-gray-800">stage bonus = <span id="stage2_two"></span></p>
            </div>
          </div>
          <div
            class="p-2 text-center flex flex-col items-center justify-center"
          >
            <span class="text-md lg:text-xl font-semibold text-[#283618]">Stage 3</span>
            <img
              loading="lazy"
              src="{{ asset("landing/images/matrix.png") }}"
              alt=""
              class="object-contain object-center"
            />
            <div class="flex flex-col capitalize">
              <p class="text-sm font-semibold text-gray-800">step out bonus = <span id="stage3_one"></span></p>
              <p class="text-sm font-semibold text-gray-800">stage bonus = <span id="stage3_two"></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- The Modal Backdrop -->
    <div id="modalBackdrop" onclick="closeModal()"></div>

    <section class="pattern">
      <div
        class="flex flex-col items-center justify-center text-center gap-6 min-h-screen px-6 lg:px-20 py-[4rem] w-full max-w-[1520px] mx-auto animate__animated animate__slideInRight"
      >
        <h1 class="text-2xl lg:text-4xl font-extrabold text-[#283618]">
          COMPENSATION planS
        </h1>
        <p class="text-gray-500 text-base lg:text-md lg:w-[70%] leading-8">
          The compensation plan, utilizing a 2-by-2 matrix, offers escalating
          bonuses across different membership tiers (Silver, Gold, Platinum,
          VIP1, VIP2, VIP3, VIP4). Each tier entails specific registration fees,
          matrix structures, and rewards, encouraging progression through stages
          and offering a blend of monetary rewards and enticing incentives like
          gifts, trips, and cars.
        </p>
        <img
          loading="lazy"
          src="{{ asset("landing/images/matrix.png") }}"
          alt=""
          class="object-contain object-center w-[300px] h-[300px] lg:w-[500px] lg:h-[500px]"
        />
        <div
          id="plan-container"
          class="grid grid-cols-1 lg:grid-cols-4 gap-6"
        ></div>
      </div>
    </section>

    <section class="pattern">
      <div
        class="w-full flex items-center justify-center px-6 lg:px-20 py-[10rem] max-w-[1520px] mx-auto"
      >
        <div class="basis-1/4 hidden lg:flex justify-center">
          <img src="{{ asset("landing/images/svgelement.svg") }}" alt="" />
        </div>
        <div
          class="lg:basis-1/2 flex flex-col gap-8 items-center text-center lg:w-[80%]"
        >
          <h1 class="text-2xl lg:text-4xl text-[#283618] font-extrabold">
            Paulano Graceland your Gateway to Financial Freedom and Wealth
          </h1>
          <p class="text-base lg:text-md lg:w-[80%] text-[#606c38]">
            What are you waiting for? Choose a plan today and let us take your
            financial life to the next level
          </p>
          <!-- replaced this button with a link tag -->
          <a
            href="{{ route("plan") }}"
            class="w-[50%] py-4 bg-[#fc8400] hover:bg-[#fdaa4f] text-[#fefae0] text-sm lg:text-md font-bold rounded-full"
          >
            Get started
          </a>
        </div>
        <div class="basis-1/4 hidden lg:flex justify-center">
          <img src="{{ asset("landing/images/svgelement2.svg") }}" alt="" />
        </div>
      </div>
    </section>

    <footer class="bg-black">
      <div class="px-6 lg:px-10 py-[4rem] max-w-[1520px] mx-auto">
        <div
          class="flex flex-col lg:flex-row lg:justify-between gap-8 lg:gap-0 flex-wrap"
        >
          <a href="{{ route("landing") }}">
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
          feederStepOutBonus: 1000,
          feederStageBonus: 0,
          stage1StepOutBonus: 2000,
          stage1StageBonus: 4000,
          stage2StepOutBonus: 3000,
          stage2StageBonus: 10000,
          stage3StepOutBonus: 5000,
          stage3StageBonus: 200000,
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
          feederStepOutBonus: 2000,
          feederStageBonus: 4000,
          stage1StepOutBonus: 3000,
          stage1StageBonus: 5000,
          stage2StepOutBonus: 4000,
          stage2StageBonus: 10000,
          stage3StepOutBonus: 15000,
          stage3StageBonus: 700000,
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
          feederStepOutBonus: 5000,
          feederStageBonus: 5000,
          stage1StepOutBonus: 8000,
          stage1StageBonus: 10000,
          stage2StepOutBonus: 12000,
          stage2StageBonus: 20000,
          stage3StepOutBonus: 20000,
          stage3StageBonus: 1000000,
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
          feederStepOutBonus: 10000,
          feederStageBonus: 10000,
          stage1StepOutBonus: 15000,
          stage1StageBonus: 20000,
          stage2StepOutBonus: 20000,
          stage2StageBonus: 30000,
          stage3StepOutBonus: 40000,
          stage3StageBonus: 5000000,
        },
        {
          id: 5,
          name: "VIP 1 plan",
          amount: 200000,
          details:
            "Enjoy a whooping #3000 earnings and other incentives on the bronze plan",
          lists: [
            "Earn amazing cash bonuses plus a car worth 8 million naira",
            "5 months allowance worth N200,000 monthly",
          ],
          feederStepOutBonus: 15000,
          feederStageBonus: 15000,
          stage1StepOutBonus: 20000,
          stage1StageBonus: 25000,
          stage2StepOutBonus: 25000,
          stage2StageBonus: 35000,
          stage3StepOutBonus: 50000,
          stage3StageBonus: 9000000,
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
          feederStepOutBonus: 20000,
          feederStageBonus: 150000,
          stage1StepOutBonus: 25000,
          stage1StageBonus: 250000,
          stage2StepOutBonus: 30000,
          stage2StageBonus: 850000,
          stage3StepOutBonus: 100000,
          stage3StageBonus: 2400000,
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
          feederStepOutBonus: 40000,
          feederStageBonus: 150000,
          stage1StepOutBonus: 50000,
          stage1StageBonus: 250000,
          stage2StepOutBonus: 200000,
          stage2StageBonus: 17300000,
          stage3StepOutBonus: 0,
          stage3StageBonus: 0,
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
          feederStepOutBonus: 60000,
          feederStageBonus: 210000,
          stage1StepOutBonus: 70000,
          stage1StageBonus: 870000,
          stage2StepOutBonus: 300000,
          stage2StageBonus: 30000000,
          stage3StepOutBonus: 0,
          stage3StageBonus: 0,
        },
      ];

      function openModal(index) {
        const item = planArray[index];
        document.getElementById("modalplan").innerText = item.name;
        document.getElementById("modalPrice").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.amount);
        document.getElementById("feeder_one").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.feederStepOutBonus);
        document.getElementById("feeder_two").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.feederStageBonus);
        document.getElementById("stage1_one").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.stage1StepOutBonus);
        document.getElementById("stage1_two").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.stage1StageBonus);
        document.getElementById("stage2_one").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.stage2StepOutBonus);
        document.getElementById("stage2_two").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.stage2StageBonus);
        document.getElementById("stage3_one").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.stage3StepOutBonus);
        document.getElementById("stage3_two").innerText = new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(item.stage3StageBonus);

        document.getElementById("modal").style.display = "block";
        document.getElementById("modalBackdrop").style.display = "block";
      }

      // Function to close the modal
      function closeModal() {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalBackdrop").style.display = "none";
      }

      const planContainer = document.getElementById("plan-container");
      const plansHTML = planArray
        .map(
          (obj, index) => `
      <div class="plans flex flex-col justify-center items-center gap-3 p-2 shadow-xl border-dashed rounded-xl border-[#283618] max-w-[320px] dbg-[#fefae0] gradient_bg">
        <h1 class="text-[#bc6c25] text-xl lg:text-2xl font-semibold mt-4">${
          obj.name
        }</h1>
        <img
          loading="lazy"
          src="{{ asset("landing/images/matrix.png") }}"
          alt=""
          class="object-contain object-center w-[190px] h-[190px] lg:w-[250px] lg:h-[250px]"
        />
        <p class="text-[#283618] text-base lg:text-md font-semibold">Registration fee: ${new Intl.NumberFormat(
          "en-NG",
          {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          }
        ).format(obj.amount)}</p>
        <p class="text-sm">Enjoy whooping earnings and other incentives on the ${obj.name}</p>
        <button onclick="openModal(${index})" class="bg-[#fdaa4f] text-white text-basel hover:bg-[#fc8400] rounded-xl p-3 w-full">View plan</button>
      </div>
`
        )
        .join("");

      planContainer.innerHTML = plansHTML;
    </script>
  </body>
</html>
