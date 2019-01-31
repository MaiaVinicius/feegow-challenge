<?php

return [

    /*
    | ------------------------------------------------- -------------------------
    | Linhas de Linguagem de Validação
    | ------------------------------------------------- -------------------------
    |
    | As seguintes linhas de idioma contêm as mensagens de erro padrão usadas por
    | a classe do validador. Algumas dessas regras possuem múltiplas versões, como
    | como as regras de tamanho. Não hesite em ajustar cada uma dessas mensagens aqui.
    |
    */

    'accepted' => 'O :attribute deve ser aceito.',
    'active_url' => 'O :attribute não é uma URL válida.',
    'after' => 'O :attribute deve ser uma data após :date.',
    'after_or_equal' => 'O :attribute deve ser uma data após ou igual a :date.',
    'alpha' => 'O :attribute deve conter apenas letras.',
    'alpha_dash' => 'O :attribute deve conter apenas letras, números, e traços.',
    'alpha_num' => 'O :attribute deve conter apenas letras e números.',
    'array' => 'O :attribute deve ser um array.',
    'before' => 'O :attribute deve ser uma data anterior a :date.',
    'before_or_equal' => 'O :attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => 'O :attribute deve ser entre :min e :max.',
        'file' => 'O :attribute deve ser entre :min e :max kilobytes.',
        'string' => 'O :attribute deve ser entre :min e :max caracteres.',
        'array' => 'O :attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => 'O :attribute deve ser true ou false.',
    'confirmed' => 'A confirmação do :attribute não confere.',
    'date' => 'O valor de :attribute não é uma data válida.',
    'date_format' => 'O :attribute não corresponde ao formato :format.',
    'different' => 'O :attribute e :other devem ser diferentes.',
    'digits' => 'O :attribute deve conter :digits dígitos.',
    'digits_between' => 'O :attribute deve conter entre :min e :max dígitos.',
    'dimensions' => 'O :attribute possui dimensões de imagem inválidas.',
    'distinct' => 'O campo :attribute possui um valor duplicado.',
    'email' => 'O :attribute deve ser um endereço de e-mail válido.',
    'exists' => 'O :attribute selecionado não é válido.',
    'file' => 'O :attribute deve ser um arquivo.',
    'filled' => 'O campo :attribute deve ser um valor.',
    'image' => 'O :attribute deve ser uma imagem.',
    'in' => 'O :attribute selecionado não é válido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O :attribute deve ser um inteiro.',
    'ip' => 'O :attribute deve ser um endereço IP válido.',
    'ipv4' => 'O :attribute deve ser um endereço IPv4 válido.',
    'ipv6' => 'O :attribute deve ser um endereço IPv6 válido.',
    'json' => 'O :attribute deve ser uma string JSON válida.',
    'max' => [
        'numeric' => 'O :attribute não deve ser maior que :max.',
        'file' => 'O :attribute não deve ser maior que :max kilobytes.',
        'string' => 'O :attribute não deve ser maior que :max caracteres.',
        'array' => 'O :attribute não deve ter mais que :max itens.',
    ],
    'mimes' => 'O :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O :attribute deve ser ao menos :min.',
        'file' => 'O :attribute deve conter ao menos :min kilobytes.',
        'string' => 'O :attribute deve conter ao menos :min caracteres.',
        'array' => 'O :attribute deve conter ao menos :min itens.',
    ],
    'not_in' => 'O :attribute informado não é válido.',
    'numeric' => 'O :attribute deve ser um número.',
    'present' => 'O campo :attribute deve estar presente.',
    'regex' => 'O formato de :attribute não é válido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless' => 'O campo :attribute é obrigatório a menos que :other esteja em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values esta presente.',
    'same' => 'O :attribute e :other devem ser iguais.',
    'size' => [
        'numeric' => 'O :attribute deve conter :size.',
        'file' => 'O :attribute deve conter :size kilobytes.',
        'string' => 'O :attribute deve conter :size caracteres.',
        'array' => 'O :attribute deve conter :size itens.',
    ],
    'string' => 'O :attribute deve ser a string.',
    'timezone' => 'O :attribute deve ser uma timezone válida.',
    'unique' => 'O :attribute já foi utilizado.',
    'uploaded' => 'O :attribute retornou uma falha e não foi atualizado.',
    'url' => 'O formato de :attribute não é válido.',

    /*
     | ------------------------------------------------- -------------------------
     | Linha de idioma de validação personalizada
     | ------------------------------------------------- -------------------------
     |
     | Aqui você pode especificar mensagens de validação personalizadas para atributos usando a
     | convenção "attribute.rule" para nomear as linhas. Isso torna rápido
     | especificar uma linha de idioma personalizado específica para uma determinada regra de atributo.
     |
     */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],




];
