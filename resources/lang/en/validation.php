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

    'accepted'             => 'musi zostać zaakceptowany.',
    'active_url'           => 'jest nieprawidłowym adresem URL.',
    'after'                => 'musi być datą późniejszą od :date.',
    'after_or_equal'       => 'musi być datą nie wcześniejszą niż :date.',
    'alpha'                => 'może zawierać jedynie litery.',
    'alpha_dash'           => 'może zawierać jedynie litery, cyfry i myślniki.',
    'alpha_num'            => 'może zawierać jedynie litery i cyfry.',
    'array'                => 'musi być tablicą.',
    'before'               => 'musi być datą wcześniejszą od :date.',
    'before_or_equal'      => 'musi być datą nie późniejszą niż :date.',
    'between'              => [
        'numeric' => 'musi zawierać się w granicach :min - :max.',
        'file'    => 'musi zawierać się w granicach :min - :max kilobajtów.',
        'string'  => 'musi zawierać się w granicach :min - :max znaków.',
        'array'   => 'musi składać się z :min - :max elementów.',
    ],
    'boolean'              => 'musi mieć wartość prawda albo fałsz',
    'confirmed'            => 'Potwierdzenie nie zgadza się.',
    'date'                 => 'nie jest prawidłową datą.',
    'date_format'          => 'nie jest w formacie :format.',
    'different'            => 'oraz :other muszą się różnić.',
    'digits'               => 'musi składać się z :digits cyfr.',
    'digits_between'       => 'musi mieć od :min do :max cyfr.',
    'dimensions'           => 'ma niepoprawne wymiary.',
    'distinct'             => 'ma zduplikowane wartości.',
    'email'                => 'Format jest nieprawidłowy.',
    'exists'               => 'Zaznaczony jest nieprawidłowy.',
    'file'                 => 'musi być plikiem.',
    'filled'               => 'Pole jest wymagane.',
    'image'                => 'musi być obrazkiem.',
    'in'                   => 'Zaznaczony jest nieprawidłowy.',
    'in_array'             => 'nie znajduje się w :other.',
    'integer'              => 'musi być liczbą całkowitą.',
    'ip'                   => 'musi być prawidłowym adresem IP.',
    'ipv4'                 => 'The must be a valid IPv4 address.',
    'ipv6'                 => 'The must be a valid IPv6 address.',
    'json'                 => 'musi być poprawnym ciągiem znaków JSON.',
    'max'                  => [
        'numeric' => 'nie może być większy niż :max.',
        'file'    => 'nie może być większy niż :max kilobajtów.',
        'string'  => 'nie może być dłuższy niż :max znaków.',
        'array'   => 'nie może mieć więcej niż :max elementów.',
    ],
    'mimes'                => 'musi być plikiem typu :values.',
    'mimetypes'            => 'musi być plikiem typu :values.',
    'min'                  => [
        'numeric' => 'musi być nie mniejszy od :min.',
        'file'    => 'musi mieć przynajmniej :min kilobajtów.',
        'string'  => 'musi mieć przynajmniej :min znaków.',
        'array'   => 'musi mieć przynajmniej :min elementów.',
    ],
    'not_in'               => 'Zaznaczony jest nieprawidłowy.',
    'numeric'              => 'musi być liczbą.',
    'present'              => 'Pole musi być obecne.',
    'regex'                => 'Format jest nieprawidłowy.',
    'required'             => 'Pole jest wymagane.',
    'required_if'          => 'Pole jest wymagane gdy :other jest :value.',
    'required_unless'      => 'jest wymagany jeżeli :other nie znajduje się w :values.',
    'required_with'        => 'Pole jest wymagane gdy :values jest obecny.',
    'required_with_all'    => 'Pole jest wymagane gdy :values jest obecny.',
    'required_without'     => 'Pole jest wymagane gdy :values nie jest obecny.',
    'required_without_all' => 'Pole jest wymagane gdy żadne z :values nie są obecne.',
    'same'                 => 'Pole i :other muszą się zgadzać.',
    'size'                 => [
        'numeric' => 'musi mieć :size.',
        'file'    => 'musi mieć :size kilobajtów.',
        'string'  => 'musi mieć :size znaków.',
        'array'   => 'musi zawierać :size elementów.',
    ],
    'string'               => 'musi być ciągiem znaków.',
    'timezone'             => 'musi być prawidłową strefą czasową.',
    'unique'               => 'Taki już występuje.',
    'uploaded'             => 'Nie udało się wgrać pliku ',
    'url'                  => 'Format jest nieprawidłowy.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
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

    'attributes' => [],

];
