<?php

namespace Faker\Provider\pt_BR;

require_once 'check_digit.php';

class Company extends \Faker\Provider\Company
{
    protected static $formats = [
        '{{lastName}} {{companySuffix}}',
        '{{lastName}}-{{lastName}}',
        '{{lastName}} e {{lastName}}',
        '{{lastName}} e {{lastName}} {{companySuffix}}',
        '{{lastName}} Comercial Ltda.',
    ];

    /**
     * Brazilian job titles
     *
     * @see http://www.mtecbo.gov.br/cbosite/pages/downloads.jsf
     */
    protected static $jobTitleFormat = [
        'Advogado', 'Ajudante de Obras', 'Alfaiate', 'Analista de Sistemas', 'Arquivista',
        'Assistente Social', 'Atendente de Loja', 'Auxiliar Administrativo', 'Auxiliar de Enfermagem',
        'Auxiliar de Escritório', 'Auxiliar de Limpeza', 'Bombeiro civil', 'Chapeiro', 'Contador',
        'Costureira em geral', 'Cozinheiro geral', 'Desenhista Técnico', 'Eletricista', 'Enfermeiro',
        'Engenheiro Civil', 'Estoquista', 'Faxineiro', 'Ferreiro', 'Gerente de marketing', 'Gerente de recursos humanos',
        'Guarda-vidas', 'Manicure/pedicure', 'Manobrista', 'Mecânico', 'Médico clínico geral', 'Motorista de caminhão',
        'Operador de Caixa', 'Operador de Telemarketing', 'Pedreiro', 'Produtor rural na agropecuária',
        'Professor de Ensino Fundamental', 'Professor de inglês', 'Programador de sistemas de informação',
        'Recepcionista', 'Secretária', 'Servente de Obras', 'Soldador', 'Supervisor Administrativo',
        'Técnico em Administração', 'Técnico em Segurança do Trabalho', 'Veterinário',
    ];

    protected static $companySuffix = ['e Filhos', 'e Associados', 'Ltda.', 'S.A.'];

    /**
     * A random CNPJ number.
     *
     * @see http://en.wikipedia.org/wiki/CNPJ
     *
     * @param bool $formatted If the number should have dots/slashes/dashes or not.
     *
     * @return string
     */
    public function cnpj($formatted = true)
    {
        $n = $this->generator->numerify('########0001');
        $n .= check_digit($n);
        $n .= check_digit($n);

        return $formatted ? vsprintf('%d%d.%d%d%d.%d%d%d/%d%d%d%d-%d%d', str_split($n)) : $n;
    }
}
