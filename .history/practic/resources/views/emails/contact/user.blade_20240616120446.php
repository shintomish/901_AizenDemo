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

    $str ='';
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
    $str1 ='';
    if($form_data['level_id'] == 1)
        $str1 ='S トップアスリート(世界レベル)';
    endif
    if($form_data['level_id'] == 2)
        $str1 ='A アスリート(国内レベル)';
    endif
    if($form_data['level_id'] == 3)
        $str1 ='B アスリート(都道府県レベル)';
    endif
    if($form_data['level_id'] == 4)
        $str1 ='C マスターズ(国際レベル)';
    endif
    if($form_data['level_id'] == 5)
        $str1 ='D マスターズ(国内レベル)';
    endif
@endphp
{{ $str1 }}

■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------
