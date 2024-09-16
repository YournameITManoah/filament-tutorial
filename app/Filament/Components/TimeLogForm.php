<?php

namespace App\Filament\Components;


use App\Models\Project;
use App\TimeLogFormType;
use Filament\Forms;
use App\Rules\Timeframe;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TimeLogForm
{
    public static function schema(TimeLogFormType $type = TimeLogFormType::DEFAULT): array
    {
        $default = [
            Forms\Components\DateTimePicker::make('start_time')
                ->required()
                ->maxDate(now())
                ->before('stop_time'),
            Forms\Components\DateTimePicker::make('stop_time')
                ->required()
                ->maxDate(now())
                ->after('start_time')
                ->rules([
                    function (Forms\Get $get) {
                        return new Timeframe($get('start_time'));
                    }
                ]),
            Forms\Components\Textarea::make('description')
                ->required()
                ->columnSpanFull(),
        ];

        if ($type === TimeLogFormType::PROJECT) {
            return array_merge([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(function (RelationManager $livewire): array {
                        return $livewire->getOwnerRecord()->users()->pluck('name', 'id')->toArray();
                    })
                    ->required(),
                Forms\Components\TextInput::make('project_id')
                    ->label('Project')
                    ->disabled()
            ], $default);
        }  elseif ($type === TimeLogFormType::USER) {
            return array_merge([
                Forms\Components\Select::make('project_id')
                    ->label('Project')
                    ->options(function (RelationManager $livewire): array {
                        return $livewire->getOwnerRecord()->projects()->pluck('name', 'id')->toArray();
                    })
                    ->required()
            ], $default);
        } else {
            return array_merge([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->live()
                    ->required(),
                Forms\Components\Select::make('project_id')
                    ->options(fn (Forms\Get $get): Collection => Project::query()
                        ->whereHas('users', function (Builder $query) use ($get) {
                            $query->where('user_id', $get('user_id'));
                        })
                        ->pluck('name', 'id'))
                    ->required()
            ], $default);
        }
    }
}
