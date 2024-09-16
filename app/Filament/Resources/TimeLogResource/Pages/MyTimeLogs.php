<?php

namespace App\Filament\Resources\TimeLogResource\Pages;

use App\Filament\Resources\TimeLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MyTimeLogs extends ListRecords
{
    protected static string $resource = TimeLogResource::class;
    protected static ?string $title = 'My Time Logs';
    protected static ?string $breadcrumb = 'My';

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('user', function (Builder $query) {
                $query->where('user_id', auth()->id());
            }));
    }

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->check();
    }
}
