<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn bạn đã liên hệ với VeeWear</title>
    <style>
        /* Reset CSS */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }

        /* Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }

        /* Content */
        .email-content {
            padding: 30px;
            background-color: #ffffff;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .message-box {
            background-color: #f7f9fc;
            border-left: 4px solid #007bff;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }

        .message-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        .message-content {
            color: #666;
            font-style: italic;
            line-height: 1.5;
        }

        .info-section {
            margin: 25px 0;
            line-height: 1.7;
        }

        /* Footer */
        .email-footer {
            background-color: #f7f9fc;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #eaeaea;
        }

        .social-links {
            margin: 15px 0;
        }

        .social-link {
            display: inline-block;
            margin: 0 8px;
            color: #007bff;
            text-decoration: none;
        }

        .copyright {
            font-size: 12px;
            color: #999;
            margin-top: 15px;
        }

        .signature {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .signature-name {
            font-weight: 600;
            color: #333;
        }

        .signature-title {
            font-size: 14px;
            color: #777;
        }

        /* Responsive */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100%;
                border-radius: 0;
            }
            
            .email-header, .email-content, .email-footer {
                padding: 20px;
            }
        }

        /* Button */
        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }

        .cta-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <!-- Nếu có logo, thêm tại đây -->
            <!-- <img src="https://yourwebsite.com/images/logo-white.png" alt="VeeWear Logo" class="logo"> -->
            <h1>Cảm ơn bạn đã liên hệ!</h1>
        </div>

        <!-- Content -->
        <div class="email-content">
            <p class="greeting">Xin chào {{ $contact->name }},</p>

            <p>Chúng tôi đã nhận được tin nhắn của bạn và xin cảm ơn bạn đã dành thời gian liên hệ với VeeWear.</p>

            <div class="message-box">
                <span class="message-label">Nội dung tin nhắn của bạn:</span>
                <p class="message-content">{{ $contact->message }}</p>
            </div>

            <div class="info-section">
                <p>Đội ngũ hỗ trợ khách hàng của chúng tôi sẽ xem xét nội dung tin nhắn và phản hồi đến bạn trong thời gian sớm nhất có thể, thường trong vòng 24-48 giờ làm việc.</p>
                
                <p>Nếu bạn có bất kỳ câu hỏi hoặc thắc mắc nào khác, vui lòng đừng ngần ngại liên hệ với chúng tôi qua:</p>
                <ul>
                    <li>Email: <a href="mailto:support@veewear.com">support@veewear.com</a></li>
                    <li>Hotline: <a href="tel:0356789087">035.6789.087</a></li>
                </ul>
            </div>

            <a href="https://veewear.com/collections" class="cta-button">Khám phá bộ sưu tập mới</a>

            <div class="signature">
                <p>Trân trọng,</p>
                <p class="signature-name">Đội ngũ VeeWear</p>
                <p class="signature-title">Chăm sóc khách hàng</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div class="social-links">
                <a href="https://facebook.com/veewear" class="social-link">Facebook</a> |
                <a href="https://instagram.com/veewear" class="social-link">Instagram</a> |
                <a href="https://tiktok.com/@veewear" class="social-link">TikTok</a>
            </div>
            
            <p>© {{ date('Y') }} VeeWear. Tất cả các quyền được bảo lưu.</p>
            <p class="copyright">Đây là email tự động, vui lòng không trả lời email này.</p>
        </div>
    </div>
</body>
</html>
