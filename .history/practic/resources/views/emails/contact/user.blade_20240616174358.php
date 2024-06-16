    @if( $form_data['sex_id'] ==1)
        $sex = '男性';
    @endif
    @if( $form_data['sex_id'] ==2)
        $sex = '女性';
    @endif

    @if( $form_data['level_id'] ==1)
        $level = 'S トップアスリート(世界レベル)';
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

