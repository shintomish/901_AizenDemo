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
@php
    if($form_data['sex_id'] == 1)
        $str ='男性';
    endif
    if($form_data['sex_id'] == 2)
        $str ='男性';
    endif
@endphp
{{ $form_data['sex_id'] }}
■スポーツレベル:

{{ $form_data['level_id'] }}
■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------
