
<div class="modal fade" id="novaConsulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form method="post" id="form_cadastra" action="{{ route('consulta.store') }}">
            @csrf
            <div class="modal-content">
            <input type="hidden" name="id" id="id" value="" />
                <input type="hidden" name="paciente_id" id="paciente_id" value="{{ $paciente->id ?? old('paciente_id') }}" />                            
                <div class="modal-body">
                    <h4>Consulta</h4>

                    Início da consulta:
                    <br />
                    <input type="datetime-local" class="form-control" name="inicio_consulta" id="inicio_consulta" required>

                    Fim da consulta:
                    <br />
                    <input type="datetime-local" class="form-control" name="fim_consulta" id="fim_consulta" required>
                
                    Tratamento:
                    <br />
                    <select name="tratamento_id" id="tratamento_id" class="form-control">
                        @foreach($tratamentos as $tratamento)
                        <option value="{{ $tratamento->id }}"> {{ $tratamento->tratamento }} R$ {{ number_format($tratamento->valor, 2, ",", ".") }}</option>
                        @endforeach
                    </select>    
                    
                    Forma de pagamento:
                    <br />
                    <select name="pagamento_id" id="pagamento_id" class="form-control">
                        @foreach($pagamentos as $pagamento)
                        <option value="{{ $pagamento->id }}"> {{ $pagamento->forma_pagamento }}</option>
                        @endforeach
                    </select> 
                    
                    Pagamento:
                    <br />
                    <select name="pagamento" id="pagamento" class="form-control">
                        <option value="pendente">Pendente</option>
                        <option value="realizado">Realizado</option>
                    </select>                                      
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" >Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="atualizaConsulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form method="post" id="form_atualiza">
            @csrf
            @method('PUT')
            <div class="modal-content">
            <input type="hidden" name="id" id="a_id" value="" />
                <input type="hidden" name="event_id" id="event_id" value="" />
                <input type="hidden" name="paciente_id" id="a_paciente_id" value="{{ $paciente->id ?? old('paciente_id') }}" />                            
                <div class="modal-body">
                    <h4>Consulta</h4>

                    Início da consulta:
                    <br />
                    <input type="datetime-local" class="form-control" name="inicio_consulta" id="a_inicio_consulta" required>

                    Fim da consulta:
                    <br />
                    <input type="datetime-local" class="form-control" name="fim_consulta" id="a_fim_consulta" required>
                
                    Tratamento:
                    <br />
                    <select name="tratamento_id" id="a_tratamento_id" class="form-control">
                        @foreach($tratamentos as $tratamento)
                        <option value="{{ $tratamento->id }}"> {{ $tratamento->tratamento }} R$ {{ number_format($tratamento->valor, 2, ",", ".") }}</option>
                        @endforeach
                    </select>    
                    
                    Forma de pagamento:
                    <br />
                    <select name="pagamento_id" id="a_pagamento_id" class="form-control">
                        @foreach($pagamentos as $pagamento)
                        <option value="{{ $pagamento->id }}"> {{ $pagamento->forma_pagamento }}</option>
                        @endforeach
                    </select> 
                    
                    Pagamento:
                    <br />
                    <select name="pagamento" id="a_pagamento" class="form-control">
                        <option value="pendente">Pendente</option>
                        <option value="realizado">Realizado</option>
                    </select>                                      
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="consulta_update">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>