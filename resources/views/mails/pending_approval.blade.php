<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 21px;
            color: #23232C;
            padding: 0;
            margin: 0;
            background: #23242d;
        }

      a {
        color: inherit;
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
      .red {
        color: #0174da;
      }
        .button {

            padding: 8px 24px;
            background-color: #0174da;
            color: #fff;
            letter-spacing: 1px;
            text-decoration: none;

             text-align: center;
            margin: 16px auto 8px;
            display: block; width: auto;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <a href="" class="header">
            <img style="height:24px" src="" />
        </a>

        <div class="container">
            <!--------------------------->
            <!--------------------------->
            <!--------------------------->
            <!-- <h1 style="text-align:center;">Pending Approval Notification</h1> -->

            <h2 style="color: #333;">Dear {{ $data['firstname'] }},</h2>

                <p>Thank you for registering with <strong>Toyota bidding system</strong>!</p>

                <p>Your account registration has been successfully completed, and it is currently pending approval. Our team is reviewing your details, and you will receive another email within 1 to 3 days once your account has been approved.</p>

                <h3>What to Expect Next:</h3>
                <ul>
                    <li><strong>Account approval:</strong> You will be notified by email.</li>
                    <li><strong>Access:</strong> Once approved, you will be able to log in and start using your account.</li>
                </ul>
        </div>
    </div>
</body>

</html>
