<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuggestController extends Controller
{
    public function index()
    {
        return view('ai');
    }

  public function suggest(Request $request)
{
    $result = "";

    // ================= CV =================
    if ($request->filled('cv')) {
        $content = $request->cv;

        $result = "
        <div style='font-family: Nunito; color:#0C3149'>
        
        <h3><b>THÔNG TIN CÁ NHÂN</b></h3>
        <p>$content</p>

        <h3><b>MỤC TIÊU NGHỀ NGHIỆP</b></h3>
        <p>
        Mong muốn phát triển bản thân trong môi trường chuyên nghiệp, nâng cao kỹ năng lập trình
        và đóng góp giá trị cho doanh nghiệp thông qua các sản phẩm công nghệ chất lượng.
        </p>

        <h3><b>KỸ NĂNG</b></h3>
        <p>
        - Thành thạo HTML, CSS, JavaScript <br>
        - Có kinh nghiệm Laravel, PHP, MySQL <br>
        - Hiểu biết về ReactJS và UI/UX cơ bản <br>
        - Kỹ năng làm việc nhóm và tư duy logic tốt
        </p>

        <h3><b>TRÌNH ĐỘ HỌC VẤN</b></h3>
        <p>
        - Trường: Đại học Hàng Hải Việt Nam <br>
        - Ngành: Công nghệ thông tin <br>
        - Xếp loại: Khá / Giỏi
        </p>

        <h3><b>KINH NGHIỆM LÀM VIỆC</b></h3>
        <p>
        - Tham gia xây dựng website tuyển dụng bằng Laravel <br>
        - Phát triển giao diện và xử lý logic backend <br>
        - Tối ưu hiệu suất và cải thiện trải nghiệm người dùng
        </p>

        <h3><b>ĐỊNH HƯỚNG PHÁT TRIỂN</b></h3>
        <p>
        Trở thành lập trình viên chuyên nghiệp, có khả năng xây dựng hệ thống lớn
        và làm việc trong môi trường quốc tế.
        </p>

        </div>
        ";
    }

    // ================= EMAIL ỨNG TUYỂN =================
    elseif ($request->filled('mail')) {
        $content = $request->mail;

        $result = "
        <div style='font-family: Nunito; color:#0C3149'>

        <h3><b>📧 EMAIL ỨNG TUYỂN</b></h3>

        <p><b>Subject:</b> Ứng tuyển vị trí lập trình viên</p>

        <p>Kính gửi Quý Công Ty,</p>

        <p>$content</p>

        <p>
        Tôi tin rằng với những kỹ năng và kinh nghiệm của mình, tôi có thể đóng góp tích cực
        cho sự phát triển của công ty.
        </p>

        <p>
        Rất mong có cơ hội được trao đổi trực tiếp trong buổi phỏng vấn.
        </p>

        <p>
        Xin chân thành cảm ơn và mong nhận được phản hồi từ Quý Công Ty.
        </p>

        <p>Trân trọng,<br>Ứng viên</p>

        </div>
        ";
    }

    // ================= BÀI TUYỂN DỤNG =================
    elseif ($request->filled('post')) {
        $content = $request->post;

        $result = "
        <div style='font-family: Nunito; color:#0C3149'>

        <h3><b>🔥 TUYỂN DỤNG NHÂN SỰ</b></h3>

        <p><b>Tiêu đề:</b> $content</p>

        <h3><b>MÔ TẢ CÔNG VIỆC</b></h3>
        <p>
        - Phát triển và bảo trì hệ thống web <br>
        - Làm việc với team để triển khai dự án <br>
        - Tối ưu hiệu suất hệ thống
        </p>

        <h3><b>YÊU CẦU</b></h3>
        <p>
        - Thành thạo HTML, CSS, JavaScript <br>
        - Có kinh nghiệm với Laravel hoặc React <br>
        - Tư duy logic tốt, chủ động trong công việc
        </p>

        <h3><b>QUYỀN LỢI</b></h3>
        <p>
        - Mức lương: 10 - 20 triệu <br>
        - Môi trường năng động, chuyên nghiệp <br>
        - Cơ hội thăng tiến và phát triển bản thân
        </p>

        <h3><b>THÔNG TIN KHÁC</b></h3>
        <p>
        - Hình thức: Full-time <br>
        - Địa điểm: Hải Phòng / Hà Nội <br>
        - Hạn nộp: Khi tuyển đủ
        </p>

        </div>
        ";
    }

    // ================= EMAIL HR =================
    elseif ($request->filled('mail2')) {
        $content = $request->mail2;

        $result = "
        <div style='font-family: Nunito; color:#0C3149'>

        <h3><b>📩 THƯ MỜI ỨNG VIÊN</b></h3>

        <p><b>Subject:</b> Thư mời phỏng vấn</p>

        <p>Chào bạn,</p>

        <p>$content</p>

        <p>
        Chúng tôi đánh giá cao hồ sơ của bạn và mong muốn mời bạn tham gia buổi phỏng vấn
        để trao đổi chi tiết hơn về vị trí công việc.
        </p>

        <p>
        Thời gian: Linh hoạt <br>
        Hình thức: Online/Offline
        </p>

        <p>
        Mong nhận được phản hồi từ bạn trong thời gian sớm nhất.
        </p>

        <p>Trân trọng,<br>Phòng nhân sự</p>

        </div>
        ";
    }

    return view('ai', ['fakeResult' => $result]);
}
}