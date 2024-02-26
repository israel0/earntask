
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        width: 100%;
        margin: 0;
        padding: 0;
        position: relative;
        height: 100%;
        background: #f7f8fa;
        font-family: "Inter", sans-serif;
      }
      button {
        padding: 10px;
        border-radius: 8px;
        font-size: 1em;
        border: 0;
        outline: none;
        cursor: pointer;
      }
      h1 {
        font-size: 50px;
      }
      .header {
        background: #092200;
        width: 100%;
        min-height: 140px;
        max-width: 1728px;
        margin: 0 auto;
        padding: 0 10%;
        position: relative;
        z-index: 1;
      }
      .body {
        width: 100%;
        min-height: 100vh;
        max-width: 1728px;
        margin: 0 auto;
        padding: 0 10%;
        z-index: 200;
        position: relative;
      }
      .footer {
        width: 100%;
        max-width: 1728px;
        margin: 0 auto;
        padding: 0 10%;
        z-index: 201;
        position: relative;
        margin-top: 50px;
        font-size: 12px;
      }
      .customer-section {
        width: 100%;
        max-width: 1728px;
        margin: 0 auto;
        padding: 0 10%;
        position: relative;
      }
      .table-border {
        border-collapse: separate;
        border-spacing: 20px 20px;
      }
      .inline-block {
        display: inline-block;
      }
      .w-100pc {
        width: 100%;
      }
      .w-90pc {
        width: 90%;
      }
      .box-center {
        margin: 0 auto;
      }
      .h-100pc {
        height: 100%;
      }
      .max-w-600px {
        max-width: 600px;
      }
      .max-w-500px {
        max-width: 500px;
      }
      .text-right {
        text-align: right;
      }
      .text-white {
        color: #fff;
      }
      .text-black {
        color: #000;
      }
      .bg-white {
        background: #ffffff;
      }
      .bg-black {
        background: #000000;
      }
      .fix-center {
        margin: 0 auto;
      }
      .min-h-600px {
        min-height: 600px;
      }
      .min-h-400px {
        min-height: 400px;
      }
      .v-align-top {
        vertical-align: top;
      }
      .rounded-8px {
        border-radius: 8px;
      }
      .rounded-top-8px {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
      }
      .mt--40px {
        margin-top: -40px;
      }
      .mt-0 {
        margin-top: 0;
      }
      .p-40px {
        padding: 40px;
      }
      .text-green {
        color: green;
      }
      .body-table {
        width: calc(100% - 80px);
      }
      .box-shadow-body {
        box-shadow: 0px 10px 10px -5px rgba(0, 0, 0, 0.04),
          0px 20px 25px -5px rgba(255, 170, 0, 0.1);
        margin-bottom: 50px;
      }
      .w-100 {
        width: 100%;
      }
      .pt-20 {
        padding-top: 20px;
      }
      .p-10 {
        padding: 10px;
      }
      .p-10-above-420 {
        padding: 10px;
      }
      .pt-10 {
        padding-top: 10px;
      }
      .py-10 {
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .pr-10 {
        padding-right: 10px;
      }
      .pl-10 {
        padding-left: 10px;
      }
      .pl-20 {
        padding-left: 20px;
      }
      .pl-50 {
        padding-left: 50px;
      }
      .pl-50-above-380 {
        padding-left: 50px;
      }
      .p-20 {
        padding: 20px;
      }
      .pr-20 {
        padding-right: 20px;
      }
      .pb-20 {
        padding-bottom: 20px;
      }
      .pb-10 {
        padding-bottom: 10px;
      }
      .p-40-above-420 {
        padding: 40px;
      }
      .bg-primary {
        background-color: #ffaa00;
      }
      .bg-gray {
        background: gray;
      }
      .v-align-middle {
        vertical-align: middle;
      }
      ul.items {
        display: block;
        padding: 0;
        margin: 0;
        list-style: disc;
        padding-bottom: 30px;
      }
      ul.items li {
        display: list-item;
        float: left;
        margin-right: 20px;
        padding-right: 10px;
      }
      ul.items li:first-child {
        list-style: none;
      }
      .border-bottom {
        border-bottom: 1px solid #d4d4d4;
      }
      .border-collapse {
        border-collapse: collapse;
      }
      .float-right {
        float: right;
      }
      .float-right table,
      .shipping table {
        border-collapse: separate;
        border-spacing: 0 20px;
      }
      .bold {
        font-weight: bold;
      }
      .float-right table td:last-child {
        padding-left: 50px;
      }
      /* .shipping table td:last-child {
        padding-left: 20px;
      } */
      .border-x-1 {
        border-left: 1px solid;
        border-right: 1px solid;
      }
      .border-x-above-520 {
        border-left: 1px solid;
        border-right: 1px solid;
      }
      .border-white {
        border-color: white;
      }
      .hidden-above-520 {
        display: none;
      }
      .hidden-above-380 {
        display: none;
      }
      .text-sm {
        font-size: 12px;
      }
      .text-gray {
        color: gray;
      }

      @media (max-width: 768px) {
        .spaceLeft {
          padding-left: 20px;
        }
        ul.items li {
          list-style: none;
        }
        .header {
          padding: 0 5%;
        }
        .body {
          padding: 0 5%;
        }
        .footer {
          padding: 0 5%;
        }
        .customer-section {
          padding: 0 5%;
        }
      }

      @media (max-width: 520px) {
        .hidden-520 {
          display: none;
        }
        .hidden-above-520 {
          display: block;
        }
        .border-x-above-520 {
          border-left: 0;
          border-right: 0;
        }
        .border-l-above-420 {
          border-left: 1px solid;
        }
        .w-100-520 {
          width: 100%;
        }
      }

      @media (max-width: 420px) {
        .border-l-above-420 {
          border-left: 0;
        }
        .block-420 {
          display: block;
        }
        .p-10-above-420 {
          padding: 0;
        }
        .p-40-above-420 {
          padding: unset;
        }
        .p20-420 {
          padding: 20px;
        }
        h1 {
          font-size: 5vw;
        }
        .min-h-550px-420 {
          min-height: 550px;
        }
      }

      @media (max-width: 380px) {
        .hidden-above-380 {
          display: block;
        }
        .hidden-380 {
          display: none;
        }
        .float-right {
          float: none;
        }
        .pl-50-above-380 {
          padding-left: unset;
        }
        .pl-10-380 {
          padding-left: 10px;
        }
        .pt-20-380 {
          padding-top: 20px;
        }
        .shipping td {
          display: block;
        }
        .shipping table td:last-child {
          padding-left: unset;
        }
        .body-table {
          width: calc(100% - 20px);
        }
        .p20-420 {
          padding: 20px 10px;
        }
      }
    </style>
  </head>
  <body>
    <table class="header">
      <tr>
        <td>
          <table class="w-100pc max-w-600px fix-center">
            <tr>
              <td class="pb-20">
                <img src={{ asset("images/logo.png") }} alt="logo" class="logo" />
              </td>
              <td class="text-right pb-20">
                
                    <button class="text-black bg-white">
                         Paulano Account
                      </button>
               
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table class="body mt--40px">
      <tr>
        <td>
          <table
            class="w-100pc max-w-600px fix-center bg-white rounded-8px box-shadow-body min-h-550px-420"
          >
            <tr>
              <td>
                <div
                  class="w-100pc p-40-above-420 p20-420 body-table fix-center"
                >
                  <img
                    src={{ asset('mails/full-width-placeholder.png')}}
                    alt="placeholder"
                    class="w-100pc"
                  />

                  <h1> Thanks For Subscribing! </h1>
                  <p>Hello, {{ $data['firstname'] }}</p>
                  <p>
                       {{ $data['message'] }} 
                  </p>

                  <p class="pt-20">
                  
                  </p>
                  <p class="pt-10 text-sm text-gray">
                       If you don't initialise this process Kindly Ignore this email
                  </p>
                </div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table class="footer mt-0">
      <tr>
        <td>
          <table
            class="w-100pc max-w-600px fix-center bg-white bg-primary text-white p-20 table-border"
          >
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>

