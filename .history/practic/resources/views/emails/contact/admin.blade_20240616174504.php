    @if( $form_data['sex_id'] ==1)
    $sex = '男性';
    @php
    $sex = '男性';
    @endphp
    @endif
    @if( $form_data['sex_id'] ==2)
    @php
        $sex = '女性';
    @endphp
    @endif

    @if( $form_data['level_id'] ==1)
    @php
        $level = 'S トップアスリート(世界レベル)';
    @endphp
    @endif
    @if( $form_data['level_id'] ==2)
    @php
        $level = 'A アスリート(国内レベル)';
    @endphp
    @endif
    @if( $form_data['level_id'] ==3)
    @php
        $level = '>B アスリート(都道府県レベル)';
    @endphp
    @endif
    @if( $form_data['level_id'] ==4)
    @php
        $level = 'C マスターズ(国際レベル))';
    @endphp
    @endif
    @if( $form_data['level_id'] ==5)
    @php
        $level = 'D マスターズ(国内レベル)';
    @endphp
    @endif

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
