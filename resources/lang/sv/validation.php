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

    'accepted'             => ':Attribute måste accepteras.',
    'active_url'           => ':Attribute är inte en giltig webbadress.',
    'after'                => ':Attribute måste vara ett datum efter :date.',
    'after_or_equal'       => ':Attribute måste vara ett datum efter eller lika med :date.',
    'alpha'                => ':Attribute får bara innehålla bokstäver.',
    'alpha_dash'           => ':Attribute får bara innehålla bokstäver, siffror och bindestreck.',
    'alpha_num'            => ':Attribute får bara innehålla bokstäver och siffror.',
    'array'                => ':Attribute måste vara en matris.',
    'before'               => ':Attribute måste vara ett datum före :date.',
    'before_or_equal'      => ':Attribute måste vara ett datum före eller lika med :date.',
    'between'              => [
        'numeric' => ':Attribute måste vara mellan :min och :max.',
        'file'    => ':Attribute måste vara mellan :min och :max kilobyte.',
        'string'  => ':Attribute måste vara mellan :min och :max tecken.',
        'array'   => ':Attribute måste ha mellan :min och :max objekt.',
    ],
    'boolean'              => ':Attribute måste vara sant eller falskt.',
    'confirmed'            => ':Attribute matchar inte bekräftelsen.',
    'date'                 => ':Attribute är inte ett giltigt datum.',
    'date_format'          => ':Attribute matchar inte formatet :format.',
    'different'            => ':Attribute och :other måste vara olika.',
    'digits'               => ':Attribute måste vara :digits siffror.',
    'digits_between'       => ':Attribute måste vara mellan :min och :max siffror.',
    'dimensions'           => ':Attribute har ogiltiga bilddimensioner.',
    'distinct'             => ':Attribute har ett dubblerat värde.',
    'email'                => ':Attribute måste vara en giltig e-postadress.',
    'exists'               => 'Det valda :attribute är ogiltigt.',
    'file'                 => ':Attribute måste vara en fil.',
    'filled'               => ':Attribute måste ha ett värde.',
    'image'                => ':Attribute måste vara en bild.',
    'in'                   => 'Det valda :attribute är ogiltigt.',
    'in_array'             => ':Attribute finns inte i :other.',
    'integer'              => ':Attribute måste vara ett heltal.',
    'ip'                   => ':Attribute måste vara en giltig IP-adress.',
    'ipv4'                 => ':Attribute måste vara en giltig IPv4-adress.',
    'ipv6'                 => ':Attribute måste vara en giltig IPv6-adress.',
    'json'                 => ':Attribute måste vara en giltig JSON-sträng.',
    'max'                  => [
        'numeric' => ':Attribute får inte vara större än :max.',
        'file'    => ':Attribute får inte vara större än :max kilobyte.',
        'string'  => ':Attribute får inte vara längre än :max tecken.',
        'array'   => ':Attribute får inte ha fler än :max objekt.',
    ],
    'mimes'                => ':Attribute måste vara en fil av typen: :values.',
    'mimetypes'            => ':Attribute måste vara en fil av typen: :values.',
    'min'                  => [
        'numeric' => ':Attribute måste vara minst :min.',
        'file'    => ':Attribute måste vara minst :min kilobyte.',
        'string'  => ':Attribute måste vara minst :min tecken.',
        'array'   => ':Attribute måste ha minst :min objekt.',
    ],
    'not_in'               => 'Det valda :attribute är ogiltigt.',
    'numeric'              => ':Attribute måste vara ett nummer.',
    'present'              => ':Attribute måste vara närvarande.',
    'regex'                => ':Attribute har ogiltigt format.',
    'required'             => ':Attribute är obligatoriskt.',
    'required_if'          => ':Attribute är obligatoriskt när :other är :value.',
    'required_unless'      => ':Attribute är obligatoriskt om inte :other finns i :values.',
    'required_with'        => ':Attribute är obligatoriskt när :values är närvarande.',
    'required_with_all'    => ':Attribute är obligatoriskt när :values är närvarande.',
    'required_without'     => ':Attribute är obligatoriskt när :values inte är närvarande.',
    'required_without_all' => ':Attribute är obligatoriskt när ingen av :values är närvarande.',
    'same'                 => ':Attribute och :other måste matcha.',
    'size'                 => [
        'numeric' => ':Attribute måste vara :size.',
        'file'    => ':Attribute måste vara :size kilobyte.',
        'string'  => ':Attribute måste vara :size tecken.',
        'array'   => ':Attribute måste innehålla :size objekt.',
    ],
    'string'               => ':Attribute måste vara en sträng.',
    'timezone'             => ':Attribute måste vara en giltig tidszon.',
    'unique'               => ':Attribute är redan taget.',
    'uploaded'             => ':Attribute kunde inte laddas upp.',
    'url'                  => ':Attribute har ogiltigt format.',

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

    'OlderThan' => 'Du måste vara äldre än :age år.',
    'YoungerThan' => 'Du måste vara yngre än :age år.',
    'phone' => ':Attribute innehåller ett ogiltigt telefonnummer.',

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
