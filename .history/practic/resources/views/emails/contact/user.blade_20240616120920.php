{{ $form_data['name'] }} 様
この度はお問い合わせいただきありがとうございます。

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
    $str = '';
    if($form_data['sex_id'] == 1)
        $str ='男性';
    endif
    if($form_data['sex_id'] == 2)
        $str ='女性';
    endif
@endphp
{{ $str }}
■スポーツレベル:
@php

@endphp

{{ $str1 }}

■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------

