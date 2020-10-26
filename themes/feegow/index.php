<div class="main_background">
    <div class="main_background_desc">
        <h2>Software para clínicas, <br>médicas e consultórios</h2>
        <p>Gestão de agendas, prontuários, financeiro e <br>faturamento que simplificam o seu dia a dia!</p>
        <a data-scroll="app_schedule" href="" title="Agendar Consulta">Agendar Consulta</a>
    </div>
</div>

<section class="app_about">
    <div class="container">
        <h2>Software para clínicas médicas amigável, rápido e <span>certificado</span> pela SBIS-CFM.</h2>
        <p>O sistema para clínicas médicas com mais recursos do mercado! Com uma interface intuitiva, o Feegow Clinic oferece mais de 200 funcionalidades para descomplicar o seu dia a dia.</p>
        <div class="app_about_content">
            <div class="app_about_img">
                <img src="<?= INCLUDE_PATH; ?>/images/ipad.png" title="Ipad" alt="Ipad"/>
            </div>

            <div class="app_about_itens">
                <article class="app_about_itens_item">
                    <div class="app_about_itens_item_img">
                        <img src="<?= INCLUDE_PATH; ?>/images/icon1.png" title="Benefícios" alt="Benefícios"/>
                    </div>
                    <h3>Gestão de Agendas</h3>
                    <p>Gerencie os horários da sua clínica ou consultório com máxima eficiência! A Agenda Feegow é sua melhor parceria para gerir horários, organizar fila de espera, remarcar com faltosos e desmarcados, interagir com Agenda Google e muito mais!</p>
                </article>

                <article class="app_about_itens_item">
                    <div class="app_about_itens_item_img">
                        <img src="<?= INCLUDE_PATH; ?>/images/icon2.png" title="Benefícios" alt="Benefícios"/>
                    </div>
                    <h3>Prontuário Eletrônico</h3>
                    <p>A tecnologia a seu favor! Anamneses, evoluções e laudos personalizados a um clique de você, arquivos dos pacientes disponíveis facilmente, emissão de atestados, prescrições de medicamentos e fórmulas com bulário integrado.</p>
                </article>

                <article class="app_about_itens_item">
                    <div class="app_about_itens_item_img">
                        <img src="<?= INCLUDE_PATH; ?>/images/icon3.png" title="Benefícios" alt="Benefícios"/>
                    </div>
                    <h3>Financeiro</h3>
                    <p>Seu setor de finanças seguro e organizado! Controle seus dados e de seus pacientes com proteção, organize fluxo de caixa, tenha domínio de recebimento e emissão de cheques, administre uso de cartões de débito e crédito, e outros tantos recursos.</p>
                </article>

                <article class="app_about_itens_item">
                    <div class="app_about_itens_item_img">
                        <img src="<?= INCLUDE_PATH; ?>/images/icon4.png" title="Benefícios" alt="Benefícios"/>
                    </div>
                    <h3>Autorizador de Convênios</h3>
                    <p>Comodidade para o seu paciente e coordenação eficaz para sua clínica ou consultório. Autorização online e facilitada, emissão de guias de consulta, além de integração com Financeiro. Tudo para o funcionamento perfeito de utilização de convênios.</p>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="app_cta">
    <div class="container">
        <h2>Convênios – TISS</h2>
        <p>Pagamento <span>Integrado</span> e Autorizador <span>Online.</span></p>
        <div class="app_cta_content">
            <div class="app_cta_box">
                <h3>Controle financeiro da sua clínica ou consultório na palma da sua mão</h3>
                <p>Acompanhe minuciosamente o desenvolvimento financeiro da sua empresa através desta poderosa ferramenta!</p>
                <a data-scroll="app_schedule" title="Agendar Consulta">Agendar Consulta</a>
            </div>

            <div class="app_cta_img">
                <img src="<?= INCLUDE_PATH; ?>/images/mobile.png" title="Mobile" alt="Mobile"/>
            </div>
        </div>
    </div>
</section>

<section class="app_schedule">
    <div class="container">
        <h2>Agende sua consulta <span>com rapidez</span> e segurança.</h2>
        <p>Através de nosso site ou aplicativo, é possível escolher a especialidade, o médico e agendar suas consultas e de forma rápida e fácil.</p>

        <div class="app_schedule_content" >
            <form name="specialty_form" id="container_specialty">
                <div class="app_schedule_specialty">
                    <div class="app_schedule_specialty_label">
                        <span>Consulta de</span>
                    </div>

                    <div class="app_schedule_specialty_select">
                        <select name="specialties" id="specialties">
                            <option value="">Selecione a Especialidade</option>
                        </select>
                    </div>
                </div>
            </form>

            <div class="app_schedule_professional" id="container"></div>

            <div class="app_schedule_data" id="container_data">
                <h3>Preencha Seus Dados</h3>
                <form name="form_data">
                    <input type="hidden" name="specialty_id" id="specialty_id">
                    <input type="hidden" name="professional_id" id="professional_id">

                    <div class="app_schedule_data_form">
                        <div class="app_schedule_data_input">
                            <input type="text" name="name" placeholder="Nome Completo" required/>
                        </div>

                        <div class="app_schedule_data_input">
                            <select id="source" name="source_id" required>
                                <option value="">Como Nos Conheceu?</option>
                            </select>
                        </div>

                        <div class="app_schedule_data_input">
                            <input type="text" name="birthdate" class="formDate" placeholder="Data de Nascimento" required/>
                        </div>

                        <div class="app_schedule_data_input">
                            <input type="text" name="cpf" class="formCpf" placeholder="CPF" required/>
                        </div>

                        <div class="app_schedule_data_button">
                            <button type="button" class="btn_cancel" title="Cancelar">Cancelar</button>
                            <button type="submit" class="btn_schedule" title="Solicitar Horários">Solicitar Horários</button>
                        </div>
                    </div>
                </form>
            </div>
            <div style="display: none;" class="container_sended j_container_sended">
                <span class="h2"><span>&#10003;</span> Solicitação Enviada Com Sucesso!</span>
                <span class="text"><b>Prezado(a) <span class="j_sended_name">NOME</span>. Obrigado Pelo
                        Contato,</b></span>
                <span class="text">Informamos que recebemos sua mensagem, e que vamos responder o mais breve
                    possível.</span>
                <span class="text"><em>Atenciosamente - Feegow Clinic</em></span>
                <span title="Fechar" class="btn btn_red j_container_sended_close" style="margin-top: 20px;">FECHAR</span>
            </div>
        </div>
    </div>
</section>

