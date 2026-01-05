<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('no_invoice')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\Select::make('address_option')
                ->label('Pilih Alamat')
                ->options([
                    'original' => 'Jl. Dharmahusada Indah I No. 90 / L-175',
                    'second'   => 'Jl. Wisma Permai Tengah IX Blok KK No.7',
                ])
                ->default('original')
                ->required(),
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'nama')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('jenis_perawatan')
                ->options([
        'Dental Filling (Tambal Gigi)' => 'Dental Filling (Tambal Gigi)',
        '⁠Exo Treatment (Cabut Gigi)' => '⁠Exo Treatment (Cabut Gigi)',
        'Kids Exo Treatment (Cabut Gigi Anak)' => 'Kids Exo Treatment (Cabut Gigi Anak)',
        'Endodontic Treatment' => 'Endodontic Treatment',
        'Odontectomy Treatment (Operasi Gigi Bungsu)' => 'Odontectomy Treatment (Operasi Gigi Bungsu)',
        'Orthodontic Treatment (Kawat Gigi / Braces)' => 'Orthodontic Treatment (Kawat Gigi / Braces)',
        'Scalling Treatment (Pembersihan Karang Gigi)' => 'Scalling Treatment (Pembersihan Karang Gigi)',
        'GTT (Gigi Tiruan Tetap)' => 'GTT (Gigi Tiruan Tetap)',
        'GTSL (Gigi Tiruan Sementara Lepasan)' => 'GTSL (Gigi Tiruan Sementara Lepasan)',
        'Tambal Sementara' => 'Tambal Sementara',
        'Tambal GIC' => 'Tambal GIC',
        'Splinting' => 'Splinting',
        'Gingivectomy' => 'Gingivectomy',
        'Bleaching (Pemutihan Gigi)' => 'Bleaching (Pemutihan Gigi)',
        'Konsultasi' => 'Konsultasi',
        'Crown' => 'Crown',
        'Retainer' => 'Retainer',
        'Cetak Gigi' => 'Cetak Gigi',
        'Denture (Gigi Palsu)' => 'Denture (Gigi Palsu)',
        'Alveolektomi' => 'Alveolektomi',
        'Eksisi' => 'Eksisi',
        'Veneer Direct' => 'Veneer Direct',
        '⁠Veneer Indirect' => '⁠Veneer Indirect',
        'Implan' => 'Implan',
        'APD' => 'APD',
        'Medicine (obat)' => 'Medicine (obat)',
        '-' => '-',
                ])
                ->columnSpanFull()
                ->searchable()
                ->required()
                ->multiple(),

                Forms\Components\Textarea::make('notes')
                    ->disableLabel()
                    ->columnSpanFull(),
                // Forms\Components\TextInput::make('jumlah')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\Section::make('Jumlah')
                //             ->schema([
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->required()
                    ->numeric()
                    ->prefix('Rp.'),
                // ]),

                // Forms\Components\TextInput::make('terbilang')
                //     ->required()
                //     ->maxLength(255),

                Forms\Components\TextInput::make('terbilang')
                    ->label('Terbilang')
                    ->disabled(),

                Forms\Components\DatePicker::make('paid_date')
                    ->label('Paid Date')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_invoice')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('patient_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('patient.nama')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('jenis_perawatan')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('terbilang')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('paid_date')
                    ->date()
                    ->sortable()
                    ->searchable(),
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
                Action::make('View Invoice')
                    ->url(fn(Transaction $record): string => route('preview-invoice', $record))
                    ->color('success')
                    ->openUrlInNewTab(),
                Action::make('Download Invoice')
                    ->url(fn(Transaction $record): string => route('download-invoice', $record))
                    ->color('danger')
                    ->openUrlInNewTab(),
                Action::make('Print Invoice')
                    ->url(fn(Transaction $record): string => route('print-invoice', $record))
                    ->color('primary')
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
