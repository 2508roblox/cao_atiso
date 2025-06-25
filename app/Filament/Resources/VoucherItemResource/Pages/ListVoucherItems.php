<?php

namespace App\Filament\Resources\VoucherItemResource\Pages;

use App\Filament\Resources\VoucherItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVoucherItems extends ListRecords
{
    protected static string $resource = VoucherItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
