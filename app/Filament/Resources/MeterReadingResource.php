<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeterReadingResource\Pages;
use App\Filament\Resources\MeterReadingResource\RelationManagers;
use App\Models\MeterReading;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enum\MeterType;

class MeterReadingResource extends Resource
{
    protected static ?string $model = MeterReading::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('reading_at')
                    ->label('Reading At')
                    ->required(),
                Forms\Components\TextInput::make('reading')
                    ->integer()
                    ->label('Reading')
                    ->required(),
                Forms\Components\Select::make('meter_type')
                    ->label('Meter Type')
                    ->options([
                        'electric' => "Electric",
                        'water' => "Water",
                        'gas' => "Gas",
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reading_at')
                    ->label('Reading At')
                    ->dateTime('Y-m-d H:i:s'),
                Tables\Columns\TextColumn::make('reading')
                    ->label('Reading'),
                Tables\Columns\TextColumn::make('meter_type')
                    ->label('Meter Type')
                    ->formatStateUsing(fn (MeterType $state): string => $state->label())
            ])
            ->defaultSort('reading_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('meter_type')
                    ->label('Meter Type')
                    ->options([
                        'electric' => "Electric",
                        'water' => "Water",
                        'gas' => "Gas",
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeterReadings::route('/'),
            'create' => Pages\CreateMeterReading::route('/create'),
            'edit' => Pages\EditMeterReading::route('/{record}/edit'),
        ];
    }
}
