<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Cédula C</title>
</head>

<body>
    <div class="wrap">
        <article class="artigo">
            <div class="cabe1">
                <figure class="brasao_federal"><img class="brasao" src="{{asset('assets/img/brasao_federal.jpg')}}">
                </figure>
                <strong>Ministério da Fazenda<br></strong>Secretaria da Receita Federal do Brasil<br>
                Imposto sobre a renda da Pessoa Física<br><span>Exercício de 2015</span>
            </div>
            <div class="cabe2">Comprovante de Rendimento Pagos de<br> Imposto sobre a renda Retido na Fonte<br>
                <span>Ano-calendário de 2014</span>
            </div>
            <div class="texto"> Verifique as condições e o prazo para a apresentação da Declaração do Imposto sobre a
                Renda da Pessoa
                Física ara este ano-calendário no site da Secretaria da Receita Federal do Brasil na Internet, no
                endereço
                <www.receita.fazenda.gov.br></www.receita.fazenda.gov.br>
            </div>

            <div class="box1">
                <h1>1.Fonte Pagadora Pessoa Jurídica</h1>
                <div class="box2">
                    <div class="div_font1"><span>CNPJ</span>
                        {{$config->doc}}
                    </div>
                    <div class="div_font2"><span>Nome empresarial</span>
                        {{$config->font}}
                    </div>
                </div>
            </div>

            <div class="box1">
                <h1>2.Pessoa Física Beneficiária dos Rendimentos</h1>
                <div class="box2">
                    <div class="div_font1"><span>CPF</span>
                        {{$server->cpf}}
                    </div>
                    <div class="div_font2"><span>Nome Completo</span>
                        {{$server->name}}
                    </div>
                    <div class="div_font3"><span>Natureza do rendimento</span>
                        {{$nature}}
                    </div>
                </div>
            </div>

            <div class="box1">
                <h1>3.Rendimentos Tributáveis, Deduções e Impostos sobre a Renda Retido na Fonte</h1>
                <h1 class="direita">Valores em reais</h1>
                <div class="box2">
                    <div class="div_rend1"><span>1.Total dos rendimentos (inclusive férias)</span></div>
                    <div class="div_rend2">
                        <span>
                            {{@$values['RTRT']}}
                        </span>
                    </div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>2.Contribuição previdenciária oficial</span></div>
                    <div class="div_rend2">
                        <span>
                            {{@$values['RTPO']}}
                        </span>
                    </div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>
                            3.Contribuições a entidades de previdência complementar e a fundos de
                            aposentadoria prog.<br> individual (FABI)
                            <strong>
                                (preencher também o quadro 7)
                            </strong>
                        </span>
                    </div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>
                            4.Pensão alimentícia
                            <strong>
                                (preencher também o quadro 7)
                            </strong>
                        </span>
                    </div>
                    <div class="div_rend2">
                        <span>
                            {{@$values['RTPA']}}
                        </span>
                    </div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>
                            5.Imposto sobre a renda retido na fonte
                        </span>
                    </div>
                    <div class="div_rend2">
                        <span>
                            {{@$values['RTIRF']}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="box1">
                <h1>4.Rendimento Isentos e Não Tributáveis</h1>
                <h1 class="direita">Valores em reais</h1>
                <div class="box2">
                    <div class="div_rend1">
                        <span>1.Parcela isenta dos proventos de aposentadoria, reserva remunerada,
                            reforma e oensão (65 anos ou mais)
                        </span>
                    </div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>2.Diárias e ajudas de custos</span>
                    </div>
                    <div class="div_rend2">
                        <span>
                            {{@$values['RIDAC']}}
                        </span>
                    </div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>3.Pensão e proventos de aposentadoria ou reforma por moléstia grave;
                            proventos de aposentadoria ou reforma por acidente em serviço
                        </span>
                    </div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>
                            4.Lucros e dividendis, apurados a partir de 1996, pagos por pessoas jurídica
                            (lucro real, presumido ou arbitrado)
                        </span>
                    </div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>5.Valores pagos ao titular ou sócio da microempresa ou emoresa de pequeno
                            porte, exceto pro labore, aluguéis ou serviços prestados
                        </span>
                    </div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>
                            6.Indenizações por recisão de contrato de trabalho, inclusive a
                            título de PDV, e por acidente de trabalho
                        </span>
                    </div>
                    <div class="div_rend2">
                        <span>
                            {{@$values['RTIIRP']}}
                        </span>
                    </div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>7.Outros (Aux. transp/devolução/abono)</span></div>
                    <div class="div_rend2">
                        <span>
                            {{@$values['RIO']}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="box1">
                <h1>5.Rendimentos sujeitos à Tributação Exclusiva (rendimento líquido)</h1>
                <h1 class="direita">Valores em reais</h1>
                <div class="box2">
                    <div class="div_rend1"><span>1.Décimo terceiro salário</span></div>
                    <div class="div_rend2">
                        <span>
                            {{@$val13['decimo']}}
                        </span>
                    </div>
                </div>
                <div class="box2">
                    <div class="div_rend1">
                        <span>2.Imposto sobre a renda retida na fonte 13º salário</span>
                    </div>
                    <div class="div_rend2">
                        <span>
                            {{@$val13['RTIRF']}}
                        </span>
                    </div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>3.Outros</span></div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
            </div>

            {{-- <div class="box1">
                <h1>6.Rendimento Recebidos Acumuladamente - Art. 12-A da Lei nº7.713, de 1988 (sujeito à tributação exclusiva)</h1>
                <div class="box3">
                    <div class="box3_1">6.1<span>Número do processo:</span></div>
                    <div class="box3_2">Quantidade de meses</div>
                    <div class="box3_3">0,0</div>
                    <div class="box3_4">Natureza do rendimento:</div>
                </div>
                <h1 class="direita">Valores em reais</h1>
                <div class="box2">
                    <div class="div_rend1"><span>1.Total dos rendimentos tributáveis (inclusive férias e décimo terceiro salário)</span></div>

                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>2.Exclusão: Despesas com ação judicial</span></div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>3.Dedução: Contribuição previdenciária oficial</span></div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>4.Dedução: Pensão alimentícia<strong>(preencher também o quadro 7)</strong></span></div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>5.Imposto sobre a renda retido na fonte</span></div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
                <div class="box2">
                    <div class="div_rend1"><span>6.Rendimentos isentos de pensão, proventos de aposentadoria ou reforma
                        por moléstia grave ou aposentadoria ou reforma por acidente em serviço</span></div>
                    <div class="div_rend2"><span>0,00</span></div>
                </div>
            </div> --}}
        </article>
    </div>

</body>

</html>
