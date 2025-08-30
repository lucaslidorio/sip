NOVA MENSAGEM DE CONTATO
{{ $dados['tenant']->nome }}
{{ str_repeat('=', 50) }}

INFORMAÇÕES DO REMETENTE:
Nome: {{ $dados['nome'] }}
Email: {{ $dados['email'] }}
@if($dados['telefone'])
Telefone: {{ $dados['telefone'] }}
@endif
@if($dados['assunto'])
Assunto: {{ $dados['assunto'] }}
@endif
Data de Envio: {{ $dados['data_envio'] }}

{{ str_repeat('-', 50) }}

MENSAGEM:
{{ $dados['mensagem'] }}

{{ str_repeat('-', 50) }}

INFORMAÇÕES TÉCNICAS:
IP de Origem: {{ $dados['ip_origem'] }}
Data/Hora: {{ $dados['data_envio'] }}

{{ str_repeat('=', 50) }}
{{ $dados['tenant']->nome }}
@if($dados['tenant']->endereco)
{{ $dados['tenant']->endereco }}
@endif
@if($dados['tenant']->telefone)
Telefone: {{ $dados['tenant']->telefone }}
@endif
@if($dados['tenant']->email)
Email: {{ $dados['tenant']->email }}
@endif

Esta mensagem foi enviada através do formulário de contato do site oficial.

