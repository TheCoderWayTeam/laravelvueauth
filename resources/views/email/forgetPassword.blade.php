<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style>
    html,
    body {
        padding: 0;
        margin: 0;
    }

    </style>
</head>

<body>
    <div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
        <br>
        <table style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                <tr>
                    <td style="text-align:center; padding: 40px" valign="center" align="center">
                        <a href="#" rel="noopener" target="_blank">
                            {{$logo}}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td valign="center" align="left">
                        <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
                            <!--begin:Email content-->
                            <div style="padding-bottom: 30px; font-size: 17px;">
                                We have sent you this email in response to your request to reset your password. To reset your password, please click the link below:
                            </div>
                            <div style="padding-bottom: 40px; text-align:center;">
                                <a href="{{ url('reset-password/'.$token)  }}" rel="noopener" style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#0BBCBD;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle" target="_blank">Reset Password</a>
                            </div>
                            <div style="padding-bottom: 30px">Questions? Read our help guides at
                                <a href="{{ env('APP_URL') }}" rel="noopener" target="_blank" style="text-decoration:none;color: #0BBCBD"> support </a> or send an email to us at
                                <a href="{{env('APP_EMAIL')}}" rel="noopener" target="_blank" style="text-decoration:none;color: #0BBCBD">{{env('APP_EMAIL')}}</a>.</div>
                            <!--end:Email content-->
                            <div style="padding-bottom: 10px">Kind regards,
                                <br>{{ env('APP_NAME')}}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;" valign="center" align="center">
                        <p>{{ env('APP_ADDRESS')}}</p>
                        <p>Copyright ©
                            <a href="{{ env('APP_URL') }}" rel="noopener" target="_blank">{{ env('APP_NAME')}}</a>.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>