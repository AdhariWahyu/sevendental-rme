<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('address_option')
                    ->label('Pilih Format Kwitansi')
                    ->options([
                        'praktek_second' => 'Praktek Dokter Gigi - Jl. Wisma Permai Tengah IX',
                        'klinik_original' => 'Klinik Sevendental - Jl. Dharmahusada Indah I',
                        'praktek_original' => 'Praktek Dokter Gigi - Jl. Dharmahusada Indah I',
                    ])
                    ->default('praktek_original')
                    ->required()
                    ->helperText('Pilih format header dan alamat yang akan ditampilkan di kwitansi'),
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'nama')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('jenis_perawatan')
                    ->options([
                        'Dental Filling (Tambal Gigi)' => 'Dental Filling (Tambal Gigi)',
                        'Exo Treatment (Cabut Gigi)' => 'Exo Treatment (Cabut Gigi)',
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
                        'Veneer Indirect' => 'Veneer Indirect',
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
                    ->columnSpanFull()
                    ->placeholder('Catatan tambahan (opsional)'),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->required()
                    ->numeric()
                    ->prefix('Rp.'),
                Forms\Components\TextInput::make('terbilang')
                    ->label('Terbilang')
                    ->disabled(),
                Forms\Components\DatePicker::make('paid_date')
                    ->label('Tanggal Pembayaran')
                    ->required()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_invoice')
                    ->label('No. Invoice')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.nama')
                    ->label('Nama Pasien')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('paid_date')
                    ->label('Tanggal Bayar')
                    ->date('d M Y')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
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
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Transaction $record): string => route('preview-invoice', $record))
                    ->color('success')
                    ->openUrlInNewTab(),
                Action::make('Download Invoice')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Transaction $record): string => route('download-invoice', $record))
                    ->color('danger')
                    ->openUrlInNewTab(),
                Action::make('Print Invoice')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn(Transaction $record): string => route('print-invoice', $record))
                    ->color('primary')
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
