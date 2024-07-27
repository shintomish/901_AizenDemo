@php
    // 性別
    foreach ($loop_sex_flg as $loop_sex_flg2) {
        if($loop_sex_flg2['no'] == $form_data['sex_id']) {
            $sex = $loop_sex_flg2['name'];
        }
    }

    // レベル
    foreach ($loop_level_flg as $loop_level_flg2) {
        if($loop_level_flg2['no'] == $form_data['level_id']) {
            $level = $loop_level_flg2['name'];
        }
    }

@endphp

    {{ $form_data['name'] }} 様より下記の内容のお問い合わせがありました

==============================
お問い合わせ内容
==============================
■お名前:
{{ $form_data['name'] }}

■年齢:
{{ $form_data['age'] }}

■メールアドレス:
{{ $form_data['email'] }}

■性別:
{{ $sex }}

■スポーツレベル:
{{ $level }}

■お問い合わせ内容:
{{ $form_data['body'] }}

------------------------------
