# Sistema de Contador de Visitas

## 📋 Implementação Completa

Este sistema foi implementado no seu projeto Laravel para rastrear visitas ao site.

## 🗄️ Estrutura Criada

### 1. **Migrations**
- `2025_10_24_000001_create_site_visits_table.php`
  - Tabela `site_visits`: Registra cada visita individual
  - Tabela `site_visits_counter`: Contador agregado diário (otimizado)

### 2. **Models**
- `App\Models\SiteVisit`: Gerencia registro de visitas
- `App\Models\SiteVisitCounter`: Contador otimizado

### 3. **Middleware**
- `App\Http\Middleware\TrackSiteVisits`: Registra automaticamente as visitas

### 4. **Components Blade**
- `resources/views/components/site-visit-counter.blade.php`: Widget completo com estatísticas
- `resources/views/components/visit-counter-simple.blade.php`: Widget simples para rodapé

## 🚀 Como Usar

### Passo 1: Executar a Migration

```bash
php artisan migrate
```

### Passo 2: O middleware já foi registrado automaticamente no Kernel.php

### Passo 3: Usar os Componentes nas Views

#### Opção A: Widget Completo (para páginas internas)

No arquivo que você quer exibir as estatísticas:

```blade
<div class="container my-4">
    @include('components.site-visit-counter', ['stats' => $visitStats])
</div>
```

#### Opção B: Widget Simples (para rodapé)

```blade
@include('components.visit-counter-simple', [
    'today' => $visitStats['today'],
    'total' => $visitStats['total'],
    'unique' => $visitStats['unique']
])
```

### Passo 4: Usar diretamente no Footer

Edite o arquivo `resources/views/public_templates/leg/includes/footer.blade.php` e adicione:

```blade
<div class="container-fluid bg-light py-3 mt-5">
    @include('components.visit-counter-simple', [
        'today' => $visitStats['today'],
        'total' => $visitStats['total'],
        'unique' => $visitStats['unique']
    ])
</div>
```

## 📊 Métodos Disponíveis

### Model SiteVisit

```php
// Total de visitas
SiteVisit::getTotalVisits()

// Visitas de hoje
SiteVisit::getTodayVisits()

// Visitas desta semana
SiteVisit::getWeekVisits()

// Visitas deste mês
SiteVisit::getMonthVisits()

// Visitantes únicos
SiteVisit::getUniqueVisitors()

// Estatísticas completas
SiteVisit::getStats()
```

### Usar no Controller

Se quiser passar as estatísticas manualmente para uma view específica:

```php
use App\Models\SiteVisit;

public function index()
{
    $visitStats = SiteVisit::getStats();
    
    return view('sua-view', compact('visitStats'));
}
```

## 🎨 Exemplo de Uso na Página Inicial

Edite `resources/views/public_templates/leg/index.blade.php` (ou onde preferir):

```blade
@extends('public_templates.leg.default')

@section('content')
    <!-- Seu conteúdo aqui -->
    
    <!-- Estatísticas de Visitas -->
    <section class="py-5 bg-light">
        <div class="container">
            @include('components.site-visit-counter', ['stats' => $visitStats])
        </div>
    </section>
@endsection
```

## ⚙️ Configurações

### Tempo de Cooldown

Por padrão, uma mesma sessão só conta como nova visita após 30 minutos.
Para alterar, edite `app/Models/SiteVisit.php` linha 30:

```php
->where('visited_at', '>', Carbon::now()->subMinutes(30)) // Altere 30 para o valor desejado
```

### Ignorar Rotas Admin

O middleware já ignora automaticamente rotas que começam com `/admin` e `/api`.
Para adicionar mais exclusões, edite `app/Http/Middleware/TrackSiteVisits.php`:

```php
if (!$request->is('admin*') && !$request->is('api*') && !$request->is('dashboard*')) {
```

## 🧹 Limpeza de Dados (Opcional)

Para evitar que a tabela `site_visits` cresça indefinidamente, você pode criar um comando para limpar dados antigos:

```bash
php artisan make:command CleanOldVisits
```

E no comando:

```php
SiteVisit::where('visited_at', '<', Carbon::now()->subMonths(6))->delete();
```

Agende no `app/Console/Kernel.php`:

```php
$schedule->command('visits:clean')->monthly();
```

## 📈 Melhorias Futuras (Opcionais)

1. **Dashboard Admin**: Criar uma página no admin com gráficos das visitas
2. **Cache**: Implementar cache nas estatísticas para melhor performance
3. **Geolocalização**: Adicionar rastreamento de localização dos visitantes
4. **Páginas Mais Visitadas**: Adicionar ranking de páginas mais acessadas

## ✅ Pronto para Usar!

Após executar a migration, o sistema já está funcionando automaticamente. As visitas estão sendo registradas e você pode exibir o contador onde preferir usando os componentes fornecidos.

## 🆘 Suporte

Se encontrar algum erro:

1. Verifique se executou `php artisan migrate`
2. Verifique os logs em `storage/logs/laravel.log`
3. Limpe o cache: `php artisan config:clear && php artisan cache:clear`
