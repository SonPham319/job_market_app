<?php

return [

    // ===== RULES =====
    'required' => ':attribute không được để trống',
    'email' => ':attribute phải là email hợp lệ',
    'min' => [
        'string' => ':attribute phải có ít nhất :min ký tự',
    ],
    'max' => [
        'string' => ':attribute không được vượt quá :max ký tự',
    ],
    'image' => ':attribute phải là hình ảnh',
    'mimes' => ':attribute phải có định dạng: :values',

    // ===== CUSTOM FIELD NAME =====
    'attributes' => [
        'name' => 'Họ tên',
        'about' => 'Giới thiệu',
        'profile_pic' => 'Ảnh đại diện',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'current_password' => 'Mật khẩu hiện tại',
    ],

];