<?php

namespace App\Filament\Resources\MedicalReportResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CatatanRekamMedisRelationManager extends RelationManager
{
    protected static string $relationship = 'catatanRekamMedis';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('patient_appointment_id')
                //     ->relationship('patientAppointment', 'name')
                //     ->required(),
                Forms\Components\DatePicker::make('tanggal_pemeriksaan')
                    ->required(),
                Forms\Components\Textarea::make('anamnesa')
                    ->required(),
                Forms\Components\Textarea::make('pemeriksaan')
                    ->required(),
                Forms\Components\Textarea::make('diagnosa')
                    ->required(),
                Forms\Components\Textarea::make('terapi')
                    ->required(),
                Forms\Components\Textarea::make('anjuran')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tanggal_pemeriksaan')
            ->columns([
                // Tables\Columns\TextColumn::make('patient_appointment_id'),
                Tables\Columns\TextColumn::make('tanggal_pemeriksaan')
                ->date()
                ->searchable(),
                Tables\Columns\TextColumn::make('anamnesa'),
                Tables\Columns\TextColumn::make('pemeriksaan'),
                Tables\Columns\TextColumn::make('diagnosa'),
                Tables\Columns\TextColumn::make('terapi'),
                Tables\Columns\TextColumn::make('anjuran'),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal_pemeriksaan')
                ->form([
                    Forms\Components\DatePicker::make('start')
                        ->label('Dari Tanggal')
                        ->placeholder('Pilih tanggal awal'),
                    Forms\Components\DatePicker::make('end')
                        ->label('Sampai Tanggal')
                        ->placeholder('Pilih tanggal akhir'),
                ])
                ->query(function (Builder $query, $data) {
                    if (isset($data['start']) && isset($data['end'])) {
                        $query->whereBetween('tanggal_pemeriksaan', [$data['start'], $data['end']]);
                    }
                }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
