@php
    $colspan = sizeof($fields) + (isset($extraFields) ? sizeof($extraFields) : 0);
@endphp

<div class="table-responsive">
    <table class="table table-sm table-striped table-hover" id="dataTable" cellspacing="0">
        <thead>
            <!-- Colunas -->
            <tr>
                <!-- Padrão -->
                @foreach ($fields as $label)
                    <th class="datagrid-th">{{ $label }}</th>
                @endforeach
                
                <!-- Extras -->
                @if (isset($extraFields))
                    @foreach ($extraFields as $arrExtra)
                        <th class="datagrid-th"></th>
                    @endforeach
                @endif
            </tr>
        </thead>
    
        </tbody>
        
            @forelse ($data as $objData)
                <tr>
                    @foreach ($fields as $field => $label)

                        <!-- Determina alinhamento da coluna -->
                        @php
                            if (isset($aligns) && (isset($aligns[$field])))
                                $align = $aligns[$field];
                            else
                            {
                                switch (substr($field, 0, 2))
                                {
                                    case 'cd':
                                    case 'vl':
                                        $align = 'right';
                                    break;

                                    case 'nm':
                                    case 'ds':
                                        $align = 'left';
                                    break;

                                    case 'dt':
                                    case 'id':
                                        $align = 'center';
                                    break;
                                }
                            }

                            $content = $objData->$field;
                            if (isset($callback) && (isset($callback[$field])))
                            {
                                $cb = $callback[$field];
                                if (count($cb) == 1)
                                {
                                    $content = call_user_func_array($cb[0], [$content]);
                                }
                                else
                                {
                                    array_unshift($cb[1], $content);
                                    $content = call_user_func_array($cb[0], $cb[1]);
                                }
                            }
                        @endphp

                        <!-- Linhas -->
                        <td style="text-align: {{ $align }}">{!! $content !!}</td>
                    @endforeach
                
                    <!-- Extra fields -->
                    @if (isset($extraFields))
                        @foreach ($extraFields as $arrExtra)
                            @php
                                $route = $arrExtra["route"];
                                
                                if (isset($arrExtra["content"]))
                                    $content = $arrExtra["content"];
                                elseif (isset($arrExtra['edit']))
                                    $content = "<i class=\"fa fa-edit fa-editar\" title=\"Editar\"></i>";
                                
                                $params  = $arrExtra["params"];                                
                                if (!is_array($params))
                                    $parameters = $objData->$params;
                                else
                                {
                                    $parameters = [];
                                    foreach ($params as $paramField) 
                                    {
                                        if (gettype($paramField) == "string")
                                            $parameters[] = $objData->$paramField;
                                        else
                                            $parameters[] = $paramField;
                                    }
                                }
                            @endphp

                            <td class="datagrid-extra-field"><a href="{{ route($route, $parameters) }}">{!! $content !!}</a></td>

                        @endforeach
                    @endif
                </tr>
            @empty
                <td colspan="{{ $colspan }}"><i>Sem Dados</i></td>
            @endforelse
    </table>             
</div>
   
<h2 class="paginador col-12">
    @if ( (!isset($pagination) || $pagination === true) && $data->count() > 0)    
        {{ $data->links() }}
    @endif
</h2>