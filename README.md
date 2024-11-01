
# 🌟 Toyota Thập Nhất Phong - Hệ thống Quản lý KPI và Tích điểm Nhân viên/Khách hàng 🌟

## 📝 Giới thiệu

**Toyota Thập Nhất Phong** cung cấp hệ thống quản lý **KPI và tích điểm** cho:
- 👔 **Nhân viên**: Đánh giá và tích điểm dựa trên hiệu suất làm việc.
- 💳 **Khách hàng**: Tự động tích điểm từ hóa đơn thanh toán, cho phép đổi điểm để nhận quà.

Dự án mang lại giá trị lâu dài thông qua phương pháp **Kaizen** (cải tiến liên tục) và **Hoshin Kanri** (quản lý chiến lược), giúp nâng cao hiệu suất làm việc và cải thiện sự hài lòng của khách hàng.

## 🚀 Tính năng chính

| Tính năng                         | Mô tả                                                                                  |
|-----------------------------------|----------------------------------------------------------------------------------------|
| **Quản lý Nhân viên và KPI**      | Tạo KPI, đánh giá và tích điểm theo thành tích của nhân viên.                          |
| **Quản lý Khách hàng và Hóa đơn** | Tự động tích điểm cho khách hàng qua các giao dịch và hóa đơn thanh toán.              |
| **Đổi điểm và Quà tặng**          | Cho phép nhân viên và khách hàng đổi điểm tích lũy lấy các phần thưởng.               |
| **Báo cáo & Thống kê**            | Báo cáo KPI nhân viên, điểm tích lũy của khách hàng và các giao dịch đổi thưởng.       |
| **Hệ thống Thông báo**            | Nhắc nhở và thông báo khi đạt KPI mới hoặc điểm tích lũy chạm mức đủ đổi quà.          |

## 🔧 Công nghệ Sử dụng

- **Framework**: Laravel 11.x 🖥️
- **Frontend**: Blade, Vue.js (tùy chọn) 🌐
- **Database**: MySQL hoặc PostgreSQL 💾
- **Authentication**: Laravel Breeze hoặc Laravel Jetstream 🔐
- **Các Package hỗ trợ**:
  - **Spatie Laravel Permissions** - Quản lý phân quyền 👥
  - **Chart.js** hoặc **ECharts** - Biểu đồ báo cáo 📊
  - **Laravel Excel** - Xuất báo cáo thành file Excel 📑

## 📦 Cài đặt và Cấu hình

1. **Clone dự án**

   ```bash
   git clone https://github.com/user/toyota-kpi-management.git
   cd toyota-kpi-management
   ```

2. **Cài đặt các package phụ thuộc**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Cấu hình file `.env`**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Chạy Migration và Seeder**

   ```bash
   php artisan migrate --seed
   ```

5. **Khởi chạy Server**

   ```bash
   php artisan serve
   ```

## 📊 Cấu trúc Tích điểm

### 1. Nhân viên
- 🏆 **KPI đạt được** ➡️ thêm điểm tích lũy, tùy theo mức độ hoàn thành và tầm quan trọng.

### 2. Khách hàng
- 💸 **Tích điểm từ hóa đơn** ➡️ Tự động tích điểm với quy tắc điều chỉnh theo tỷ lệ (VD: 100,000 VND = 1 điểm).
- 🛍️ **Đổi điểm lấy quà** ➡️ Chọn quà từ danh sách quà tặng trong kho.

## 🎁 Quản lý Quà tặng và Đổi điểm

| Loại Quà   | Số điểm yêu cầu | Số lượng |
|------------|-----------------|----------|
| Gift Card  | 100 điểm        | Còn 10   |
| Voucher    | 50 điểm         | Còn 25   |
| Tặng phẩm  | 200 điểm        | Còn 5    |

Khách hàng và nhân viên có thể dùng điểm tích lũy để đổi lấy các phần quà theo số điểm quy định.

## 📈 Sử dụng

### Nhân viên
- Thiết lập KPI, theo dõi tiến độ hoàn thành.
- Kiểm tra điểm tích lũy và lịch sử đổi thưởng.

### Khách hàng
- Kiểm tra điểm tích lũy, lịch sử giao dịch và đổi quà.

### Quản trị viên
- Thống kê hiệu suất của nhân viên, hoạt động tích điểm của khách hàng và các giao dịch đổi thưởng.

### Update sắp tới
- Xây dựng thêm chức năng cho khách hàng lên lịch hẹn và gọi nước khi đang chờ.
- Cho khách hàng theo dõi và thống kê xem thông tin các lần giao dịch và dịch vụ
## 💡 Đóng góp
Nếu bạn muốn đóng góp cho dự án, vui lòng fork dự án, thực hiện thay đổi và gửi pull request! Mọi đóng góp sẽ được ghi nhận và hoan nghênh!

---
