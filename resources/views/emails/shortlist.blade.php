<x-mail::message>
# Xin chúc mừng, {{ $name }}! 🎉

Hồ sơ của bạn đã được **{{ $company_name }}** đánh giá tích cực và đưa vào **danh sách tiếp tục** cho vị trí:

## {{ $title }}

trên nền tảng **JOB SEARCH**.

Nhà tuyển dụng có thể sẽ liên hệ với bạn trong thời gian tới để trao đổi thêm về:
- Lịch phỏng vấn
- Thông tin công việc
- Quy trình tuyển dụng tiếp theo

## Thông tin liên hệ nhà tuyển dụng
**Công ty:** {{ $company_name }}  
**Email:** {{ $company_email }}

<x-mail::button :url="route('dashboard')">
Xem hồ sơ của bạn
</x-mail::button>

Chúc bạn có một hành trình ứng tuyển thành công!

Trân trọng,<br>
**Đội ngũ JOB SEARCH**
</x-mail::message>