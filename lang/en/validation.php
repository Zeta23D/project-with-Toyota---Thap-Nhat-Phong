<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dòng ngôn ngữ xác thực
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau chứa các thông báo lỗi mặc định được sử dụng bởi
    | lớp trình xác thực. Một số quy tắc có nhiều phiên bản, chẳng hạn như
    | các quy tắc về kích thước. Hãy tùy chỉnh các thông báo này ở đây.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'accepted_if' => ':attribute phải được chấp nhận khi :other là :value.',
    'active_url' => ':attribute không phải là URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày bằng hoặc sau :date.',
    'alpha' => ':attribute chỉ được chứa chữ cái.',
    'alpha_dash' => ':attribute chỉ được chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ được chứa chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'ascii' => ':attribute chỉ được chứa các ký tự và ký hiệu ASCII đơn byte.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày bằng hoặc trước :date.',
    'between' => [
        'array' => ':attribute phải có từ :min đến :max mục.',
        'file' => ':attribute phải có kích thước từ :min đến :max kilobytes.',
        'numeric' => ':attribute phải nằm trong khoảng :min đến :max.',
        'string' => ':attribute phải có từ :min đến :max ký tự.',
    ],
    'boolean' => ':attribute phải là đúng hoặc sai.',
    'can' => ':attribute chứa giá trị không được phép.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng :date.',
    'date_format' => ':attribute không khớp với định dạng :format.',
    'decimal' => ':attribute phải có :decimal chữ số thập phân.',
    'declined' => ':attribute phải bị từ chối.',
    'declined_if' => ':attribute phải bị từ chối khi :other là :value.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải có :digits chữ số.',
    'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => ':attribute có giá trị trùng lặp.',
    'doesnt_end_with' => ':attribute không được kết thúc bằng một trong các giá trị sau: :values.',
    'doesnt_start_with' => ':attribute không được bắt đầu bằng một trong các giá trị sau: :values.',
    'email' => ':attribute phải là địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => ':attribute đã chọn không hợp lệ.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'extensions' => ':attribute phải là tệp có phần mở rộng: :values.',
    'file' => ':attribute phải là một tệp.',
    'filled' => ':attribute phải có giá trị.',
    'gt' => [
        'array' => ':attribute phải có nhiều hơn :value mục.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn :value.',
        'string' => ':attribute phải nhiều hơn :value ký tự.',
    ],
    'gte' => [
        'array' => ':attribute phải có :value mục hoặc nhiều hơn.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'string' => ':attribute phải có nhiều hơn hoặc bằng :value ký tự.',
    ],
    'hex_color' => ':attribute phải là màu hex hợp lệ.',
    'image' => ':attribute phải là hình ảnh.',
    'in' => ':attribute đã chọn không hợp lệ.',
    'in_array' => ':attribute phải tồn tại trong :other.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là chuỗi JSON hợp lệ.',
    'list' => ':attribute phải là danh sách.',
    'lowercase' => ':attribute phải là chữ thường.',
    'lt' => [
        'array' => ':attribute phải có ít hơn :value mục.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'string' => ':attribute phải có ít hơn :value ký tự.',
    ],
    'lte' => [
        'array' => ':attribute không được có nhiều hơn :value mục.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => ':attribute phải có ít hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => ':attribute phải là địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => ':attribute không được có nhiều hơn :max mục.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'numeric' => ':attribute không được lớn hơn :max.',
        'string' => ':attribute không được có nhiều hơn :max ký tự.',
    ],
    'max_digits' => ':attribute không được có nhiều hơn :max chữ số.',
    'mimes' => ':attribute phải là tệp thuộc loại: :values.',
    'mimetypes' => ':attribute phải là tệp thuộc loại: :values.',
    'min' => [
        'array' => ':attribute phải có ít nhất :min mục.',
        'file' => ':attribute phải có ít nhất :min kilobytes.',
        'numeric' => ':attribute phải có ít nhất :min.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
    ],
    'min_digits' => ':attribute phải có ít nhất :min chữ số.',
    'missing' => ':attribute phải bị thiếu.',
    'missing_if' => ':attribute phải bị thiếu khi :other là :value.',
    'missing_unless' => ':attribute phải bị thiếu trừ khi :other là :value.',
    'missing_with' => ':attribute phải bị thiếu khi :values hiện diện.',
    'missing_with_all' => ':attribute phải bị thiếu khi :values hiện diện.',
    'multiple_of' => ':attribute phải là bội số của :value.',
    'not_in' => ':attribute đã chọn không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'password' => [
        'letters' => ':attribute phải chứa ít nhất một chữ cái.',
        'mixed' => ':attribute phải chứa ít nhất một chữ in hoa và một chữ thường.',
        'numbers' => ':attribute phải chứa ít nhất một số.',
        'symbols' => ':attribute phải chứa ít nhất một ký hiệu.',
        'uncompromised' => ':attribute đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn :attribute khác.',
    ],
    'present' => ':attribute phải có mặt.',
    'present_if' => ':attribute phải có mặt khi :other là :value.',
    'present_unless' => ':attribute phải có mặt trừ khi :other là :value.',
    'present_with' => ':attribute phải có mặt khi :values hiện diện.',
    'present_with_all' => ':attribute phải có mặt khi :values hiện diện.',
    'prohibited' => ':attribute bị cấm.',
    'prohibited_if' => ':attribute bị cấm khi :other là :value.',
    'prohibited_unless' => ':attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => ':attribute cấm :other xuất hiện.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => ':attribute là bắt buộc.',
    'required_array_keys' => ':attribute phải chứa các mục: :values.',
    'required_if' => ':attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => ':attribute là bắt buộc khi :other được chấp nhận.',
    'required_if_declined' => ':attribute là bắt buộc khi :other bị từ chối.',
    'required_unless' => ':attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => ':attribute là bắt buộc khi :values có mặt.',
    'required_with_all' => ':attribute là bắt buộc khi tất cả :values có mặt.',
    'required_without' => ':attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => ':attribute là bắt buộc khi không có :values nào có mặt.',
    'same' => ':attribute và :other phải khớp.',
    'size' => [
        'array' => ':attribute phải chứa :size mục.',
        'file' => ':attribute phải có kích thước :size kilobytes.',
        'numeric' => ':attribute phải có kích thước :size.',
        'string' => ':attribute phải chứa :size ký tự.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng một trong các giá trị sau: :values.',
    'string' => ':attribute phải là chuỗi.',
    'timezone' => ':attribute phải là một múi giờ hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => ':attribute tải lên không thành công.',
    'uppercase' => ':attribute phải là chữ in hoa.',
    'url' => ':attribute phải là URL hợp lệ.',
    'ulid' => ':attribute phải là ULID hợp lệ.',
    'uuid' => ':attribute phải là UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Dòng ngôn ngữ xác thực tùy chỉnh
    |--------------------------------------------------------------------------
    |
    | Ở đây bạn có thể chỉ định các thông báo xác thực tùy chỉnh cho các thuộc
    | tính bằng cách sử dụng quy ước "thuộc tính.quy_tắc" để đặt các dòng. Điều
    | này giúp bạn nhanh chóng chỉ định một dòng ngôn ngữ tùy chỉnh cụ thể cho
    | một quy tắc thuộc tính nhất định.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'thông báo-tùy-chỉnh',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Thuộc tính xác thực tùy chỉnh
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau đây được sử dụng để thay thế chỗ giữ thuộc tính
    | của chúng tôi bằng một thứ gì đó dễ đọc hơn, chẳng hạn như "Địa chỉ E-Mail"
    | thay vì "email". Điều này giúp chúng tôi làm cho thông báo của mình dễ hiểu hơn.
    |
    */

    'attributes' => [
        'ten_khach_hang' => 'Tên khách hàng', // Thiết lập tên hiển thị cho trường ten_khach_hang
        'so_dien_thoai' => 'Số điện thoại', // Thiết lập tên hiển thị cho trường ten_khach_hang
        'bien_so_xe' => 'Biển số xe', // Thiết lập tên hiển thị cho trường ten_khach_hang
        'so_vin' => 'Số VIN', // Thiết lập tên hiển thị cho trường ten_khach_hang
    ],

    'errors' => [
        'default' => ':attribute có lỗi.',
        'multiple' => 'Còn :count lỗi khác nữa.',
    ],
    'multiple' => 'Còn :count lỗi khác.',

];
