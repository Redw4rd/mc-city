<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'A(z) :attribute mezőt el kell fogadnod.',
    'active_url'           => 'A(z) :attribute nem valós URL.',
    'after'                => 'A(z) :attribute mező csak későbbi időpont lehet, mint :date.',
    'alpha'                => 'A(z) :attribute mező csak karaktereket tartalmazhat.',
    'alpha_dash'           => 'A(z) :attribute mező csak karakterekből, számokból és alulvonásból állhat.',
    'alpha_num'            => 'A(z) :attribute mező csak karakterekből és számokból állhat',
    'array'                => 'A(z) :attribute mezőnek tömbnek kell lennie.',
    'before'               => 'A(z) :attribute csak korábbi időpont lehet, mint :date.',
    'between'              => [
        'numeric' => 'A(z) :attribute mező minimum :min és maximum :max lehet.',
        'file'    => 'A(z) :attribute mérete minimum :min és maximum :max kilobájt lehet.',
        'string'  => 'A(z) :attribute mező minimum :min és :max karakter között lehet.',
        'array'   => 'A(z) :attribute minimum :min és maximum :max elem lehet.',
    ],
    'boolean'              => 'A(z) :attribute mező logikai változónak kell lennie',
    'confirmed'            => 'A(z) :attribute nem eggyezik.',
    'date'                 => 'A(z) :attribute nem valós dátum.',
    'date_format'          => 'A(z) :attribute mező nem megfelelő formátumú :format.',
    'different'            => 'A(z) :attribute és :other különbözőnek kell lennie.',
    'digits'               => 'A(z) :attribute -nak/nek :digits számjegyből állhat.',
    'digits_between'       => 'A(z) :attribute minimum :min és maximum :max szám lehet.',
    'dimensions'           => 'A(z) :attribute nem megfelelő méretű.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'A(z) :attribute mező nem valós e-mail cím.',
    'exists'               => 'A(z) kiválasztott :attribute elem nem létezik.',
    'filled'               => 'A(z) :attribute mező kitöltése kötelező.',
    'image'                => 'A(z) :attribute képnek kell lennie.',
    'in'                   => 'A(z) kiválasztott :attribute elem hamis.',
    'in_array'             => 'A(z) :attribute mező nem létezik :other -ban/ben.',
    'integer'              => 'A(z) :attribute nem szám.',
    'ip'                   => 'A(z) :attribute nem valós IP cím.',
    'json'                 => 'A(z) :attribute nem helyes JSON kód.',
    'max'                  => [
        'numeric' => 'A(z) :attribute nem lehet nagyobb mint :max.',
        'file'    => 'A(z) :attribute mérete nem lehet nagyobb mint :max kilobájt.',
        'string'  => 'A(z) :attribute nem lehet hosszabb, mint :max karakter.',
        'array'   => 'A(z) :attribute nem tartalmazhat több mint :max elemet.',
    ],
    'mimes'                => 'A(z) :attribute kiterjesztése nem lehet más, csak: :values.',
    'min'                  => [
        'numeric' => 'A(z) :attribute minimum :min.',
        'file'    => 'A(z) :attribute mérete minimum :min kilobájt.',
        'string'  => 'A(z) :attribute mezőnek minimum :min karakter hosszúnak kell lennie.',
        'array'   => 'A(z) :attribute minimum :min elemnek kell lennie.',
    ],
    'not_in'               => 'A kiválasztott :attribute elem nem létezik.',
    'numeric'              => 'A(z) :attribute -nak/nek számnak kell lennie.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'A(z) :attribute formátuma nem helyes.',
    'required'             => 'A(z) :attribute mező kitöltése kötelező.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'A(z) :attribute mezőnek meg kell eggyeznie :other -val/vel.',
    'size'                 => [
        'numeric' => 'A(z) :attribute nagyobbnak kell lennie, mint: :size.',
        'file'    => 'A(z) :attribute mérete legalább :size kilobájt.',
        'string'  => 'A(z) :attribute nagyobbnak kell lennie, mint :size karakter.',
        'array'   => 'A(z) :attribute minimum :size elemet kell tartalmaznia.',
    ],
    'string'               => 'A(z) :attribute szövegnek kell lennie.',
    'timezone'             => 'A(z) :attribute valós időzónának kell lennie.',
    'unique'               => 'A(z) :attribute már használatban van.',
    'url'                  => 'A(z) :attribute formátum hamis.',
    'recaptcha'            => 'A(z) :attribute mező nem helyes.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'over_13' => [
            'accepted' => 'Csak 13 életévet betöltött személyek regisztrálhatnak!',
        ],
        'g-recaptcha-response' => [
            'recaptcha' => 'Kérlek bizonyítsd be, hogy nem vagy robot!'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
    ],

];
