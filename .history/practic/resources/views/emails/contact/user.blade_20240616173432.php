@php
if( $form_data['sex_id'] ==1)
sex_id
endif
                    <option value="1">男性</option>
                    <option value="2">女性</option>
@endphp
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
{{ $form_data['sex_id'] }}

■スポーツレベル:
{{ $form_data['level_id'] }}

■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------

