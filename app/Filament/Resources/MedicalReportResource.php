<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalReportResource\Pages;
use App\Filament\Resources\MedicalReportResource\RelationManagers;
use App\Filament\Resources\MedicalReportResource\RelationManagers\CatatanRekamMedisRelationManager;
use App\Models\MedicalReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalReportResource extends Resource
{
    protected static ?string $model = MedicalReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'nama')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('no_rekam_medis')
                    ->label('No Rekam Medis')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.nama')
                    ->label('Nama Pasien')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.no_rekam_medis')
                    ->label('No Rekam Medis')
                    ->sortable(),
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
            CatatanRekamMedisRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalReports::route('/'),
            'create' => Pages\CreateMedicalReport::route('/create'),
            'edit' => Pages\EditMedicalReport::route('/{record}/edit'),
        ];
    }
}
