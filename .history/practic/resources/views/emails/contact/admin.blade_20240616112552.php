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
    if($form_data['level_id'] == 2)
        $str1 ='A アスリート(国内レベル)';
    endif
    <option value="1">S トップアスリート(世界レベル)</option>
                    <option value="2">A アスリート(国内レベル)</option>
                    <option value="3">B アスリート(都道府県レベル)</option>
                    <option value="4">C マスターズ(国際レベル)</option>
                    <option value="5">D マスターズ(国内レベル)</option>
@endphp
{{ $str1 }}

■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------
