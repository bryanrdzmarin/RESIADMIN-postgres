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

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'active_url' => 'El campo :attribute no es una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo puede contener letras.',
    'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
    'array' => 'El campo :attribute debe ser un array.',
    'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file' => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string' => 'El campo :attribute debe contener entre :min y :max caracteres.',
        'array' => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'El campo confirmación de :attribute no coincide.',
    'date' => 'El campo :attribute no corresponde con una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'different' => 'Los campos :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe ser un número de :digits dígitos.',
    'digits_between' => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'dimensions' => 'El campo :attribute tiene dimensiones de imagen inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'exists' => 'El campo :attribute seleccionado no existe.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'file' => 'El archivo :attribute debe pesar más de :value kilobytes.',
        'string' => 'El campo :attribute debe contener más de :value caracteres.',
        'array' => 'El campo :attribute debe contener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
        'file' => 'El archivo :attribute debe pesar :value o más kilobytes.',
        'string' => 'El campo :attribute debe contener :value o más caracteres.',
        'array' => 'El campo :attribute debe contener :value o más elementos.',
    ],
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El campo :attribute seleccionado no es válido.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file' => 'El archivo :attribute no debe pesar más de :max kilobytes.',
        'string' => 'El campo :attribute no debe contener más de :max caracteres.',
        'array' => 'El campo :attribute no debe contener más de :max elementos.',
    ],
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file' => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string' => 'El campo :attribute debe contener al menos :min caracteres.',
        'array' => 'El campo :attribute debe contener al menos :min elementos.',
    ],
    'not_in' => 'El campo :attribute seleccionado no es válido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'regex' => 'El formato del campo :attribute no es válido.',
    'required' => 'El campo :attribute es obligatorio.',
    'unique' => 'El campo :attribute ya ha sido tomado.',
    'url' => 'El campo :attribute debe ser una URL válida.',
    'uuid' => 'El campo :attribute debe ser un UUID válido.',
    'valid_role' => 'Este campo debe ser un rol válido.',
    'min_length_number' => 'Este campo debe tener al menos :length caracteres y contener al menos un número.',
    'min_length_special_number' => 'Este campo debe tener al menos :length caracteres y contener al menos un carácter especial y un número.',
    'min_length_special' => 'Este campo debe tener al menos :length caracteres y contener al menos un carácter especial.',
    'min_length_upper_number' => 'Este campo debe tener al menos :length caracteres y contener al menos una letra mayúscula y un número.',
    'min_length_upper_special' => 'Este campo debe tener al menos :length caracteres y contener al menos una letra mayúscula y un carácter especial.',
    'min_length_upper_number_special' => 'Este campo debe tener al menos :length caracteres y contener al menos una letra mayúscula, un número y un carácter especial.',
    'min_length_upper' => 'Este campo debe tener al menos :length caracteres y contener al menos una letra mayúscula.',
    'min_length' => 'Este campo debe tener al menos :length caracteres.',
    'contains_letter' => 'Este campo debe contener al menos una letra.',
    'contains_number' => 'Este campo debe contener al menos un número.',
    'contains_symbol' => 'Este campo debe contener al menos un símbolo.',
    'contains_upper_lower' => 'Este campo debe contener al menos una letra mayúscula y una minúscula.',
    'data_leak' => 'El campo ingresado ha aparecido en una filtración de datos.',



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
            'rule-name' => 'mensaje-personalizado',
        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
