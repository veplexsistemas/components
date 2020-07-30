<!--
    Componente DualList
    Parâmetros:
    $id    => Id dos campos para origem / destino
    $label => Label do campo
    $dados => Dados para exibição (JSON)
    $extra => Informações adicionais para o campo no html
-->

<script type="text/javascript">
  
    function selecionaTodos(id)
    {
      $('document').ready(function(){

        var id_campo = '#' + id + '_destino';
        
        for(i = 0; i < $(id_campo)[0].length; i++)
          $(id_campo)[0].options[i].selected = true;
      });
    }
    
    function adiciona(id)
    {
        $('#'+id).val().forEach(a => {
            $('#'+id+'_destino').append($('#'+id).find("[value='"+a+"']"));
        });
        
        selecionaTodos(id);
    }

    function adicionaTodos(id)
    {
        $('#'+id+'_destino').append($('#'+id+' option'));
        
        selecionaTodos(id);
    }

    function remove(id)
    {
        $('#'+id+'_destino').val().forEach(a => {
            $('#'+id).append($('#'+id+'_destino').find("[value='"+a+"']"));
        });
        
        selecionaTodos(id);
    }

    function removeTodos(id)
    {
        $('#'+id).append($('#'+id+'_destino option'));
        selecionaTodos(id);
    }
</script>

<style>
    .btn-veplex {    
        width: 30px;
        padding: 0px;
        font-size: 14px;
        margin: 3px 0px 0px 0px;
        font-weight: 400;
        text-align: center;
        background: linear-gradient(0.25turn, rgb(62, 108, 208), rgb(115,182,231))!important;
        border: 1px solid transparent;
        white-space: nowrap;           
        color:white;
        font-weight: bold;
        border-radius: 4px;
    }
    .btn-veplex:hover {
        color: #636b6f;
    }

    .duallist-veplex {        
        display: flex;
        padding: 0px;
        border: 1px solid #ced4da;
        border-top-left-radius: 0.25rem!important;
        border-top-right-radius: 0rem!important;
        border-bottom-left-radius: 0.25rem!important;
        border-bottom-right-radius: 0rem!important
    }

    .duallist-label-veplex {
        margin: 0px 0px 0px 15px;
        padding: 0.375rem 0.75rem;
        color: #495057;
        text-align: center;
        display: flex;
        align-items: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border-top-left-radius: 0.25rem!important;
        border-top-right-radius: 0rem!important;
        border-bottom-left-radius: 0.25rem!important;
        border-bottom-right-radius: 0rem!important
    }

    .duallist-select-veplex {}

    .duallist-acoes-veplex {        
        display: grid;
        align-content: center;        
        padding: 10px 5px 10px 5px;
    }
</style>

<div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 duallist-veplex">
        <!-- LABEL -->
        <label for="f_{{ $id }}" class="duallist-label-veplex">
            {{ $label }}
            @isset($tooltip)
                <img data-toggle="tooltip" data-placement="right" title="{{$tooltip}}" src="/img/informacao.png" height="22" width="22">
            @endisset
        </label>

        <!-- ORIGEM -->
        <select multiple class="form-control duallist-select-veplex" id="{{ $id }}" name="f_{{ $id }}">
            @forelse ($dados as $obj)
                <option value={{ $obj->value }}>{{ $obj->description }}</option>
            @empty
            @endforelse
        </select>

        <!-- AÇÕES -->
        <div class="duallist-acoes-veplex">            
            <input type="button" class="btn-veplex" id="{{ $id }}_btn_right"    value=">"  onclick="adiciona('{{ $id }}')">
            <input type="button" class="btn-veplex" id="{{ $id }}_btn_allright" value=">>" onclick="adicionaTodos('{{ $id }}')">
            <input type="button" class="btn-veplex" id="{{ $id }}_btn_allleft"  value="<<" onclick="removeTodos('{{ $id }}')">
            <input type="button" class="btn-veplex" id="{{ $id }}_btn_left"     value="<"  onclick="remove('{{ $id }}')">
        </div>

        <!-- DESTINO -->
        <select multiple class="form-control" id="{{ $id }}_destino" name="f_{{ $id }}_destino[]" {{ $extra or '' }}></select>
</div> 
</div>