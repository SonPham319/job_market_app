<x-mail::message>
# Chúc mừng! Bạn đã nâng cấp tài khoản thành công 🎉

Cảm ơn bạn đã đăng ký gói thành viên tại **JOB SEARCH**.

## Thông tin thanh toán
**Gói thành viên:**  
@if($plan == 'monthly')
- **Gói tháng**
- **Ngày hết hạn:** {{ $billingEnds }}
@elseif($plan == 'yearly')
- **Gói năm**
- **Ngày hết hạn:** {{ $billingEnds }}
@else
- **Gói thành viên JOB SEARCH**
@endif

<x-mail::button :url="route('dashboard')">
Truy cập bảng điều khiển
</x-mail::button>

Nếu bạn có bất kỳ câu hỏi nào, hãy liên hệ với đội ngũ hỗ trợ của **JOB SEARCH**.

Trân trọng,<br>
**JOB SEARCH**
</x-mail::message>