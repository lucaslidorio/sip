<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato via Site - {{ $dados['tenant']->nome }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        .email-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .email-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .email-body {
            padding: 30px 20px;
        }
        
        .contact-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #28a745;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: center;
        }
        
        .info-row:last-child {
            margin-bottom: 0;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
            min-width: 100px;
            margin-right: 15px;
        }
        
        .info-value {
            color: #333;
            flex: 1;
        }
        
        .message-section {
            margin-top: 25px;
        }
        
        .message-title {
            font-size: 18px;
            font-weight: 600;
            color: #28a745;
            margin-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 8px;
        }
        
        .message-content {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            border-left: 4px solid #28a745;
            font-size: 15px;
            line-height: 1.7;
            white-space: pre-wrap;
        }
        
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .footer-info {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 10px;
        }
        
        .footer-warning {
            font-size: 11px;
            color: #868e96;
            font-style: italic;
        }
        
        .icon {
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-right: 8px;
            vertical-align: middle;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 8px;
            background: #28a745;
            color: white;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .email-header {
                padding: 20px 15px;
            }
            
            .email-body {
                padding: 20px 15px;
            }
            
            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-label {
                margin-bottom: 5px;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>📧 Nova Mensagem de Contato</h1>
            <p>{{ $dados['tenant']->nome }}</p>
        </div>
        
        <!-- Body -->
        <div class="email-body">
            <!-- Informações do Remetente -->
            <div class="contact-info">
                <div class="info-row">
                    <span class="info-label">👤 Nome:</span>
                    <span class="info-value"><strong>{{ $dados['nome'] }}</strong></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">📧 Email:</span>
                    <span class="info-value">
                        <a href="mailto:{{ $dados['email'] }}" style="color: #28a745; text-decoration: none;">
                            {{ $dados['email'] }}
                        </a>
                    </span>
                </div>
                
                @if($dados['telefone'])
                <div class="info-row">
                    <span class="info-label">📞 Telefone:</span>
                    <span class="info-value">
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $dados['telefone']) }}" 
                           style="color: #28a745; text-decoration: none;">
                            {{ $dados['telefone'] }}
                        </a>
                    </span>
                </div>
                @endif
                
                @if($dados['assunto'])
                <div class="info-row">
                    <span class="info-label">🏷️ Assunto:</span>
                    <span class="info-value">
                        <span class="badge">{{ $dados['assunto'] }}</span>
                    </span>
                </div>
                @endif
                
                <div class="info-row">
                    <span class="info-label">📅 Data:</span>
                    <span class="info-value">{{ $dados['data_envio'] }}</span>
                </div>
            </div>
            
            <!-- Mensagem -->
            <div class="message-section">
                <h2 class="message-title">💬 Mensagem</h2>
                <div class="message-content">{{ $dados['mensagem'] }}</div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-info">
                <strong>{{ $dados['tenant']->nome }}</strong><br>
                @if($dados['tenant']->endereco)
                    📍 {{ $dados['tenant']->endereco }}<br>
                @endif
                @if($dados['tenant']->telefone)
                    📞 {{ $dados['tenant']->telefone }}<br>
                @endif
                @if($dados['tenant']->email)
                    📧 {{ $dados['tenant']->email }}
                @endif
            </div>
            
            <div class="footer-warning">
                Esta mensagem foi enviada através do formulário de contato do site oficial.<br>
                IP de origem: {{ $dados['ip_origem'] }} | Data: {{ $dados['data_envio'] }}
            </div>
        </div>
    </div>
</body>
</html>

