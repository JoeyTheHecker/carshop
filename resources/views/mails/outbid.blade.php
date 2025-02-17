<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 21px;
            color: black;
            padding: 0;
            margin: 0;
            background: #23242d;
        }

      a {
        color: white;
        text-decoration: none;
        letter-spacing: 0.5px;
        margin: 0 4px;
      }

        .wrapper {
            max-width: 560px;
            margin: 0 auto;
            background: #fff;
        }

        .header {
            background: white;
            text-align: center;
            display: block;
            padding: 22px 20px 16px;
            margin: 0;
        }

        .footer {
            background: #111;
            color: #A0A0AC;
            text-align: center;
            padding: 24px;

        }

      .footer span {
        font-size: 12px;
      }

        .footer a {
            color: #fff;
            letter-spacing: 1px;
            margin: 8px 10px 8px;
            display: inline-block;
        }

      .black {
        background: #111; color: #fff
      }

      .grey, .label {
        color: #a0a0ac;
      }

      .label {

        width: 60px;
        display: inline-block
      }

        .container {
            max-width: 460px;
            padding: 32px 20px 60px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            line-height: 36px;

        }
        .button {
            padding: 8px 24px;
            background-color: rgba(247, 192, 192, 0.911);
            color: white;
            letter-spacing: 1px;
            text-decoration: none;

            text-align: center;
            margin: 16px auto 8px;
            display: block; width: auto;
        }
        a:visited {
        color: white;
        text-decoration: none;
    }
    </style>

</head>

<body>
    <div class="wrapper">
        {{-- <a href="" class="header">
            <img style="height:24px" src="{{ asset('images/toyota-product-logo.png') }}" />
        </a> --}}

        <div class="container">
            <!--------------------------->
            <!--------------------------->
            <!--------------------------->
            <h1 style="text-align:center;">Bid Notification</h1>

            <p style="text-align:center;">Your bid on {{$data['product_name']}} has been outbid.</p>
            <p style="text-align:center;">{{$data['remaining_time']}}</p>
            <div >
                <div>
                    <a class="button" style="font: bold" href="http://192.168.14.192:8000/product/details/{{$data['product_id']}}">Place new bid</a>
                </div>
            </div>
        </div>
        <footer class="bg-red-800 dark:bg-red-700">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <br>
                <br>
                {{-- <div class="flex justify-center">
                    <div class="mb-6 md:mb-0">
                        <a href="landingpage.html" class="flex items-center space-x-3 rtl:space-x-reverse">
                            <img src="images/toyotafooter.png" class="h-12" alt="Flowbite Logo" />
                            <div class="flex flex-col">
                                <span
                                    class="self-center text-3xl font-bold whitespace-nowrap text-white dark:text-white">Toyota
                                    Tacloban</span>
                                <span class="text-sm font-semibold whitespace-nowrap text-white dark:text-white">Easy access
                                    to
                                    pre-owned cars</span>
                            </div>
                        </a>
                    </div>
                </div> --}}
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-white sm:text-center dark:text-gray-400">© 2024 <a
                            href="" class="hover:underline">Toyota Tacloban™</a>. All Rights Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
