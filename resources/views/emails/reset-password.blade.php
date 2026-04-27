<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/reset_pass.css') }}">
</head>
<body style="margin:0; padding:0; background:#fff6f8; font-family: Arial, Helvetica, sans-serif; color:#2f2430;">

<div style="display:none; max-height:0; overflow:hidden; opacity:0; mso-hide:all;">
    Reset your password securely using the link below. This link expires in 60 minutes.
</div>

<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%; background:#fff6f8; table-layout:fixed;">
    <tr>
        <td align="center" class="wrapper" style="padding:24px 12px;">

            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600" class="container" style="width:100%; max-width:600px; background:#ffffff; border:1px solid #ead1d8; border-radius:16px; overflow:hidden; box-shadow:0 16px 34px rgba(56, 28, 42, 0.16);">
                <tr>
                    <td class="header-cell" style="padding:14px 24px; background:#8b1e3f; background-image:linear-gradient(145deg, #8b1e3f 0%, #b84b69 55%, #d5758f 100%);">
                        <div style="font-size:16px; line-height:22px; font-weight:800; letter-spacing:.2px; color:#ffffff;">
                            {{ env('APP_NAME') }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="px py" style="padding:24px;">
                        <div class="title" style="margin:0 0 12px; font-size:24px; line-height:30px; font-weight:800; letter-spacing:.2px; color:#8b1e3f;">
                            Hello {{ $user->name ?? 'User' }},
                        </div>

                        <div class="text" style="margin:0 0 18px; font-size:16px; line-height:24px; color:#7a5a66;">
                            You are receiving this email because we received a password reset request for your account.
                        </div>

                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%; margin:0 0 18px;">
                            <tr>
                                <td align="center" class="button-wrap">
                                    <a href="{{ $url }}" class="btn"
                                       style="background:#8b1e3f; color:#ffffff; padding:12px 20px; border-radius:12px; text-decoration:none; display:inline-block; font-weight:700; border:1px solid #8b1e3f; min-width:220px; text-align:center;">
                                        Reset Password
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <div class="text" style="margin:0 0 16px; font-size:14px; line-height:22px; color:#7a5a66;">
                            This password reset link will expire in 60 minutes.<br/>
                            If you did not request a password reset, no further action is required.<br/>
                            Regards,<br/>
                            {{ env('APP_NAME') }}
                        </div>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
