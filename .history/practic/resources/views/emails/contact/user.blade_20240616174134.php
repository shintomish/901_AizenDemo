    @if( $form_data['sex_id'] ==1)
        $sex = '男性';
    endif
    if( $form_data['sex_id'] ==2)
        $sex = '女性';
    endif

    if( $form_data['level_id'] ==1)
        $level = 'S トップアスリート(世界レベル)';
    endif
    if( $form_data['level_id'] ==2)
        $level = 'A アスリート(国内レベル)';
    endif
    if( $form_data['level_id'] ==3)
        $level = '>B アスリート(都道府県レベル)';
    endif
    if( $form_data['level_id'] ==4)
        $level = 'C マスターズ(国際レベル))';
    endif
    if( $form_data['level_id'] ==5)
        $level = 'D マスターズ(国内レベル)';
    endif
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
{{ $sex }}

■スポーツレベル:
{{ $level }}

■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------

