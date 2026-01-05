<?php

namespace App\Filament\Resources\CatatanRekamMedisResource\Pages;

use App\Filament\Resources\CatatanRekamMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatatanRekamMedis extends ListRecords
{
    protected static string $resource = CatatanRekamMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
