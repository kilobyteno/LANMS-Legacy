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

    'accepted'             => 'Du behöver godkänna :attribute.',
    'active_url'           => ':attribute är inte en giltig länk.',
    'after'                => ':attribute måste vara ett datum efter :date.',
    'after_or_equal'       => ':attribute måste vara ett datum efter :date.',
    'alpha'                => ':attribute får bara innehålla bokstäver.',
    'alpha_dash'           => ':attribute får bara innehålla bokstäver, siffror, och streck.',
    'alpha_num'            => ':attribute får bara innehålla siffror och bokstäver.',
    'array'                => ':attribute måste vara en array.',
    'before'               => ':attribute måste vara ett datum före :date.',
    'before_or_equal'      => ':attribute måste vara ett datum före :date.',
    'between'              => [
        'numeric' => ':attribute måste vara mellan :min och :max.',
        'file'    => ':attribute måste vara mellan :min och :max kilobyte.',
        'string'  => ':attribute måste vara mellan :min och :max tecken.',
        'array'   => ':attribute måste ha mellan :min och :max föremål.',
    ],
    'boolean'              => ':attribute måste vara sant eller falskt.',
    'confirmed'            => ':attribute bekräftelsen stämmer inte.',
    'date'                 => ':attribute är inte ett giltigt datum.',
    'date_format'          => ':attribute matchar inte formatet :format.',
    'different'            => ':attribute och :other måste var annorlunda.',
    'digits'               => ':attribute måste vara :digits siffror.',
    'digits_between'       => ':attribute måste vara mellan :min och :max siffror.',
    'dimensions'           => ':attribute har fel upplösning på bilden.',
    'distinct'             => ':attribute har ett dublettvärde.',
    'email'                => ':attribute måste vara en giltig e-postadress.',
    'exists'               => ':attribute är ogiltig.',
    'file'                 => ':attribute måste vara en fil.',
    'filled'               => ':attribute alla fält måste vara ifyllda.',
    'image'                => ':attribute måste vara en bild. Kolla så du har rätt format.',
    'in'                   => 'Den valda :attribute är ogiltig.',
    'in_array'             => ':attribute existerar inte i :other.',
    'integer'              => ':attribute måste vara ett heltal.',
    'ip'                   => ':attribute måste vara en giltig IP address.',
    'ipv4'                 => ':attribute måste vara en giltig IPv4 address.',
    'ipv6'                 => ':attribute måste vara en giltig IPv6 address.',
    'json'                 => ':attribute måste vara en giltig JSON string.',
    'max'                  => [
        'numeric' => ':attribute får inte vara större än :max.',
        'file'    => ':attribute får inte vara större än :max kilobyte.',
        'string'  => ':attribute får inte vara längre än :max tecken.',
        'array'   => ':attribute får inte ha mer än :max föremål.',
    ],
    'mimes'                => ':attribute måste vara en av följande filtyper: :values.',
    'mimetypes'            => ':attribute måste vara en av följande filtyper: :values.',
    'min'                  => [
        'numeric' => ':attribute måste vara minst :min.',
        'file'    => ':attribute måste vara minst :min kilobyte.',
        'string'  => ':attribute måste ha minst :min tecken.',
        'array'   => ':attribute måste ha minst :min föremål.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => ':attribute fältet måste finnsa.',
    'regex'                => ':attribute formatet är ogiltigt.',
    'required'             => ':attribute fältet är obligatoriskt.',
    'required_if'          => ':attribute fältet är obligatoriskt när :other är :value.',
    'required_unless'      => ':attribute krävs om inte :other är i :values.',
    'required_with'        => ':attribute fältet krävs när :values är valt.',
    'required_with_all'    => ':attribute krävs när :values är valt.',
    'required_without'     => ':attribute krävs när :values inte är valt.',
    'required_without_all' => ':attribute fältet krävs när ingen av :values är valda',
    'same'                 => ':attribute och :other måste matcha.',
    'size'                 => [
        'numeric' => ':attribute måste vara :size.',
        'file'    => ':attribute måste vara :size kilobyte.',
        'string'  => ':attribute måste vara :size tecken.',
        'array'   => ':attribute måste innehålla :size föremål.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => ':attribute måste vara en giltig tidszon.',
    'unique'               => ':attribute används redan och är upptaget.',
    'uploaded'             => ':attribute misslyckades att ladda upp.',
    'url'                  => ':attribute formatet är ogiltigt.',

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

    'OlderThan' => 'Du behöver vara äldre än :age år gammal.',
    'YoungerThan' => 'Du behöver vara yngre än :age år gammal.',
    'phone' => ':attribute fältet har ett ogiltig telefonnummer.',

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
