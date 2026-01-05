<?php

namespace App\Filament\Resources\CatatanRekamMedisResource\Pages;

use App\Filament\Resources\CatatanRekamMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatatanRekamMedis extends EditRecord
{
    protected static string $resource = CatatanRekamMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
