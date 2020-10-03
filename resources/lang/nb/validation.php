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

    'accepted'             => ':attribute må aksepteres.',
    'active_url'           => ':attribute er ikke en gyldig nettadresse.',
    'after'                => ':attribute må være en dato etter :date.',
    'after_or_equal'       => ':attribute må være en dato etter eller lik :date.',
    'alpha'                => ':attribute kan bare inneholde bokstaver.',
    'alpha_dash'           => ':attribute kan bare inneholde bokstaver, tall og bindestreker.',
    'alpha_num'            => ':attribute kan bare inneholde bokstaver og tall.',
    'array'                => ':attribute må være en array.',
    'before'               => ':attribute må være en dato før :date.',
    'before_or_equal'      => ':attribute må være en dato før eller lik :date.',
    'between'              => [
        'numeric' => ':attribute må være mellom :min og :max.',
        'file'    => ':attribute må være mellom :min og :max kilobytes.',
        'string'  => ':attribute må være mellom :min og :max tegn.',
        'array'   => ':attribute må ha mellom :min og :max elementer.',
    ],
    'boolean'              => ':attribute feltet må være sant eller falskt.',
    'confirmed'            => ':attribute bekreftelsen stemmer ikke overens.',
    'date'                 => ':attribute er ikke en gyldig dato.',
    'date_format'          => ':attribute stemmer ikke overens med formatet :format.',
    'different'            => ':attribute og :other må være annerledes.',
    'digits'               => ':attribute må være :digits sifre.',
    'digits_between'       => ':attribute må være mellom :min og :max sifre.',
    'dimensions'           => ':attribute har ugyldige bildedimensjoner.',
    'distinct'             => ':attribute feltet har en duplikatverdi.',
    'email'                => ':attribute må være en gyldig e-postadresse.',
    'exists'               => 'Valgt :attribute er ugyldig.',
    'file'                 => ':attribute må være en fil.',
    'filled'               => ':attribute feltet må ha en verdi.',
    'image'                => ':attribute må være et bilde.',
    'in'                   => 'Valgt :attribute er ugyldig.',
    'in_array'             => ':attribute feltet eksisterer ikke i :other.',
    'integer'              => ':attribute må være et heltall.',
    'ip'                   => ':attribute må være en gyldig IP-adresse.',
    'ipv4'                 => ':attribute må være en gyldig IPv4-adresse.',
    'ipv6'                 => ':attribute må være en gyldig IPv6-adresse.',
    'json'                 => ':attribute må være en gyldig JSON-streng.',
    'max'                  => [
        'numeric' => ':attribute må ikke være større enn :max.',
        'file'    => ':attribute må ikke være større enn :max kilobytes.',
        'string'  => ':attribute må ikke være større enn :max tegn.',
        'array'   => ':attribute må ikke være større enn :max elementer.',
    ],
    'mimes'                => ':attribute må være en fil av typen: :values.',
    'mimetypes'            => ':attribute må være en fil av typen: :values.',
    'min'                  => [
        'numeric' => ':attribute må være minst :min.',
        'file'    => ':attribute må være minst :min kilobytes.',
        'string'  => ':attribute må være minst :min tegn.',
        'array'   => ':attribute må være minst :min elementer.',
    ],
    'not_in'               => 'Valgt :attribute er ugyldig.',
    'numeric'              => ':attribute må være et nummer.',
    'present'              => ':attribute feltet må være til stede.',
    'regex'                => ':attribute formatet er ugyldig.',
    'required'             => ':attribute feltet er påkrevd.',
    'required_if'          => ':attribute feltet er nødvendig når :other er :value.',
    'required_unless'      => ':attribute feltet er nødvendig med mindre :other er i :values.',
    'required_with'        => ':attribute feltet er nødvendig når :values er tilstede.',
    'required_with_all'    => ':attribute feltet er nødvendig når :values er tilstede.',
    'required_without'     => ':attribute feltet er nødvendig når :values er ikke til stede.',
    'required_without_all' => ':attribute feltet er nødvendig når ingen av :values er tilstede.',
    'same'                 => ':attribute og :other må samsvare.',
    'size'                 => [
        'numeric' => ':attribute må være :size.',
        'file'    => ':attribute må være :size kilobytes.',
        'string'  => ':attribute må være :size tegn.',
        'array'   => ':attribute må inneholde :size elementer.',
    ],
    'string'               => ':attribute må være en streng.',
    'timezone'             => ':attribute må være en gyldig sonee.',
    'unique'               => ':attribute har allerede blitt tatt.',
    'uploaded'             => ':attribute klarte ikke å laste opp.',
    'url'                  => ':attribute formatet er ugyldig.',

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

    'phone' => ':attribute feltet inneholder et ugyldig telefonnummer.',
    'OlderThan' => 'Du må være eldre enn :age år gammel.',
    'YoungerThan' => 'Du må være yngre enn :age år gammel.',

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
