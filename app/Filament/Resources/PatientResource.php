<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_telepon')
                    ->tel()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('pendidikan')
                    ->options([
                        'None' => 'None',
                        'TK' => 'TK',
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA SEDERAJAT' => 'SMA SEDERAJAT',
                        'SMK' => 'SMK',
                        'D1' => 'D1',
                        'D2' => 'D2',
                        'D3' => 'D3',
                        'D4' => 'D4',
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ])
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('no_rekam_medis')
                    ->maxLength(255),
                Forms\Components\TextInput::make('NIK')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tinggi_badan')
                    ->numeric(),
                Forms\Components\TextInput::make('berat_badan')
                    ->numeric(),
                Forms\Components\Select::make('golongan_darah')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                        '-' => '-',
                    ])
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('agama')
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katholik' => 'Katholik',
                        'Buddha' => 'Buddha',
                        'Hindu' => 'Hindu',
                        'Konghucu' => 'Konghucu',
                        '-' => '-',
                    ])
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('pekerjaan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('tempat_lahir')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('tanggal_lahir')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('alamat')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('pendidikan')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('no_rekam_medis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NIK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telepon')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('tinggi_badan')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('berat_badan')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('golongan_darah')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('agama')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('pekerjaan')
                //     ->searchable(),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
