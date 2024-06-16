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
{{ $form_data['sex_id'] }}
■スポーツレベル:
@php
    if($form_data['level_id'] == 1)
        $str =''
    endif
@endphp
{{ $form_data['level_id'] }}
■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------
