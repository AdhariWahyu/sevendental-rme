<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatatanRekamMedisResource\Pages;
use App\Filament\Resources\CatatanRekamMedisResource\RelationManagers;
use App\Models\CatatanRekamMedis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CatatanRekamMedisResource extends Resource
{
    protected static ?string $model = CatatanRekamMedis::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('medical_report_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'nama')
                    ->required()
                    ->searchable(),
                // Forms\Components\Select::make('patient.no_rekam_medis')
                // ->relationship('patient', 'no_rekam_medis')
                //     ->required()
                //     ->searchable(),
                // Forms\Components\TextInput::make('patient_appointment_id')
                //     ->relationship('appointment', 'patient_appointment_id')
                //     ->required()
                //     ->searchable(),
                Forms\Components\Textarea::make('anamnesa')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('pemeriksaan')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('diagnosa')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('terapi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('anjuran')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal_pemeriksaan')
                    ->required(),
                // Forms\Components\TextInput::make('total_biaya')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('bayar')
                //     ->required()
                //     ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('slug')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('medical_report_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('patient_appointment_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('patient.nama')
                    ->label('Nama Pasien')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.no_rekam_medis')
                    ->label('No Rekam Medis')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pemeriksaan')
                    ->date()
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('total_biaya')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('bayar')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCatatanRekamMedis::route('/'),
            'create' => Pages\CreateCatatanRekamMedis::route('/create'),
            'edit' => Pages\EditCatatanRekamMedis::route('/{record}/edit'),
        ];
    }
    
    public static function canViewAny(): bool
    {
        // Mengembalikan false untuk menyembunyikan resource ini dari menu
        return false;
    }
}
